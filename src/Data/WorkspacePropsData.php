<?php

namespace Hanafalah\ModuleWorkspace\Data;

use Hanafalah\LaravelSupport\Supports\Data;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\MapName;

class WorkspacePropsData extends Data{
    public function __construct(
        #[MapInputName('setting')]
        #[MapName('setting')]
        public ?WorkspaceSettingData $setting = null,
    ){}
}