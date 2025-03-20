<?php

namespace Zahzah\ModuleWorkspace\Commands;

class InstallMakeCommand extends EnvironmentCommand{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'module-workspace:install';


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command ini digunakan untuk installing awal workspace module';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $provider = 'Zahzah\ModuleWorkspace\ModuleWorkspaceServiceProvider';

        $this->callSilent('vendor:publish', [
            '--provider' => $provider,
            '--tag'      => 'migrations'
        ]);
        $this->info('✔️  Created migrations');

        $migrations = $this->setMigrationBasePath(database_path('migrations'))->canMigrate();
        $this->callSilent('migrate', [
            '--path' => $migrations
        ]);
        $this->info('✔️  Module Workspace tables migrated');

        $this->comment('zahzah/module-workspace installed successfully.');
    }
}