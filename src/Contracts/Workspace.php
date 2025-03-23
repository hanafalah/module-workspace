<?php

namespace Hanafalah\ModuleWorkspace\Contracts;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Hanafalah\LaravelSupport\Contracts\DataManagement;
use Hanafalah\ModuleWorkspace\Data\WorkspaceData;

/**
 * @see \Hanafalah\ModuleWorkspace\Models\Workspace
 * @mixin \Illuminate\Database\Eloquent\Model
 */
interface Workspace extends DataManagement
{
    public function getWorkspace(): mixed;
    public function storeWorkspace(?WorkspaceData $workspace_dto = null): array;
    public function prepareStoreWorkspace(WorkspaceData $workspace_dto): Model;
    public function prepareShowWorkspace(?Model $model = null, ? array $attributes = null): ?Model;
    public function showWorkspace(?Model $model = null): array;
    public function workspace(mixed $conditionals = null): Builder;
}
