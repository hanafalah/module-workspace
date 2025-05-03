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
                '*',
                'Provider' => function () {
                    $this->validProviders([
                        app_path('Providers/WorkspaceServiceProvider.php') => 'App\Providers\WorkspaceServiceProvider',
                    ]);
                },
                'Namespace' => function () {
                    $this->publishes([
                        $this->getAssetPath('stubs/WorkspaceServiceProvider.stub.php') => app_path('Providers/WorkspaceServiceProvider.stub.php'),
                    ], 'providers');
                }
            ]);                                
    }

    protected function dir(): string
    {
        return __DIR__ . '/';
    }
}
