<?php

namespace Modules\Account\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Events\Verified;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Validation\ValidationException;
use Inertia\Response;
use Modules\Account\Http\Requests\LoginRequest;
use Modules\Account\Http\Requests\RegisterRequest;
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

    public function register(): Response
    {
        $this->seo()->setTitle('Регистрация');

        return inertia('Auth/Register');
    }

    public function tryRegister(RegisterRequest $request): RedirectResponse
    {
        $user = User::create(array_merge($request->except('password'), [
            'password' => \Hash::make($request->input('password'))
        ]));

        event(new Registered($user));

        \Auth::guard()->login($user, true);

        return redirect()->route('account.dashboard')->with('flash', [
            'text' => 'Замечательно! Вам на почту было отправлено письмо для подтверждения аккаунта.',
            'icon' => 'success',
            'timer' => 4000
        ]);
    }

    public function verify(EmailVerificationRequest $request): RedirectResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->route('account.dashboard')->with('flash', [
                'text' => 'Ваша почта уже была подтверждена.',
                'icon' => 'warning',
                'timer' => 4000
            ]);
        }

        $request->fulfill();

        return redirect()->route('account.dashboard')->with('flash', [
            'text' => 'Ваша почта подтверждена.',
            'icon' => 'success',
            'timer' => 4000
        ]);
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
