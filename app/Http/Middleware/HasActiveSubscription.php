<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class HasActiveSubscription
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->user()?->subscription(User::STRIPE_SUBSCRIPTION_NAME)?->active() || $request->user()->onTrial()) {
            return $next($request);
        }

        return redirect()->route('subscriptions.edit');
    }
}
