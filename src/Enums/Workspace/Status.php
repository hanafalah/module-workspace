<?php

namespace Hanafalah\ModuleWorkspace\Enums\Workspace;

enum Status: int
{
    case ACTIVE    = 1;
    case INACTIVE  = 2;
    case SUPSENDED = 3;
    case DRAFT     = 0;
}
