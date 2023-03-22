<?php

namespace App\Http\Middleware;

use Closure;

class Administrator
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null) {
        // если это не администратор — показываем 404 Not Found
        if ( ! auth()->user()->admin) {
            abort(404);
        }
        return $next($request);
    }
}
