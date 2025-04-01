<?php

namespace Hanafalah\ModuleWorkspace\Models\Workspace;

use Hanafalah\LaravelHasProps\Concerns\HasProps;
use Illuminate\Database\Eloquent\SoftDeletes;
use Hanafalah\LaravelSupport\Models\BaseModel;
use Hanafalah\ModuleRegional\Concerns\HasAddress;
use Hanafalah\ModuleWorkspace\Enums;
use Hanafalah\ModuleWorkspace\Resources\Workspace\ShowWorkspace;
use Hanafalah\ModuleWorkspace\Resources\Workspace\ViewWorkspace;

class Workspace extends BaseModel
{
    use SoftDeletes, HasProps, HasAddress;

    protected $list = [
        'id', 'uuid', 'name', 'status', 'props'
    ];

    protected $casts = [
        'uuid' => 'string',
        'name' => 'string'
    ];

    protected static function booted(): void{
        parent::booted();
        static::creating(function ($query) {
            if (!isset($query->status)) $query->status = Enums\Workspace\Status::ACTIVE->value;
        });
    }

    public function getShowResource(){
        return ShowWorkspace::class;
    }

    public function getViewResource(){
        return ViewWorkspace::class;
    }
}
