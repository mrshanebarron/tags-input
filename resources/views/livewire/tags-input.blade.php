<div>
    <div class="{{ config('sb-tags-input.classes.container') }}">
        @foreach($tags as $index => $tag)
        <span class="{{ config('sb-tags-input.classes.tag') }}">
            {{ $tag }}
            <button 
                type="button" 
                wire:click="removeTag({{ $index }})" 
                class="{{ config('sb-tags-input.classes.remove') }}"
            >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
            placeholder="{{ $placeholder }}"
            class="{{ config('sb-tags-input.classes.input') }}"
            @if($maxTags > 0 && count($tags) >= $maxTags) disabled @endif
        >
    </div>
    
    @if(count($suggestions) > 0 && strlen($input) > 0)
    <div class="mt-2 flex flex-wrap gap-2">
        @foreach(array_filter($suggestions, fn($s) => str_contains(strtolower($s), strtolower($input)) && !in_array($s, $tags)) as $suggestion)
        <button 
            type="button"
            wire:click="addSuggestion('{{ $suggestion }}')"
            class="px-2 py-1 text-xs bg-gray-100 hover:bg-gray-200 rounded"
        >
            {{ $suggestion }}
        </button>
        @endforeach
    </div>
    @endif
</div>
