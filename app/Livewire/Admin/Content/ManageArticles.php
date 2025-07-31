<?php

namespace App\Livewire\Admin\Content;

use App\Models\Article;
use App\Models\Author;
use App\Models\Category;
use App\Models\Tag;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.admin')]
class ManageArticles extends Component
{
    public $isModalOpen = false;
    public $article_id;

    // Поля формы
    public $parent_id = null;
    public $title = '';
    public $annotation = '';
    public $content_html = '';
    public $custom_styles = '';

    // Свойства для связей
    public $selectedAuthors = [];
    public $selectedCategories = [];
    public $selectedTags = [];

    public function render()
    {
        return view('livewire.admin.content.manage-articles', [
            'articles' => Article::with('parent')->latest()->get(),
            'potentialParents' => Article::where('id', '!=', $this->article_id)->get(),
            'allAuthors' => Author::all(),
            'allCategories' => Category::all(),
            'allTags' => Tag::all(),
        ]);
    }

    public function create()
    {
        $this->resetForm();
        $this->isModalOpen = true;
    }

    public function edit($id)
    {
        $article = Article::findOrFail($id);
        $this->article_id = $id;
        $this->parent_id = $article->parent_id;
        $this->title = $article->title;
        $this->annotation = $article->annotation;
        $this->content_html = $article->content_html;
        $this->custom_styles = $article->custom_styles;
        // Загружаем связанные ID
        $this->selectedAuthors = $article->authors->pluck('id')->toArray();
        $this->selectedCategories = $article->categories->pluck('id')->toArray();
        $this->selectedTags = $article->tags->pluck('id')->toArray();

        $this->isModalOpen = true;
    }

    public function store()
    {
        $validatedData = $this->validate([
            'parent_id' => 'nullable|exists:articles,id',
            'title' => 'required|string|max:255',
            'annotation' => 'nullable|string',
            'content_html' => 'required|string',
            'custom_styles' => 'nullable|string',
        ]);

        $article = Article::updateOrCreate(['id' => $this->article_id], $validatedData);
        // Синхронизируем связи
        $article->authors()->sync($this->selectedAuthors);
        $article->categories()->sync($this->selectedCategories);
        $article->tags()->sync($this->selectedTags);

        session()->flash('message', $this->article_id ? 'Статья успешно обновлена.' : 'Статья успешно создана.');

        $this->closeModal();
    }

    public function delete($id)
    {
        Article::find($id)->delete();
        session()->flash('message', 'Статья успешно удалена.');
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
        $this->resetForm();
    }

    private function resetForm()
    {
        $this->article_id = null;
        $this->parent_id = null;
        $this->title = '';
        $this->annotation = '';
        $this->content_html = '';
        $this->custom_styles = '';
        $this->selectedAuthors = [];
        $this->selectedCategories = [];
        $this->selectedTags = [];
    }
}
