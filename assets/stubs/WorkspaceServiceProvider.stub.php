<?php

declare(strict_types=1);

namespace App\Providers;

use Hanafalah\LaravelSupport\Facades\LaravelSupport;
use Illuminate\Support\ServiceProvider;
use Hanafalah\ModuleWorkspace\Events;

class WorkspaceServiceProvider extends ServiceProvider
{
    // By default, no namespace is used to support the callable array syntax.
    public static string $controllerNamespace = '';

    public function events()
    {
        return [
            Events\SavingWorkspace::class => [

            ],
            Events\WorkspaceSaved::class => [

            ],
            Events\CreatingWorkspace::class => [

            ],
            Events\WorkspaceCreated::class => [
                function(){
                    dd();
                }
            ],
            Events\UpdatingWorkspace::class => [

            ],
            Events\WorkspaceUpdated::class => [

            ],
            Events\DeletingWorkspace::class => [

            ],
            Events\WorkspaceDeleted::class => [

            ],
        ];
    }

    public function boot(){
        $this->bootEvents();
    }

    protected function bootEvents(){
        LaravelSupport::eventPipelines($this);
    }
}
