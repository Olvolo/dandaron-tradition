<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Сначала чиним данные: заполняем пустые slug и разводим дубли
        //    в пределах одной книги, прежде чем накатывать ограничение.
        $this->backfillMissingSlugs();
        $this->deduplicateSlugs();

        // 2. Только теперь можно безопасно наложить уникальность.
        Schema::table('chapters', function (Blueprint $table) {
            $table->string('slug')->nullable(false)->change();
            $table->unique(['book_id', 'slug']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('chapters', function (Blueprint $table) {
            $table->dropUnique(['book_id', 'slug']);
            $table->string('slug')->nullable()->change();
        });
    }

    /**
     * Генерирует slug из title там, где он пуст или NULL.
     */
    protected function backfillMissingSlugs(): void
    {
        $chapters = DB::table('chapters')
            ->whereNull('slug')
            ->orWhere('slug', '')
            ->get(['id', 'title']);

        foreach ($chapters as $chapter) {
            $base = Str::slug($chapter->title) ?: 'glava';
            $slug = $base;
            $suffix = 1;

            while (DB::table('chapters')->where('slug', $slug)->where('id', '!=', $chapter->id)->exists()) {
                $slug = $base . '-' . (++$suffix);
            }

            DB::table('chapters')->where('id', $chapter->id)->update(['slug' => $slug]);
        }
    }

    /**
     * Находит группы (book_id, slug) с дублями и переименовывает
     * все, кроме первой (самой старой) записи в каждой группе.
     */
    protected function deduplicateSlugs(): void
    {
        $duplicates = DB::table('chapters')
            ->select('book_id', 'slug')
            ->whereNotNull('slug')
            ->where('slug', '!=', '')
            ->groupBy('book_id', 'slug')
            ->havingRaw('COUNT(*) > 1')
            ->get();

        foreach ($duplicates as $duplicate) {
            $rows = DB::table('chapters')
                ->where('book_id', $duplicate->book_id)
                ->where('slug', $duplicate->slug)
                ->orderBy('id')
                ->get(['id', 'slug']);

            // Первую запись в группе оставляем как есть, остальным
            // добавляем числовой суффикс, пока не найдём свободный slug.
            foreach ($rows->skip(1) as $row) {
                $suffix = 2;
                $newSlug = $row->slug . '-' . $suffix;

                while (
                    DB::table('chapters')
                        ->where('book_id', $duplicate->book_id)
                        ->where('slug', $newSlug)
                        ->exists()
                ) {
                    $newSlug = $row->slug . '-' . (++$suffix);
                }

                DB::table('chapters')->where('id', $row->id)->update(['slug' => $newSlug]);
            }
        }
    }
};
