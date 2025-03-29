<?php

namespace Hanafalah\ModuleWorkspace\Contracts\Schemas;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Hanafalah\LaravelSupport\Contracts\Supports\DataManagement;
use Hanafalah\ModuleWorkspace\Contracts\Data\WorkspaceData;

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
