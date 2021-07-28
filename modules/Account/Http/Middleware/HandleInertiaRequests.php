<?php

namespace Modules\Account\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    protected $rootView = 'account::app';

    public function version(Request $request): string
    {
        if (file_exists($manifest = public_path('/admin/dist/mix-manifest.json'))) {
            return md5_file($manifest);
        }

        return 'hash-error';
    }

    public function share(Request $request): array
    {
        $shared = [];
        if ($request->isMethod('GET')) {
            $shared = [
                'metaInfo' => fn() => [
                    'title' => \SEOMeta::getTitle()
                ]
            ];
        }
        if ($flash = \Session::get('flash')) {
            $shared['flash'] = $flash;
        }

        return array_merge(parent::share($request), $shared);
    }
}
