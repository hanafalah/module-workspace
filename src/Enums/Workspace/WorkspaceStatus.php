<?php

namespace Zahzah\ModuleWorkspace\Enums\Workspace;

enum WorkspaceStatus: int
{
    case ACTIVE    = 1;
    case INACTIVE  = 2;
    case SUPSENDED = 3;
    case DRAFT     = 0;
}