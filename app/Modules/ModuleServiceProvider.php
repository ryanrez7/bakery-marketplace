<?php

namespace App\Modules;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use ReflectionClass;

abstract class ModuleServiceProvider extends ServiceProvider
{
    // alias modul untuk nama view, mis. 'admin' -> view('admin::dashboard')
    abstract protected function moduleAlias(): string;

    public function boot(): void
    {
        $path = $this->modulePath();

        $this->loadViewsFrom($path.'/resources/views', $this->moduleAlias());

        Livewire::addNamespace(
            namespace: $this->moduleAlias(),
            viewPath: $path.'/resources/views/livewire',
        );

        // semua file di folder routes milik modul dimuat otomatis
        foreach (glob($path.'/routes/*.php') ?: [] as $routeFile) {
            $this->loadRoutesFrom($routeFile);
        }
    }

    // folder modul = folder tempat provider turunan berada
    protected function modulePath(): string
    {
        return dirname((string) (new ReflectionClass($this))->getFileName());
    }
}