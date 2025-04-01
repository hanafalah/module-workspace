<?php

namespace Hanafalah\ModuleWorkspace\Data;

use Hanafalah\LaravelSupport\Supports\Data;
use Hanafalah\ModuleWorkspace\Contracts\Data\WorkspaceData as DataWorkspaceData;
use Hanafalah\ModuleWorkspace\Contracts\Data\WorkspacePropsData;
use Hanafalah\ModuleWorkspace\Enums\Workspace\Status;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\MapName;

class WorkspaceData extends Data implements DataWorkspaceData{
    public function __construct(
        #[MapInputName('uuid')]
        #[MapName('uuid')]
        public ?string $uuid = null,
    
        #[MapInputName('name')]
        #[MapName('name')]
        public string $name,
    
        #[MapInputName('status')]
        #[MapName('status')]
        public ?string $status = null,
        
        #[MapInputName('props')]
        #[MapName('props')]
        public ?WorkspacePropsData $props = null
    ){
        if (isset($this->uuid) && !isset($this->status)){
            $workspace = $this->WorkspaceModel()->uuid($this->uuid)->first();
            $this->status = $workspace->status ?? Status::DRAFT->value;
        }else{
            $this->status = Status::DRAFT->value;
        }
    }
}