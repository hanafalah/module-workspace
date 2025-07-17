<?php

namespace Hanafalah\ModuleWorkspace;

use Hanafalah\LaravelSupport\{
    Supports\PackageManagement
};
use Hanafalah\ModuleWorkspace\Contracts\ModuleWorkspace as ContractsModuleWorkspace;

class ModuleWorkspace extends PackageManagement implements ContractsModuleWorkspace {}
