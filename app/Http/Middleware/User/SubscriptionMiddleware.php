<?php

namespace App\Http\Middleware\User;

use Closure;

class SubscriptionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!$request->user()->subscription->status) {
            return redirect(route('home'));
        }

        return $next($request);
    }
}
