<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class VerifyRoute
{
    protected $rutas = [
        '/api/categories',
        '/api/events',
        '/api/classifications',
        '/api/instruments',
        '/api/colors',
        '/api/sizes',
        '/api/sizes/*',
        '/api/product/{id}/size/{detail_id}',
        '/api/patterns',
        '/api/materials',
        '/api/occasions',
        '/api/collections',
        '/api/trends',
        '/api/municipalities',
        '/api/managers',
    ];
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $prefer = $request->prefers(['text/html', 'application/json']);
        if ($prefer == "text/html" || in_array($request->getRequestUri(), $this->rutas)) {
            return abort(404);
        }
        return $next($request);
    }
}
