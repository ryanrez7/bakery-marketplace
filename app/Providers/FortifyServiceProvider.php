<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Models\User;
use App\Support\Auth\LoginLockout;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\ValidationException;
use Laravel\Fortify\Fortify;

class FortifyServiceProvider extends ServiceProvider
{
    public function register(): void
    {
         $this->app->singleton(
            \Laravel\Fortify\Contracts\LoginResponse::class,
            \App\Http\Responses\LoginResponse::class
        );
    }

    public function boot(): void
    {
        $this->configureActions();
        $this->configureAuthentication();
        $this->configureViews();
        $this->configureRateLimiting();
    }

    private function configureActions(): void
    {
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);
        Fortify::createUsersUsing(CreateNewUser::class);
    }

    // verifikasi kredensial + status akun; pesan error sengaja sama untuk semua kegagalan
    private function configureAuthentication(): void
    {
        Fortify::authenticateUsing(function (Request $request): User {
            $lockout = app(LoginLockout::class);
            $email = (string) $request->input(Fortify::username());

            if ($lockout->isLocked($email)) {
                throw ValidationException::withMessages([
                    Fortify::username() => 'Akun terkunci sementara karena terlalu banyak percobaan gagal. Coba lagi dalam '.$lockout->minutesRemaining($email).' menit.',
                ]);
            }

            $user = User::query()->where('email', $email)->first();

            if ($user !== null && $user->isActive() && Hash::check((string) $request->input('password'), $user->password)) {
                $lockout->clear($email);

                return $user;
            }

            $lockout->recordFailure($email);

            throw ValidationException::withMessages([
                Fortify::username() => 'Email atau password salah. Silakan coba lagi.',
            ]);
        });
    }

    private function configureViews(): void
    {
        // tiga halaman ini kita buat sendiri sesuai Figma (Tahap D5)
        Fortify::loginView(fn () => view('auth.login'));
        Fortify::requestPasswordResetLinkView(fn () => view('auth.forgot-password'));
        Fortify::resetPasswordView(fn () => view('auth.reset-password'));

        // sisanya tetap bawaan starter kit
        Fortify::verifyEmailView(fn () => view('pages::auth.verify-email'));
        Fortify::twoFactorChallengeView(fn () => view('pages::auth.two-factor-challenge'));
        Fortify::confirmPasswordView(fn () => view('pages::auth.confirm-password'));
        Fortify::registerView(fn () => view('pages::auth.register'));
    }

    private function configureRateLimiting(): void
    {
        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });

        RateLimiter::for('login', function (Request $request) {
            // lapis tambahan per-IP; penguncian per akun ditangani LoginLockout
            return Limit::perMinute(20)->by($request->ip() ?? 'unknown');
        });

        RateLimiter::for('passkeys', function (Request $request) {
            $credentialId = $request->input('credential.id');

            return Limit::perMinute(10)->by(
                ($credentialId ?: $request->session()->getId()).'|'.$request->ip(),
            );
        });
    }
}