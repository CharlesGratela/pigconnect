<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            return $this->redirectToDashboard($request->user());
        }
        
        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        // Automatically sign in the user
        Auth::login($request->user());

        // Redirect the user to the appropriate dashboard based on their role
        $user = $request->user();
        if ($user->role === 'buyer') {
            return redirect()->route('buyer.dashboard')->with('verified', true);
        } elseif ($user->role === 'farmer') {
            return redirect()->route('farmer.dashboard')->with('verified', true);
        }

        // Default to a general dashboard if no specific role is matched
        return redirect()->route('dashboard')->with('verified', true);
    }
}