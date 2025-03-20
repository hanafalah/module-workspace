<?php 

use Hanafalah\ModuleWorkspace\Models as ModuleWorkspaceModels;

return [    
    'database' => [
        'models' => [
            'Workspace'   => ModuleWorkspaceModels\Workspace\Workspace::class
        ]
    ]
];