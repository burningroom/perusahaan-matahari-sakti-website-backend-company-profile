<?php
namespace App\Traits;

use Throwable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Request;

trait HandleLog
{
    public function makeLog(Throwable $e, string $type = 'error', ?string $title = null): void
    {
        $context = [
            'title' => $title ?? strtoupper($type),
            'exception' => get_class($e),
            'message' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine(),
            'env' => App::environment(),
            'request' => [
                'url' => Request::fullUrl(),
                'method' => Request::method(),
                'payload' => Request::all(),
                'ip' => Request::ip(),
            ],
        ];
        if (!App::environment('production')) {
            $context['trace'] = $e->getTraceAsString();
        }

        match ($type) {
            'error' => Log::error($title ?? $e->getMessage(), $context),
            'warning' => Log::warning($title ?? $e->getMessage(), $context),
            'notice' => Log::notice($title ?? $e->getMessage(), $context),
            'debug' => Log::debug($title ?? $e->getMessage(), $context),
            default => Log::info($title ?? $e->getMessage(), $context),
        };
    }
}
