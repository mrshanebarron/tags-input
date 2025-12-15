<?php

namespace MrShaneBarron\TagsInput;

use Illuminate\Support\ServiceProvider;
use MrShaneBarron\TagsInput\Livewire\TagsInput;
use MrShaneBarron\TagsInput\View\Components\TagsInput as BladeTagsInput;

class TagsInputServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/sb-tags-input.php', 'sb-tags-input');
    }

    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'sb-tags-input');

        if (class_exists(\Livewire\Livewire::class)) {
            \Livewire\Livewire::component('sb-tags-input', TagsInput::class);
        }

        $this->loadViewComponentsAs('ld', [
            BladeTagsInput::class,
        ]);

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/sb-tags-input.php' => config_path('sb-tags-input.php'),
            ], 'sb-tags-input-config');

            $this->publishes([
                __DIR__ . '/../resources/views' => resource_path('views/vendor/sb-tags-input'),
            ], 'sb-tags-input-views');
        }
    }
}
