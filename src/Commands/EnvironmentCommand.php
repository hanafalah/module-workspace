<?php

namespace Zahzah\ModuleWorkspace\Commands;

use Zahzah\LaravelSupport\Concerns\ServiceProvider\HasMigrationConfiguration;

class EnvironmentCommand extends \Zahzah\LaravelSupport\Commands\BaseCommand{
    use HasMigrationConfiguration;

    protected function dir(): string{
        return __DIR__.'/../';
    }
}
