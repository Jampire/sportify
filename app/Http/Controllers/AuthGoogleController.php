<?php

namespace App\Http\Controllers;

use App\Models\GoogleAuth;
use App\Models\Organization;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Symfony\Component\HttpFoundation\RedirectResponse as SymfonyRedirectResponse;
use Illuminate\Http\RedirectResponse as IlluminateRedirectResponse;

/**
 * Class AuthGoogleController
 *
 * @author Dzianis Kotau <me@dzianiskotau.com>
 */
class AuthGoogleController extends Controller
{
    /**
     * Redirects user to Google OAuth page
     *
     * @author Dzianis Kotau <me@dzianiskotau.com>
     * @return SymfonyRedirectResponse|IlluminateRedirectResponse
     */
    public function redirect(): SymfonyRedirectResponse|IlluminateRedirectResponse
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Authenticate social user
     *
     * @author Dzianis Kotau <me@dzianiskotau.com>
     * @return IlluminateRedirectResponse
     */
    public function callback(): IlluminateRedirectResponse
    {
        try {
            $socialUser = Socialite::driver('google')->user();
        } catch (\Throwable $throwable) {
            logs()->error(
                'Google Auth user is not found.',
                ['error' => $throwable->getMessage()]
            );

            return redirect()->home(); // TODO: return on error page with error message
        }

        $organizationId = Organization::findByEmail($socialUser->getEmail())?->id;
        if ($organizationId === null) {
            logs()->error(
                sprintf('User %s does not belong to any organization', $socialUser->getEmail())
            );

            return redirect()->home(); // TODO: return on error page with error message
        }

        $user = User::updateOrCreate(
            [
                'email' => $socialUser->getEmail(),
            ],
            [
                'name' => $socialUser->getName(),
                'organization_id' => $organizationId,
                'profile_photo_path' => $socialUser->getAvatar(),
                'email_verified_at' => now(),
                'socialite_id' => $socialUser->getId(),
                'socialite_type' => 'google',
                'socialite_token' => $socialUser->token,
                'socialite_refresh_token' => $socialUser->refreshToken,
                'socialite_expires_in' => $socialUser->expiresIn,
            ]
        );

        Auth::login($user);

        return redirect()->back();
    }
}
