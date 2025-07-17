<?php

declare(strict_types=1);

namespace Hanafalah\ModuleWorkspace\Events\Contracts;

use Illuminate\Queue\SerializesModels;
use Hanafalah\ModuleWorkspace\Contracts\{
    ModuleWorkspace
};

abstract class WorkspaceEvent
{
    use SerializesModels;

    public mixed $__workspace;
    public ModuleWorkspace $__module_workspace;

    /**
     * Create the event instance.
     *
     * @param  mixed  $workspace
     * @param  \Hanafalah\ModuleWorkspace\Contracts\ModuleWorkspace  $moduleWorkspace
     * @return void
     */
    public function __construct()
    {
        // $this->__workspace        = $workspace;
        // $this->__module_workspace = $moduleWorkspace;
    }
}
