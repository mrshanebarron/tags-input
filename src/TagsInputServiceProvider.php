<?php

namespace MrShaneBarron\TagsInput;

use Illuminate\Support\ServiceProvider;

class TagsInputServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/tags-input.php', 'sb-tags-input');
    }

    public function boot(): void
    {
        if (class_exists(\Livewire\Livewire::class)) {
            \Livewire\Livewire::component('sb-tags-input', Livewire\TagsInput::class);
        }

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'sb-tags-input');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/tags-input.php' => config_path('sb-tags-input.php'),
            ], 'sb-tags-input-config');
        }
    }
}
