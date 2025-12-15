<?php

namespace MrShaneBarron\TagsInput\Livewire;

use Livewire\Component;

class TagsInput extends Component
{
    public array $tags = [];
    public string $input = '';
    public ?string $placeholder = 'Add a tag...';
    public int $maxTags = 0;
    public array $suggestions = [];
    public bool $allowDuplicates = false;
    public string $separator = ',';

    public function mount(
        array $tags = [],
        ?string $placeholder = 'Add a tag...',
        int $maxTags = 0,
        array $suggestions = [],
        bool $allowDuplicates = false,
        string $separator = ','
    ): void {
        $this->tags = $tags;
        $this->placeholder = $placeholder;
        $this->maxTags = $maxTags;
        $this->suggestions = $suggestions;
        $this->allowDuplicates = $allowDuplicates;
        $this->separator = $separator;
    }

    public function addTag(): void
    {
        $tag = trim($this->input);
        
        if (empty($tag)) {
            return;
        }

        if ($this->maxTags > 0 && count($this->tags) >= $this->maxTags) {
            return;
        }

        if (!$this->allowDuplicates && in_array($tag, $this->tags)) {
            $this->input = '';
            return;
        }

        $this->tags[] = $tag;
        $this->input = '';
        $this->dispatch('tags-updated', tags: $this->tags);
    }

    public function removeTag(int $index): void
    {
        if (isset($this->tags[$index])) {
            unset($this->tags[$index]);
            $this->tags = array_values($this->tags);
            $this->dispatch('tags-updated', tags: $this->tags);
        }
    }

    public function addSuggestion(string $tag): void
    {
        $this->input = $tag;
        $this->addTag();
    }

    public function render()
    {
        return view('sb-tags-input::livewire.tags-input');
    }
}
