<?php

namespace Zahzah\ModuleWorkspace\Schemas;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Zahzah\LaravelSupport\Supports\PackageManagement;
use Zahzah\ModuleWorkspace\Contracts\Workspace as ContractsWorkspace;
use Zahzah\ModuleRegional\Enums\Address\Flag;
use Zahzah\ModuleWorkspace\Resources\Workspace\ShowWorkspace;

class Workspace extends PackageManagement implements ContractsWorkspace{
    protected array $__guard        = ['uuid']; 
    protected array $__add          = ['name','status'];
    protected string $__entity      = 'Workspace';
    public static $workspace_model;

    protected array $__resources = [
        'show' => ShowWorkspace::class
    ];

    protected array $__cache = [
        'show' => [
            'name'     => 'workspace',
            'tags'     => ['workspace','workspace-show'],
            'forever'  => true
        ]
    ];

    public function addOrChange(? array $attributes= null): self{    
        $this->prepareStoreWorkspace($attributes);
        return $this;
    }

    public function storeWorkspace(): array{
        return $this->transaction(function() {
            $workspace = $this->prepareStoreWorkspace();
            $workspace->refresh();
            return $this->showWorkspace($workspace);
        });
    }

    public function prepareStoreWorkspace(? array $attributes = null): Model {
        $attributes ??= request()->all();

        $model = request()->has('uuid') ? $this->workspace()->uuid(request()->uuid)->first() : $this->WorkspaceModel();
        $lists = ['faskes_code','email','phone'];
        foreach ($lists as $list) {
            $model->{$list} = $attributes[$list] ?? null;
        }
        $model->save();

        if (isset($attributes['address'])){
            $model->address()->updateOrCreate([
                'model_type' => $model->getMorphClass(),
                'model_id'   => $model->getKey(),
                'flag'       => Flag::OTHER->value
            ],[
                'name' => $attributes['address']['name']
            ]);
        }
        static::$workspace_model = $model;
        $this->forgetTags('workspace');
        return $model;
    }

    protected function showUsingRelation(){
        return ['address'];
    }

    public function prepareShowWorkspace(? Model $model = null): ?Model{
        $this->booting();
        $model ??= $this->getWorkspace();
        $uuid = request()->uuid;
        if (!request()->has('uuid')) throw new \Exception('No uuid provided',422);

        $this->addSuffixCache($this->__cache['show'],"workspace-show",$uuid);
        return $this->cacheWhen(!$this->isSearch(),$this->__cache['show'],function() use ($model, $uuid){
            if (!isset($model)){
                $model = $this->workspace()->with($this->showUsingRelation())->uuid($uuid)->first();
            }else{
                $model->load($this->showUsingRelation());
            }
            return static::$workspace_model = $model;
        });
    }

    public function showWorkspace(? Model $model = null): array{
        return $this->transforming($this->__resources['show'],$this->prepareShowWorkspace($model));
    }

    public function workspace(mixed $conditionals = null): Builder{
        return $this->WorkspaceModel()->withParameters()->conditionals($conditionals);
    }
}
