<?php

namespace Hanafalah\ModuleWorkspace\Data;

use Hanafalah\LaravelSupport\Supports\Data;
use Hanafalah\ModuleRegional\Data\AddressData;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\MapName;

class WorkspaceData extends Data{
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
    ){}
}