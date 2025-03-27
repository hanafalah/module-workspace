<?php

namespace Hanafalah\ModuleWorkspace\Data;

use Hanafalah\LaravelSupport\Supports\Data;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Attributes\Validation\Email;

class WorkspacePropsData extends Data{
    public function __construct(
        #[Email]
        #[MapInputName('email')]
        #[MapName('email')]
        public ?string $email = null,
    
        #[MapInputName('phone')]
        #[MapName('phone')]
        public ?string $phone = null,
    ){
        $this->phone = $phone ? preg_replace('/\D/', '', $phone) : null;
    }
}