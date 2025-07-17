<?php

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

if (! function_exists('workspace_identifier')) {
    function workspace_identifier($name) {
        $cache_driver = config('cache.default');
        switch ($cache_driver) {
            case 'redis':
                
            break;
            default:
            break;
        }
    }
}