<?php

namespace App\Livewire\Admin\Content;

use App\Models\Book;
use App\Models\Chapter;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\Attributes\On;

class ManageChapters extends Component
{
    public Book $book;

    public $isChapterModalOpen = false;
    public $chapter_id;
    public $chapter_parent_id = null;
    public $chapter_title = '';
    public $chapter_order_column = 0;
    public $chapter_content_html = '';

    protected $listeners = [
        'createChapter' => 'createChapter',
        'editChapter' => 'editChapter',
        'deleteChapter' => 'deleteChapter',
    ];

    public function createChapter($parentId = null)
    {
        $this->resetChapterForm();
        $this->chapter_parent_id = $parentId;
        $this->isChapterModalOpen = true;
    }

    public function editChapter($chapterId)
    {
        $chapter = Chapter::findOrFail($chapterId);
        $this->chapter_id = $chapterId;
        $this->chapter_parent_id = $chapter->parent_id;
        $this->chapter_title = $chapter->title;
        $this->chapter_order_column = $chapter->order_column;
        $this->chapter_content_html = $chapter->content_html;
        $this->isChapterModalOpen = true;
    }

    public function deleteChapter($chapterId)
    {
        Chapter::find($chapterId)->delete();
        session()->flash('chapter_message', 'Глава успешно удалена.');
    }

    public function storeChapter()
    {
        $validatedData = $this->validate([
            'chapter_parent_id' => 'nullable|exists:chapters,id',
            'chapter_title' => 'required|string|max:255',
            'chapter_order_column' => 'required|integer',
            'chapter_content_html' => 'required|string',
        ]);
        $validatedData['slug'] = Str::slug($validatedData['chapter_title']);

        $this->book->chapters()->updateOrCreate(['id' => $this->chapter_id], [
            'parent_id' => $validatedData['chapter_parent_id'],
            'title' => $validatedData['chapter_title'],
            'slug' => $validatedData['slug'],
            'order_column' => $validatedData['chapter_order_column'],
            'content_html' => $validatedData['chapter_content_html'],
        ]);
        session()->flash('chapter_message', $this->chapter_id ? 'Глава обновлена.' : 'Глава создана.');
        $this->closeChapterModal();
    }

    public function closeChapterModal()
    {
        $this->isChapterModalOpen = false;
        $this->resetChapterForm();
    }

    private function resetChapterForm()
    {
        $this->chapter_id = null;
        $this->chapter_parent_id = null;
        $this->chapter_title = '';
        $this->chapter_order_column = 0;
        $this->chapter_content_html = '';
    }

    public function render()
    {
        $rootChapters = $this->book->chapters()->whereNull('parent_id')->with('childrenRecursive')->orderBy('order_column')->get();
        return view('livewire.admin.content.manage-chapters', ['rootChapters' => $rootChapters]);
    }
}
