<?php

namespace App\Traits;

use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Http\RedirectResponse;

trait RateLimitTrait
{
    protected function checkThrottle(string $key, int $maxAttempts = 10, int $decaySeconds = 60, ?array $inputFields = null)
    {
        if(RateLimiter::tooManyAttempts($key, $maxAttempts))
        {
            $seconds = RateLimiter::availableIn($key);

            $errorMessage = "Слишком много попыток. Попробуйте снова через {$seconds} секунд.";

            return back()->withErrors(['name' => $errorMessage]);

        }

        RateLimiter::hit($key, $decaySeconds);
        return null;
        
    }
}