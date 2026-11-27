<?php

namespace App\Console\Commands;

use App\Models\Placement;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;
use RuntimeException;

class RebuildPlacementSlugs extends Command
{
    protected $signature = 'placements:rebuild-slugs
                            {--dry-run : Проверить адреса без изменения базы данных}';

    protected $description = 'Пересчитать full_slug всех разделов и проверить целостность дерева';

    /**
     * Новые адреса, рассчитанные для всех разделов.
     *
     * @var array<int, string>
     */
    private array $calculatedSlugs = [];

    /**
     * Исходные записи, сгруппированные по ID.
     *
     * @var array<int, array>
     */
    private array $placements = [];

    /**
     * Родительские связи.
     *
     * @var array<int, array<int>>
     */
    private array $children = [];

    public function handle(): int
    {
        $dryRun = (bool) $this->option('dry-run');

        try {
            $this->loadPlacements();

            $roots = [];

            foreach ($this->placements as $id => $placement) {
                $parentId = $placement['parent_id'];

                if ($parentId === null) {
                    $roots[] = $id;
                } else {
                    if (! isset($this->placements[$parentId])) {
                        throw new RuntimeException(
                            "Раздел ID {$id} ссылается на отсутствующего родителя ID {$parentId}."
                        );
                    }

                    $this->children[$parentId][] = $id;
                }
            }

            // Сначала проверяем корневые разделы.
            foreach ($roots as $rootId) {
                $this->calculateBranch($rootId, '', []);
            }

            // Если не все записи обработаны, в дереве есть цикл
            // или группа записей без корневого предка.
            if (count($this->calculatedSlugs) !== count($this->placements)) {
                $unprocessed = array_diff(
                    array_keys($this->placements),
                    array_keys($this->calculatedSlugs)
                );

                throw new RuntimeException(
                    'Обнаружены циклические связи или недоступные корневые разделы. ID: '
                    . implode(', ', $unprocessed)
                );
            }

            $this->checkDuplicates();

            $changes = [];

            foreach ($this->placements as $id => $placement) {
                $oldSlug = $placement['full_slug'];
                $newSlug = $this->calculatedSlugs[$id];

                if ($oldSlug !== $newSlug) {
                    $changes[] = [
                        'id' => $id,
                        'title' => $placement['title'],
                        'old' => $oldSlug ?? 'NULL',
                        'new' => $newSlug,
                    ];
                }
            }

            $this->table(
                ['ID', 'Раздел', 'Старый full_slug', 'Новый full_slug'],
                $changes
                    ? array_map(
                        fn ($change) => [
                            $change['id'],
                            $change['title'],
                            $change['old'],
                            $change['new'],
                        ],
                        $changes
                    )
                    : []
            );

            $this->info('Всего разделов: ' . count($this->placements));
            $this->info('Адресов, требующих изменения: ' . count($changes));

            if ($dryRun) {
                $this->warn('Режим dry-run: база данных не изменялась.');

                return self::SUCCESS;
            }

            if (! $changes) {
                $this->info('Все адреса уже соответствуют структуре дерева.');

                return self::SUCCESS;
            }

            DB::transaction(function () use ($changes) {
                foreach ($changes as $change) {
                    DB::table('placements')
                        ->where('id', $change['id'])
                        ->update([
                            'full_slug' => $change['new'],
                        ]);
                }
            });

            foreach ([
                'menu_tree',
                'menu_tree_optimized',
                'placement_slugs_map',
            ] as $key) {
                Cache::forget($key);
            }

            $this->info('Пересчёт адресов успешно завершён.');

            return self::SUCCESS;
        } catch (\Throwable $exception) {
            $this->error($exception->getMessage());

            return self::FAILURE;
        }
    }

    /**
     * Загружает разделы и формирует карту записей.
     */
    private function loadPlacements(): void
    {
        if (! Schema::hasColumn('placements', 'full_slug')) {
            throw new RuntimeException('В таблице placements отсутствует колонка full_slug.');
        }

        $records = DB::table('placements')
            ->select([
                'id',
                'parent_id',
                'title',
                'slug',
                'full_slug',
            ])
            ->orderBy('id')
            ->get();

        foreach ($records as $record) {
            $this->placements[$record->id] = [
                'id' => (int) $record->id,
                'parent_id' => $record->parent_id !== null
                    ? (int) $record->parent_id
                    : null,
                'title' => $record->title,
                'slug' => trim($record->slug ?? ''),
                'full_slug' => $record->full_slug,
            ];
        }
    }

    /**
     * Рекурсивно рассчитывает адреса ветви дерева.
     */
    private function calculateBranch(
        int $id,
        string $parentFullSlug,
        array $path
    ): void {
        if (isset($path[$id])) {
            throw new RuntimeException(
                'Обнаружен цикл в дереве разделов. ID: ' . implode(' → ', array_keys($path)) . " → {$id}"
            );
        }

        $path[$id] = true;

        $placement = $this->placements[$id];
        $slug = $placement['slug'];

        if ($slug === '') {
            throw new RuntimeException("У раздела ID {$id} пустой slug.");
        }

        if ($slug === 'home') {
            if ($placement['parent_id'] !== null) {
                throw new RuntimeException(
                    "Раздел home (ID {$id}) находится не на корневом уровне."
                );
            }

            $fullSlug = '';
        } else {
            $fullSlug = trim($parentFullSlug . '/' . $slug, '/');
        }

        if (mb_strlen($fullSlug) > 255) {
            throw new RuntimeException(
                "Полный адрес раздела ID {$id} превышает 255 символов: {$fullSlug}"
            );
        }

        $this->calculatedSlugs[$id] = $fullSlug;

        foreach ($this->children[$id] ?? [] as $childId) {
            $this->calculateBranch($childId, $fullSlug, $path);
        }
    }

    /**
     * Проверяет глобальную уникальность рассчитанных адресов.
     */
    private function checkDuplicates(): void
    {
        $owners = [];

        foreach ($this->calculatedSlugs as $id => $fullSlug) {
            if (isset($owners[$fullSlug])) {
                throw new RuntimeException(
                    "Дублируется full_slug '{$fullSlug}' у разделов ID "
                    . "{$owners[$fullSlug]} и {$id}."
                );
            }

            $owners[$fullSlug] = $id;
        }
    }
}
