<?php

namespace Zahzah\ModuleWorkspace;

use Closure;use Zahzah\LaravelSupport\Providers\BaseServiceProvider;

class ModuleWorkspaceServiceProvider extends BaseServiceProvider{
    public function register(){
        $this->registerMainClass(ModuleWorkspace::class)
             ->registerCommandService(Providers\CommandServiceProvider::class)
             ->registers([
                '*','Services' => function(){
                    $this->binds([
                        Contracts\ModuleWorkspace::class => ModuleWorkspace::class,
                        Contracts\Workspace::class       => Schemas\Workspace::class
                    ]);
                }
            ]);
    }    

    protected function dir(): string{
        return __DIR__.'/';
    }
}