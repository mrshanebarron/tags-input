<template>
  <div>
    <div :class="['flex flex-wrap gap-2 p-2 border border-gray-300 rounded-lg focus-within:ring-2 focus-within:ring-blue-500 focus-within:border-blue-500', containerClass]">
      <span
        v-for="(tag, index) in tags"
        :key="index"
        class="inline-flex items-center gap-1 px-2 py-1 bg-blue-100 text-blue-800 text-sm rounded-md"
      >
        {{ tag }}
        <button @click="removeTag(index)" class="hover:text-blue-600">
          <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>
      </span>
      <input
        ref="inputRef"
        v-model="inputValue"
        @keydown.enter.prevent="addTag"
        @keydown.backspace="handleBackspace"
        @keydown.comma.prevent="addTag"
        :placeholder="tags.length ? '' : placeholder"
        class="flex-1 min-w-[120px] outline-none text-sm"
        :disabled="maxTags && tags.length >= maxTags"
      >
    </div>
    <p v-if="maxTags" class="mt-1 text-xs text-gray-500">{{ tags.length }}/{{ maxTags }} tags</p>
  </div>
</template>

<script>
import { ref, computed } from 'vue';

export default {
  name: 'LdTagsInput',
  props: {
    modelValue: { type: Array, default: () => [] },
    placeholder: { type: String, default: 'Add a tag...' },
    maxTags: { type: Number, default: null },
    allowDuplicates: { type: Boolean, default: false },
    containerClass: { type: String, default: '' }
  },
  emits: ['update:modelValue'],
  setup(props, { emit }) {
    const inputRef = ref(null);
    const inputValue = ref('');

    const tags = computed(() => props.modelValue);

    const addTag = () => {
      const value = inputValue.value.trim();
      if (!value) return;
      if (!props.allowDuplicates && tags.value.includes(value)) {
        inputValue.value = '';
        return;
      }
      if (props.maxTags && tags.value.length >= props.maxTags) return;

      emit('update:modelValue', [...tags.value, value]);
      inputValue.value = '';
    };

    const removeTag = (index) => {
      const newTags = [...tags.value];
      newTags.splice(index, 1);
      emit('update:modelValue', newTags);
    };

    const handleBackspace = () => {
      if (!inputValue.value && tags.value.length > 0) {
        removeTag(tags.value.length - 1);
      }
    };

    return { inputRef, inputValue, tags, addTag, removeTag, handleBackspace };
  }
};
</script>
