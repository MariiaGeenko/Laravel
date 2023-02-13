<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\Contracts\Social;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Laravel\Socialite\Facades\Socialite;
use Symfony\Component\HttpFoundation\RedirectResponse as SymfonyRedirectResponse;

class SocialProvidersController extends Controller
{
    /**
     * @param string $driver
     * @return SymfonyRedirectResponse|RedirectResponse
     */
    public function redirect(string $driver): SymfonyRedirectResponse | RedirectResponse
    {
        return Socialite::driver($driver)->redirect();
    }

    /**
     * @param string $driver
     * @param Social $social
     * @return Application|RedirectResponse|Redirector
     */
    public function callback(string $driver, Social $social): Redirector | RedirectResponse | Application
    {
        return redirect($social->loginAndGetRedirectUrl(
            Socialite::driver($driver)->user())
        );

    }
}
