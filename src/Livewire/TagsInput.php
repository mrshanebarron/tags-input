<?php

namespace MrShaneBarron\TagsInput\Livewire;

use Livewire\Component;
use Livewire\Attributes\Modelable;

class TagsInput extends Component
{
    #[Modelable]
    public array $tags = [];
    
    public string $input = '';
    public string $placeholder = 'Add a tag...';
    public int $maxTags = 0;
    public array $suggestions = [];
    public bool $allowDuplicates = false;

    public function mount(
        array $tags = [],
        string $placeholder = 'Add a tag...',
        int $maxTags = 0,
        array $suggestions = [],
        bool $allowDuplicates = false
    ): void {
        $this->tags = $tags;
        $this->placeholder = $placeholder;
        $this->maxTags = $maxTags;
        $this->suggestions = $suggestions;
        $this->allowDuplicates = $allowDuplicates;
    }

    public function addTag(): void
    {
        $tag = trim($this->input);
        if (empty($tag)) return;
        if ($this->maxTags > 0 && count($this->tags) >= $this->maxTags) return;
        if (!$this->allowDuplicates && in_array($tag, $this->tags)) return;
        
        $this->tags[] = $tag;
        $this->input = '';
        $this->dispatch('tags-changed', tags: $this->tags);
    }

    public function removeTag(int $index): void
    {
        unset($this->tags[$index]);
        $this->tags = array_values($this->tags);
        $this->dispatch('tags-changed', tags: $this->tags);
    }

    public function render()
    {
        return view('ld-tags-input::livewire.tags-input');
    }
}
