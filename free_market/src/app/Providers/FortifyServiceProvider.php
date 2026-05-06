<?php

namespace App\Providers;

use App\Http\Responses\RegisterResponse;
use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Fortify\Fortify;
use Laravel\Fortify\Contracts\RegisterResponse as RegisterResponseContract;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        $this->app->singleton(RegisterResponseContract::class, RegisterResponse::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Fortify::createUsersUsing(CreateNewUser::class);
        /*
        if (function_exists('opcache_reset')) {
                opcache_reset();
        }
        dd((new \ReflectionClass(\Laravel\Fortify\Fortify::class))->getFileName());
        dd([
        'config_loaded' => config('fortify.features'),
        'method_exists' => method_exists(\Laravel\Fortify\Fortify::class, 'createNewUsersUsing')
        ]);
       
        Fortify::createNewUsersUsing(CreateNewUser::class);
        */
        /* 
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        RateLimiter::for('login', function (Request $request) {
            $throttleKey = Str::transliterate(Str::lower($request->input(Fortify::username())).'|'.$request->ip());

            return Limit::perMinute(5)->by($throttleKey);
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });
        */

        Fortify::registerView(function () {
         return view('register');
         });
       
        Fortify::loginView(function () {
         return view('login');
         });

        RateLimiter::for('login', function (Request $request) {
             $email = (string) $request->email;

             return Limit::perMinute(10)->by($email . $request->ip());
         });
           // Tell Fortify which view to return for the email verification notice
          Fortify::verifyEmailView(function () {
                 return view('auth.verify-email'); // Ensure this blade file exists!
         });
       
    }

}
