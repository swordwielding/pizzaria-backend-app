<?php

namespace App\Traits;

use Illuminate\Support\Facades\Http;
use Throwable;
use Illuminate\Support\Facades\Log;

trait ClearFrontendCacheTrait
{
    protected function clearFrontendCache(string $key)
    {
        $url = config('app.frontend_url') . '/api/clear-cache';

        Http::timeout(3)->post($url, compact('key'));
    }

}
