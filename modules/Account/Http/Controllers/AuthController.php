<?php

namespace Modules\Account\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Inertia\Response;
use Modules\Account\Http\Requests\LoginRequest;

class AuthController extends Controller
{
    public function login(): Response
    {
        $this->seo()->setTitle('Вход');

        return inertia('Auth/Login');
    }

    public function try(LoginRequest $request): \Illuminate\Http\Response
    {
        $request->authenticate();

        if (!$request->user()->can('account.access')) {
            \Auth::logout();
            throw ValidationException::withMessages([
                'email' => 'У вас нет доступа в личный кабинет.',
            ]);
        }

        $request->session()->regenerate();

        return inertia()->location('/');
    }

    public function logout(Request $request): RedirectResponse
    {
        \Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('account.login');
    }
}
