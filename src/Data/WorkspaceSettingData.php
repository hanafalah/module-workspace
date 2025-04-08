<?php

namespace Hanafalah\ModuleWorkspace\Data;

use Hanafalah\LaravelSupport\Supports\Data;
use Hanafalah\ModuleRegional\Data\AddressData;
use Hanafalah\ModuleWorkspace\Contracts\Data\WorkspaceSettingData as DataWorkspaceSettingData;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Attributes\Validation\Email;

class WorkspaceSettingData extends Data implements DataWorkspaceSettingData{
    #[MapInputName('address')]
    #[MapName('prop_address')]
    public ?AddressData $prop_address = null;

    #[Email]
    #[MapInputName('email')]
    #[MapName('email')]
    public ?string $email = null;
    
    #[MapInputName('phone')]
    #[MapName('phone')]
    public ?string $phone = null;

    public static function after(WorkspaceSettingData $data): WorkspaceSettingData{
        $data->phone = $data->phone ? preg_replace('/\D/', '', $data->phone) : null;
        return $data;
    }
}