<?php

namespace Modules\Account\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    protected $rootView = 'account::app';

    public function version(Request $request): string
    {
        if (file_exists($manifest = public_path('/dist/mix-manifest.json'))) {
            return md5_file($manifest);
        }

        return 'hash-error';
    }

    public function share(Request $request): array
    {
        $shared = [
            'flash' => null
        ];

        if ($request->isMethod('GET')) {
            $shared = [
                'common' => [
                    'meta' => fn() => [
                        'title' => \SEOMeta::getTitle()
                    ],
                ]
            ];

            if ($user = \Auth::user()) {
                $shared['common']['auth'] = $user->only(['name', 'email']);
            }

            if ($flash = \Session::get('flash')) {
                $shared['flash'] = $flash;
            }
            if ($data = \Session::get('data')) {
                $shared['data'] = $data;
            }
        }

        return array_merge(parent::share($request), $shared);
    }
}
