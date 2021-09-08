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

        if ($request->isMethod('GET') || $request->isMethod('POST')) {
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

        $menu = [];

        if ($user->shippingPoint && $user->can('order.make')) {
            $menu[] = [
                'link' => route('account.order'),
                'title' => 'Заказ товаров',
                'icon' => 'Shopping/Calculator.svg',
                'active' => $request->routeIs('account.order')
            ];
            $menu[] = [
                'link' => route('account.order.codes'),
                'title' => 'Заказ по кодам',
                'icon' => 'Shopping/Barcode-scan.svg',
                'active' => $request->routeIs('account.order.codes')
            ];
        }

        if ($user->can('stocks.view')) {
            $menu[] = [
                'link' => route('account.stock.view'),
                'title' => 'Просмотр наличия',
                'icon' => 'Shopping/Box3.svg',
                'active' => $request->routeIs('account.stock.view')
            ];
        }
        if ($user->can('stocks.search')) {
            $menu[] = [
                'link' => route('account.stock.search'),
                'title' => 'Просмотр наличия по коду',
                'icon' => 'Shopping/Barcode.svg',
                'active' => $request->routeIs('account.stock.search')
            ];
        }
        if ($user->can('stocks.update') && $user->departments()->exists()) {
            $menu[] = [
                'link' => route('account.stock.update.page'),
                'title' => 'Загрузка наличия',
                'icon' => 'Shopping/Loader.svg',
                'active' => $request->routeIs('account.stock.update.page'),
                'separator' => true
            ];
        }
        if ($user->can('goods.update')) {
            $menu[] = [
                'link' => route('account.goods.update'),
                'title' => 'Загрузка товаров',
                'icon' => 'Files/Import.svg',
                'active' => $request->routeIs('account.goods.update')
            ];
        }

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
        if ($user->can('groups.index')) {
            $menu[] = [
                'link' => route('account.groups.index'),
                'title' => 'Группы',
                'icon' => 'Files/Group-folders.svg',
                'active' => \Str::contains($request->route()->getName(), 'groups')
            ];
        }
        if ($user->can('categories.index')) {
            $menu[] = [
                'link' => route('account.categories.index'),
                'title' => 'Категории',
                'icon' => 'Shopping/Price1.svg',
                'active' => \Str::contains($request->route()->getName(), 'categories'),
                'separator' => true
            ];
        }

        if ($user->shippingPoint && $user->can('order.make')) {
            $menu[] = [
                'link' => route('account.cart'),
                'title' => 'Корзина',
                'icon' => 'Shopping/Cart2.svg',
                'active' => $request->routeIs('account.cart'),
                'separator' => true
            ];
        }

        $menu[] = [
            'link' => route('account.dashboard'),
            'title' => 'Главная',
            'icon' => 'Design/PenAndRuller.svg',
            'active' => $request->routeIs('account.dashboard')
        ];
        $menu[] = [
            'link' => route('account.profile.edit'),
            'title' => 'Мой аккаунт',
            'icon' => 'General/Settings-1.svg',
            'active' => $request->routeIs('account.profile.edit')
        ];

        return $menu;
    }
}
