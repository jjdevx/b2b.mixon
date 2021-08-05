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
                    'auth' => function () use ($request) {
                        if (!\Auth::check()) {
                            return;
                        }

                        $user = $request->user('web');
                        $data = $user->only(['id', 'name', 'surname', 'email', 'icon']);

                        $data['permissions'] = $user->getAllPermissions()->pluck('name');

                        return $data;
                    },
                    'menu' => \Auth::check() ? $this->menu($request) : []
                ]
            ];

            if ($flash = \Session::get('flash')) {
                $shared['flash'] = $flash;
            }
            if ($flash = \Session::get('toast')) {
                $shared['toast'] = $flash;
            }
            if ($data = \Session::get('data')) {
                $shared['data'] = $data;
            }
        }

        return array_merge(parent::share($request), $shared);
    }

    protected function menu(Request $request): array
    {
        $user = \Auth::user();

        $menu = [
            [
                'link' => route('account.dashboard'),
                'title' => 'Главная',
                'icon' => 'Design/PenAndRuller.svg',
                'active' => $request->routeIs('account.dashboard')
            ],
            [
                'link' => route('account.profile.edit'),
                'title' => 'Мой аккаунт',
                'icon' => 'General/Settings-1.svg',
                'active' => $request->routeIs('account.profile.edit')
            ]
        ];

        if ($user->can('users.index')) {
            $menu[] = [
                'link' => route('account.users.index'),
                'title' => 'Пользователи',
                'icon' => 'General/User.svg',
                'active' => \Str::contains($request->route()->getName(), 'users')
            ];
        }
        if ($user->can('departments.index')) {
            $menu[] = [
                'link' => route('account.departments.index'),
                'title' => 'Отделы',
                'icon' => 'Home/Building.svg',
                'active' => \Str::contains($request->route()->getName(), 'departments')
            ];
        }

        return $menu;
    }
}
