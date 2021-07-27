<?php

namespace Modules\Account\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    protected $rootView = 'admin::app';

    public function version(Request $request): string
    {
        if (file_exists($manifest = public_path('/admin/dist/mix-manifest.json'))) {
            return md5_file($manifest);
        }

        return 'hash-error';
    }

    public function share(Request $request): array
    {
        $shared = [
            'metaInfo' => fn() => [
                'title' => \SEOMeta::getTitle()
            ]
        ];

        return array_merge(parent::share($request), $shared);
    }
}
