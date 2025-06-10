<?php

namespace Hanafalah\ModuleWorkspace\Schemas;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Hanafalah\LaravelSupport\Supports\PackageManagement;
use Hanafalah\ModuleWorkspace\Contracts\Schemas\Workspace as ContractsWorkspace;
use Hanafalah\ModuleWorkspace\Contracts\Data\WorkspaceData;

class Workspace extends PackageManagement implements ContractsWorkspace
{
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
        $add = [
            'name' => $workspace_dto->name, 
            'status' => $workspace_dto->status
        ];
        if (isset($workspace_dto->uuid)){
            $guard = ['uuid' => $workspace_dto->uuid];
            $create = [$guard,$add];
        }else{
            $create = [$add];
        }
        $model = $this->WorkspaceModel()->updateOrCreate(...$create);
        if (isset($workspace_dto->props->setting->address)) {
            $address             = &$workspace_dto->props->setting->address;
            $address->model_type = $model->getMorphClass();
            $address->model_id   = $model->getKey(); 
            $address_model       = $this->schemaContract('address')->prepareStoreAddress($address);
            $address->id         = $address_model->getKey();
            unset($address->props);
        }
        if (isset($workspace_dto->props->setting->logo)) {
            $logo = &$workspace_dto->props->setting->logo;
            $logo = $model->setupFile($logo);
        }
        // $license = &$workspace_dto->props->setting->license;
        // $license = $model->setupFile($license);
        // unset($workspace_dto->props->setting->logo, $workspace_dto->props->setting->license);
        $this->fillingProps($model,$workspace_dto->props);
        $model->save();
        static::$workspace_model = $model;
        $this->forgetTags('workspace');
        return $model;
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
}
