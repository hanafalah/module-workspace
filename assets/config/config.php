<?php 

use Hanafalah\ModuleWorkspace\Commands;

return [  
    'namespace' => 'Hanafalah\\ModuleWorkspace',
    'app' => [
        'contracts' => [
            //ADD YOUR CONTRACTS HERE
        ],
    ],
    'libs' => [
        'model' => 'Models',
        'contract' => 'Contracts',
        'schema' => 'Schemas',
        'database' => 'Database',
        'data' => 'Data',
        'resource' => 'Resources',
        'migration' => '../assets/database/migrations'
    ],
    'database' => [
        'models' => [
            //ADD YOUR MODELS HERE
        ]
    ],
    'commands' => [
        Commands\InstallMakeCommand::class
    ],
    'stakeholder'  => 'Employee',
];