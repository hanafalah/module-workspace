<?php

namespace Hanafalah\ModuleWorkspace\Enums\Workspace;

enum Status: string
{
    case ACTIVE    = 'ACTIVE';
    case INACTIVE  = 'INACTIVE';
    case SUPSENDED = 'SUPSENDED';
    case DRAFT     = 'DRAFT';
}
