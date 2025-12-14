<div class="w-full">
    <div class="flex flex-wrap gap-2 p-3 border border-gray-300 rounded-lg focus-within:border-blue-500 focus-within:ring-2 focus-within:ring-blue-200 bg-white">
        @foreach($tags as $index => $tag)
            <span class="inline-flex items-center gap-1 px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm">
                {{ $tag }}
                <button type="button" wire:click="removeTag({{ $index }})" class="hover:text-blue-600">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </span>
        @endforeach
        <input
            type="text"
            wire:model="input"
            wire:keydown.enter.prevent="addTag"
            wire:keydown.comma.prevent="addTag"
            placeholder="{{ count($tags) === 0 ? $placeholder : '' }}"
            @if($maxTags > 0 && count($tags) >= $maxTags) disabled @endif
            class="flex-1 min-w-[120px] outline-none text-sm disabled:cursor-not-allowed"
        >
    </div>
    @if($maxTags > 0)
        <p class="mt-1 text-xs text-gray-500">{{ count($tags) }}/{{ $maxTags }} tags</p>
    @endif
</div>
