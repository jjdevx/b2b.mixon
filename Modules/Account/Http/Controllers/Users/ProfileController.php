<?php

namespace Modules\Account\Http\Controllers\Users;

use Illuminate\Http\RedirectResponse;
use Inertia\Response;
use Modules\Account\Http\Controllers\Controller;
use Modules\Account\Http\Requests\ProfileRequest;

class ProfileController extends Controller
{
    public function edit(): Response
    {
        $this->seo()->setTitle('Редактировать профиль');

        $user = \Auth::user();

        $data = $user->only(['id', 'name', 'surname', 'email', 'company', 'okpo', 'country', 'city', 'address', 'fax', 'phone']);
        if ($user->avatarMedia) {
            $data['avatar'] = $user->getAvatar();
        }

        return inertia('Users/Profile', ['data' => ['user' => $data]]);
    }

    public function update(ProfileRequest $request): RedirectResponse
    {
        $user = $request->user();
        $oldEmail = $user->email;

        $data = $request->only(['name', 'surname', 'email', 'company', 'okpo', 'country', 'city', 'address', 'fax', 'phone']);

        if ($password = $request->input('password')) {
            $data['password'] = \Hash::make($password);
        }

        $user->update($data);

        if ($avatar = $request->file('avatar')) {
            $user->uploadAvatar($avatar);
        }

        if ($oldEmail !== $data['email']) {
            $user->sendEmailVerificationNotification();

            $user->email_verified_at = null;
            $user->save();

            redirect()->back()->with(['flash' => [
                'text' => 'Ваш профиль был отредактирован. Вам на почту было отправлено письмо для подтверждения аккаунта.',
                'icon' => 'success',
                'timer' => 6000
            ]]);
        }

        return redirect()->back()->with(['toast' => ['text' => 'Ваш профиль был отредактирован.']]);
    }

    public function destroyAvatar(): RedirectResponse
    {
        return app(UserController::class)->destroyAvatar(\Auth::id());
    }
}
