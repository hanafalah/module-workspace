<?php

namespace Hanafalah\ModuleWorkspace;

use Hanafalah\LaravelSupport\Providers\BaseServiceProvider;

class ModuleWorkspaceServiceProvider extends BaseServiceProvider
{
    public function register()
    {
        $this->registerMainClass(ModuleWorkspace::class)
            ->registerCommandService(Providers\CommandServiceProvider::class)
            ->registers([
                '*'
            ]);                                
    }

    protected function dir(): string
    {
        return __DIR__ . '/';
    }
}
