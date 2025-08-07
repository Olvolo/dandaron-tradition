<?php

namespace App\Livewire\Admin\Content;

use App\Models\Chapter;
use Livewire\Component;

class ChapterItem extends Component
{
    public Chapter $chapter;
    public bool $open = false; // По умолчанию свёрнуто

    public function createChildChapter(): void
    {
        $this->dispatch('createChapter', parentId: $this->chapter->id);
    }

    public function editChapter(): void
    {
        $this->dispatch('editChapter', chapterId: $this->chapter->id);
    }

    public function deleteChapter(): void
    {
        $this->dispatch('deleteChapter', chapterId: $this->chapter->id);
    }

    public function render()
    {
        return view('livewire.admin.content.chapter-item');
    }
}
