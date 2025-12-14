<?php

namespace MrShaneBarron\tags-input;

use Illuminate\Support\ServiceProvider;
use MrShaneBarron\tags-input\Livewire\tags-input;
use MrShaneBarron\tags-input\View\Components\tags-input as Bladetags-input;
use Livewire\Livewire;

class tags-inputServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/ld-tags-input.php', 'ld-tags-input');
    }

    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'ld-tags-input');

        Livewire::component('ld-tags-input', tags-input::class);

        $this->loadViewComponentsAs('ld', [
            Bladetags-input::class,
        ]);

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/ld-tags-input.php' => config_path('ld-tags-input.php'),
            ], 'ld-tags-input-config');

            $this->publishes([
                __DIR__ . '/../resources/views' => resource_path('views/vendor/ld-tags-input'),
            ], 'ld-tags-input-views');
        }
    }
}
