<?php

namespace Hanafalah\ModuleWorkspace\Schemas;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Hanafalah\LaravelSupport\Supports\PackageManagement;
use Hanafalah\ModuleWorkspace\Contracts\Schemas\Workspace as ContractsWorkspace;
use Hanafalah\ModuleWorkspace\Data\WorkspaceData;

class Workspace extends PackageManagement implements ContractsWorkspace
{
    protected array $__guard        = ['uuid'];
    protected array $__add          = ['name', 'status'];
    protected string $__entity      = 'Workspace';
    public static $workspace_model;

    protected array $__cache = [
        'show' => [
            'name'     => 'workspace',
            'tags'     => ['workspace', 'workspace-show'],
            'forever'  => true
        ]
    ];

    public function storeWorkspace(?WorkspaceData $workspace_dto = null): array{
        return $this->transaction(function() use ($workspace_dto){
            return $this->showWorkspace($this->prepareStoreWorkspace($workspace_dto ?? $this->requestDTO(WorkspaceData::class)));
        });
    }

    public function prepareStoreWorkspace(WorkspaceData $workspace_dto): Model{
        if (isset($workspace_dto->uuid)){
            $guard = ['uuid' => $workspace_dto->uuid];
        }
        $model = $this->WorkspaceModel()->updateOrCreate($guard ?? [], [
            'name' => $workspace_dto->name, 'status' => $workspace_dto->status
        ]);
        $model->fill($workspace_dto->props->toArray());
        $model->save();

        if (isset($workspace_dto->address)) {
            $address             = &$workspace_dto->address;
            $address->model_type = $model->getMorphClass();
            $address->model_id   = $model->getKey(); 
            $this->schemaContract('address')->prepareStoreAddress($address);
        }
        static::$workspace_model = $model;
        $this->forgetTags('workspace');
        return $model;
    }

    protected function showUsingRelation(){
        return ['address'];
    }

    public function getWorkspace(): mixed{
        return static::$workspace_model;
    }

    public function prepareShowWorkspace(?Model $model = null, ? array $attributes = null): ?Model{
        $attributes ??= request()->all();

        $model ??= $this->getWorkspace();
        if (!isset($model)){
            $uuid = request()->uuid;
            if (!isset($uuid)) throw new \Exception('No uuid provided', 422);
            $model = $this->workspace()->with($this->showUsingRelation())->uuid($uuid)->firstOrFail();
        }else{
            $model->load($this->showUsingRelation());
        }
        return static::$workspace_model = $model;
    }

    public function showWorkspace(?Model $model = null): array{
        return $this->showEntityResource(function() use ($model){
            return $this->prepareShowWorkspace($model);
        });
    }

    public function workspace(mixed $conditionals = null): Builder{
        $this->booting();
        return $this->WorkspaceModel()->withParameters()->conditionals($this->mergeCondition($conditionals ?? []));
    }
}
