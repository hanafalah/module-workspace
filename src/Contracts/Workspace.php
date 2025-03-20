<?php

namespace Zahzah\ModuleWorkspace\Contracts;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Zahzah\LaravelSupport\Contracts\DataManagement;

/**
 * @see \Zahzah\ModuleWorkspace\Models\Workspace
 * @mixin \Illuminate\Database\Eloquent\Model
 */
interface Workspace extends DataManagement{
    public function addOrChange(? array $attributes= null): self;
    public function storeWorkspace(): array;
    public function prepareStoreWorkspace(? array $attributes = null): Model ;
    public function prepareShowWorkspace(? Model $model = null): ?Model;
    public function showWorkspace(? Model $model = null): array;
    public function workspace(mixed $conditionals = null): Builder;
}