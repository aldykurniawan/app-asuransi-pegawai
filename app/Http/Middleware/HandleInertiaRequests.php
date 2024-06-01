<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;
use Tightenco\Ziggy\Ziggy;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): string|null
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        $ziggyObj     = (new Ziggy)->toArray();
        $getAppPrefix = explode('/', $request->route()->getPrefix());
        if (! in_array('app', $getAppPrefix)) {
            $customRoute = collect($ziggyObj['routes']);
            $routeFilter = $customRoute->filter(function ($item) {
                return ! str_starts_with($item['uri'], 'app');
            })->values();
            $ziggyObj['routes'] = $routeFilter;
        }

        // dd($ziggyObj);
        return array_merge(parent::share($request), [
            'auth' => [
                'user' => $request->user() ? $request->user()->load([

                ]) : null,
            ],
            'auth.can'  => $request->user() ? $request->user()->getPermissionArray() : [],
            'auth.role' => $request->user() ? $request->user()->getRoleArray() : [],

            'flash' => [
                'message'       => $request->session()->get('message'),
                'success'       => $request->session()->get('success'),
                'error'         => $request->session()->get('error'),
                'warning'       => $request->session()->get('warning'),
                'sweet_success' => $request->session()->get('sweet_success'),
                'sweet_error'   => $request->session()->get('sweet_error'),
            ],

            // 'ziggy' => function () use ($ziggyObj, $request) {
            //     return array_merge($ziggyObj, [
            //         'location' => $request->url(),
            //     ]);
            // },
        ]);
    }

    public function rootView(Request $request)
    {
        $getAppPrefix = explode('/', $request->route()->getPrefix());
        if ($request->is('login') || in_array('app', $getAppPrefix) || in_array('accounts', $getAppPrefix)) {
            return 'app';
        }

        // return 'app-frontend';
        return 'app-fe';
    }
}
