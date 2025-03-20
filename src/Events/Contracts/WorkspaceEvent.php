<?php

declare(strict_types=1);

namespace Zahzah\ModuleWorkspace\Events\Contracts;

use Illuminate\Queue\SerializesModels;
use Projects\Klinik\Models\Workspace\Workspace;
use Zahzah\ModuleWorkspace\Contracts\{
    ModuleWorkspace
};

abstract class WorkspaceEvent
{
    use SerializesModels;

    public Workspace $__workspace;
    public ModuleWorkspace $__module_workspace;

    /**
     * Create the event instance.
     *
     * @param  \Projects\Klinik\Models\Workspace\Workspace  $workspace
     * @param  \Zahzah\ModuleWorkspace\Contracts\ModuleWorkspace  $moduleWorkspace
     * @return void
     */
    public function __construct()
    {
        // $this->__workspace        = $workspace;
        // $this->__module_workspace = $moduleWorkspace;
    }
}
