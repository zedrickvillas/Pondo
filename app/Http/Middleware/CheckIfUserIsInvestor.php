<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class CheckIfUserIsInvestor
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
        if (!$request->user()) {
            return redirect('/register?role=investor');
        } elseif (!$request->user()->hasRole('investor')) {
            return back()->with('error', 'You must be registered as an investor to do that action.');
        }
        return $next($request);
    }
}
