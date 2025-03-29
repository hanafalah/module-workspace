<?php

namespace Hanafalah\ModuleWorkspace\Data;

use Hanafalah\LaravelSupport\Supports\Data;
use Hanafalah\ModuleRegional\Data\AddressData;
use Hanafalah\ModuleWorkspace\Contracts\Data\WorkspaceSettingData as DataWorkspaceSettingData;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Attributes\Validation\Email;

class WorkspaceSettingData extends Data implements DataWorkspaceSettingData{
    public function __construct(
        #[MapInputName('address')]
        #[MapName('address')]
        public ?AddressData $address = null,

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