<?php

namespace App\Livewire\Admin\Content;

use App\Models\Chapter;
use Livewire\Component;

class ChapterItem extends Component
{
    public Chapter $chapter;
    public bool $open = false; // По умолчанию свёрнуто

    public function createChildChapter()
    {
        $this->dispatch('createChapter', parentId: $this->chapter->id);
    }

    public function editChapter()
    {
        $this->dispatch('editChapter', chapterId: $this->chapter->id);
    }

    public function deleteChapter()
    {
        $this->dispatch('deleteChapter', chapterId: $this->chapter->id);
    }

    public function render()
    {
        return view('livewire.admin.content.chapter-item');
    }
}
