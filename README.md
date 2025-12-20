# Tags Input

Tag input component with suggestions and validation for Laravel applications. Supports max tags limit, duplicate prevention, and autocomplete suggestions. Works with Livewire and Vue 3.

## Installation

```bash
composer require mrshanebarron/tags-input
```

## Livewire Usage

### Basic Usage

```blade
<livewire:sb-tags-input :tags="['Laravel', 'Vue.js', 'Tailwind']" />
```

### With Placeholder

```blade
<livewire:sb-tags-input placeholder="Add a skill..." />
```

### With Max Tags Limit

```blade
<livewire:sb-tags-input :max-tags="5" />
```

### With Suggestions

```blade
<livewire:sb-tags-input
    :suggestions="['PHP', 'JavaScript', 'Python', 'Ruby', 'Go']"
    placeholder="Select or type a language..."
/>
```

### Allow Duplicates

```blade
<livewire:sb-tags-input :allow-duplicates="true" />
```

### Custom Separator

```blade
<livewire:sb-tags-input separator=";" />
```

### Livewire Props

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `tags` | array | `[]` | Initial tags array |
| `placeholder` | string | `'Add a tag...'` | Input placeholder text |
| `maxTags` | int | `0` | Maximum number of tags (0 = unlimited) |
| `suggestions` | array | `[]` | Autocomplete suggestions |
| `allowDuplicates` | boolean | `false` | Allow duplicate tags |
| `separator` | string | `','` | Character to separate tags on input |

### Events

```blade
<livewire:sb-tags-input @tags-updated="handleTagsUpdate" />
```

The `tags-updated` event includes the current tags array.

## Vue 3 Usage

### Setup

```javascript
import { SbTagsInput } from './vendor/sb-tags-input';
app.component('SbTagsInput', SbTagsInput);
```

### Basic Usage

```vue
<template>
  <SbTagsInput v-model="tags" />
</template>

<script setup>
import { ref } from 'vue';
const tags = ref(['Vue', 'React', 'Angular']);
</script>
```

### With Options

```vue
<template>
  <SbTagsInput
    v-model="tags"
    placeholder="Add technology..."
    :max-tags="10"
    :suggestions="['Docker', 'Kubernetes', 'AWS', 'Azure']"
    @updated="onTagsChange"
  />
</template>
```

### Vue Props

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `modelValue` | Array | `[]` | v-model binding for tags |
| `placeholder` | String | `'Add a tag...'` | Placeholder text |
| `maxTags` | Number | `0` | Max tags (0 = unlimited) |
| `suggestions` | Array | `[]` | Autocomplete options |
| `allowDuplicates` | Boolean | `false` | Allow duplicates |
| `separator` | String | `','` | Input separator |

### Events

| Event | Payload | Description |
|-------|---------|-------------|
| `update:modelValue` | array | Emitted when tags change |
| `updated` | array | Emitted with current tags |
| `tag-added` | string | Emitted when a tag is added |
| `tag-removed` | string | Emitted when a tag is removed |

## Handling Tags in Backend

```php
// In your Livewire component
public array $tags = [];

#[On('tags-updated')]
public function handleTagsUpdate(array $tags): void
{
    $this->tags = $tags;
}

public function save(): void
{
    // Save as JSON
    $model->tags = json_encode($this->tags);

    // Or use Laravel's array cast
    $model->tags = $this->tags;
}
```

## Keyboard Support

- **Enter**: Add current input as tag
- **Comma** (or custom separator): Add tag
- **Backspace**: Remove last tag when input is empty
- **Arrow keys**: Navigate suggestions

## Styling

The tags input includes:
- Pill-style tags with remove button
- Hover effects on tags
- Dropdown suggestions list
- Focus ring on input

## Requirements

- PHP 8.1+
- Laravel 10, 11, or 12
- Tailwind CSS 3.x
- Alpine.js

## License

MIT License
