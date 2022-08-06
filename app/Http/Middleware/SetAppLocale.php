<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class SetAppLocale
{
    public function handle(Request $request, Closure $next)
    {
        if($request->has('locale') && in_array($request->input('locale'), config('translatable.locales'))) {
            app()->setLocale($request->input('locale'));
        }

        return $next($request);
    }
}
