<div>
    <div style="display: flex; flex-wrap: wrap; align-items: center; gap: 8px; padding: 8px; border: 1px solid #d1d5db; border-radius: 8px; background: white; min-height: 42px;">
        @foreach($this->tags as $index => $tag)
        <span style="display: inline-flex; align-items: center; gap: 4px; padding: 4px 8px; background: #eff6ff; color: #1e40af; border-radius: 6px; font-size: 14px;">
            {{ $tag }}
            <button
                type="button"
                wire:click="removeTag({{ $index }})"
                style="display: flex; align-items: center; justify-content: center; padding: 0; background: transparent; border: none; cursor: pointer; color: #1e40af; opacity: 0.6;"
                onmouseover="this.style.opacity='1'"
                onmouseout="this.style.opacity='0.6'"
            >
                <svg style="width: 16px; height: 16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </span>
        @endforeach

        <input
            type="text"
            wire:model="input"
            wire:keydown.enter.prevent="addTag"
            wire:keydown.tab.prevent="addTag"
            wire:keydown.comma.prevent="addTag"
            placeholder="{{ $this->placeholder }}"
            style="flex: 1; min-width: 120px; border: none; outline: none; font-size: 14px; background: transparent;"
            @if($this->maxTags > 0 && count($this->tags) >= $this->maxTags) disabled @endif
        >
    </div>

    @if(count($this->suggestions) > 0 && strlen($this->input) > 0)
    <div style="margin-top: 8px; display: flex; flex-wrap: wrap; gap: 8px;">
        @foreach(array_filter($this->suggestions, fn($s) => str_contains(strtolower($s), strtolower($this->input)) && !in_array($s, $this->tags)) as $suggestion)
        <button
            type="button"
            wire:click="addSuggestion('{{ $suggestion }}')"
            style="padding: 4px 8px; font-size: 12px; background: #f3f4f6; border: none; border-radius: 4px; cursor: pointer;"
            onmouseover="this.style.background='#e5e7eb'"
            onmouseout="this.style.background='#f3f4f6'"
        >
            {{ $suggestion }}
        </button>
        @endforeach
    </div>
    @endif
</div>
