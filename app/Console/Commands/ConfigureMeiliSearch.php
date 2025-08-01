<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use MeiliSearch\Client;

class ConfigureMeiliSearch extends Command
{
    protected $signature = 'app:configure-meili-search';
    protected $description = 'Configures MeiliSearch indexes with the correct settings.';

    public function handle()
    {
        $this->info('Configuring MeiliSearch indexes...');

        try {
            $meiliSearch = new Client(config('scout.meilisearch.host'), config('scout.meilisearch.key'));
        } catch (\Exception $e) {
            $this->error('Could not connect to MeiliSearch: ' . $e->getMessage());
            return Command::FAILURE;
        }

        // --- Настройки для индекса 'articles' ---
        $this->info('Updating settings for [articles] index...');
        $articleAttrs = ['id', 'title', 'annotation', 'content_html']; // <-- Добавили 'id'
        $meiliSearch->index('articles')->updateSettings([
            'displayedAttributes' => $articleAttrs,
            'searchableAttributes' => $articleAttrs
        ]);

        // --- Настройки для индекса 'books' ---
        $this->info('Updating settings for [books] index...');
        $bookAttrs = ['id', 'title', 'annotation', 'description']; // <-- Добавили 'id'
        $meiliSearch->index('books')->updateSettings([
            'displayedAttributes' => $bookAttrs,
            'searchableAttributes' => $bookAttrs
        ]);

        // --- Настройки для индекса 'chapters' ---
        $this->info('Updating settings for [chapters] index...');
        $chapterAttrs = ['id', 'title', 'content_html']; // <-- Добавили 'id'
        $meiliSearch->index('chapters')->updateSettings([
            'displayedAttributes' => $chapterAttrs,
            'searchableAttributes' => $chapterAttrs
        ]);

        $this->info('MeiliSearch configuration updated successfully!');

        return Command::SUCCESS;
    }
}
