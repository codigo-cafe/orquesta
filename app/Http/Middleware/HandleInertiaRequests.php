<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     * @var string
     */
    protected $rootView = 'client';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function version(Request $request)
    {
        return parent::version($request);
    }

    /**
     * Defines the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function share(Request $request)
    {
        return array_merge(parent::share($request), [
            // Lazily
            'auth' => ['user' => fn () => $request->user() ? $request->user()->load('person', 'roles') : null,
                'can' => fn () => $request->user() ? $request->user()->getPermissionArray() : [],
            ],
        ]);
    }

    public function rootView(Request $request)
    {
        if ($request->getPathInfo() == '/' || $request->getPathInfo() == '/galeria' || $request->getPathInfo() == '/integrantes' || $request->getPathInfo() == '/director' || $request->getPathInfo() == '/historia' || $request->getPathInfo() == '/calendario' || strpos($request->getPathInfo(), 'eventos/') || $request->getPathInfo() == '/contacto') {
            return 'client';
        }
        return 'admin';
    }
}
