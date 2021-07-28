<?php

namespace Modules\Account\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Inertia\Response;
use Modules\Account\Http\Requests\LoginRequest;
use Modules\Account\Notifications\ResetPassword;

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

    public function reset(Request $request): Response
    {
        $this->seo()->setTitle('Восстановление пароля');

        return inertia('Auth/PasswordReset');
    }

    public function tryReset(Request $request): RedirectResponse
    {
        $this->validate($request, ['email' => ['required', 'email', 'exists:users,email']]);

        if ($user = User::where('email', '=', $request->input('email'))->first()) {
            $password = \Str::random(8);
            if ($user->update(['password' => \Hash::make($password)])) {
                $user->notify(new ResetPassword($password));
                $user->tokens()->delete();
            }
        }

        return back();
    }
}
