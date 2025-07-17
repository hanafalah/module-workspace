<?php

namespace Hanafalah\ModuleWorkspace\Data;

use Hanafalah\LaravelSupport\Supports\Data;
use Hanafalah\ModuleRegional\Data\AddressData;
use Hanafalah\ModuleWorkspace\Contracts\Data\StakeholderData;
use Hanafalah\ModuleWorkspace\Contracts\Data\WorkspaceSettingData as DataWorkspaceSettingData;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Attributes\Validation\Email;
use Illuminate\Support\Str;

class WorkspaceSettingData extends Data implements DataWorkspaceSettingData{
    #[MapInputName('address')]
    #[MapName('address')]
    public ?AddressData $address = null;

    #[Email]
    #[MapInputName('email')]
    #[MapName('email')]
    public ?string $email = null;
    
    #[MapInputName('phone')]
    #[MapName('phone')]
    public ?string $phone = null;

    #[MapInputName('logo')]
    #[MapName('logo')]
    public mixed $logo = null;

    #[MapInputName('license')]
    #[MapName('license')]
    public mixed $license = null;

    #[MapInputName('stakeholder')]
    #[MapName('stakeholder')]
    public ?StakeholderData $stakeholder = null;

    #[MapInputName('props')]
    #[MapName('props')]
    public ?array $props = null;

    public static function after(self $data): self{
        $data->phone = $data->phone ? preg_replace('/\D/', '', $data->phone) : null;
        return $data;
    }
    
}