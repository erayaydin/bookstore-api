<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthLoginRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;

class AuthController extends Controller
{
    /**
     * @return Renderable
     */
    public function login(): Renderable
    {
        return view('auth.login');
    }

    public function doLogin(AuthLoginRequest $request): RedirectResponse
    {
        if (!auth()->attempt($request->only('email', 'password'))) {
            return redirect()->route('auth.login')->withInput()->withErrors(['email' => "E-Posta adresi veya parola hatalı!"]);
        }

        /** @var User $user */
        $user = auth()->user();

        if (!$user) {
            abort(500);
        }

        if (!$user->hasPermissionTo('auth back-office')) {
            auth()->logout();
            return redirect()->route('auth.login')->withInput()->withErrors(['email' => "Sadece yöneticiler panele giriş yapabilir."]);
        }

        $user->last_login_at = Carbon::now();
        $user->save();
        return redirect()->route('dashboard.index');
    }

    public function logout(): RedirectResponse
    {
        auth()->logout();
        return redirect()->route('auth.login');
    }
}
