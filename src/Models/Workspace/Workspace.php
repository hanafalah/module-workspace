<?php

namespace Zahzah\ModuleWorkspace\Models\Workspace;

use Zahzah\LaravelHasProps\Concerns\HasProps;
use Illuminate\Database\Eloquent\SoftDeletes;
use Zahzah\LaravelSupport\Concerns\Support\HasEncoding;
use Zahzah\LaravelSupport\Models\BaseModel;
use Zahzah\ModuleWorkspace\Enums;
use Zahzah\ModuleWorkspace\Events;
use Zahzah\ModuleWorkspace\Resources\Workspace\ShowWorkspace;

class Workspace extends BaseModel{
    use SoftDeletes, HasProps, HasEncoding;

    protected $fillable = [
        'id','uuid','name','status','props'
    ];

    protected static function booted(): void{
        parent::booted();
        static::creating(function($query){
            if (!isset($query->status)) $query->status = Enums\Workspace\WorkspaceStatus::DRAFT->value;
        });
    }

    public function toShowApi(){
        return new ShowWorkspace($this);
    }

    //EIGER SECTION
    public function address(){return $this->morphOneModel('Address','model');}
    public function addresses(){return $this->morphManyModel('Address','model');}

    //END EIGER SECTION

    protected $dispatchesEvents = [
        'saving'   => Events\SavingWorkspace::class,
        'saved'    => Events\WorkspaceSaved::class,
        'creating' => Events\CreatingWorkspace::class,
        'created'  => Events\WorkspaceCreated::class,
        'updating' => Events\UpdatingWorkspace::class,
        'updated'  => Events\WorkspaceUpdated::class,
        'deleting' => Events\DeletingWorkspace::class,
        'deleted'  => Events\WorkspaceDeleted::class,
    ];
}