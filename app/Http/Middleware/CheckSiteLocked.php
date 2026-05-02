<?php

namespace App\Http\Middleware;

use App\Models\SiteSetting;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckSiteLocked
{
    public function handle(Request $request, Closure $next): Response
    {
        if (SiteSetting::isLocked()) {
            $reason = SiteSetting::lockReason();
            return response()->view('maintenance', compact('reason'), 503);
        }

        return $next($request);
    }
}
