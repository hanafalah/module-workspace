<?php

namespace Hanafalah\ModuleWorkspace\Contracts;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Hanafalah\LaravelSupport\Contracts\DataManagement;

/**
 * @see \Hanafalah\ModuleWorkspace\Models\Workspace
 * @mixin \Illuminate\Database\Eloquent\Model
 */
interface Workspace extends DataManagement
{
}
