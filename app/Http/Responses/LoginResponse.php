<?php

use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{

    /**
     * toResponse
     *
     * @param mixed $request
     * 
     * @return RedirectResponse
     */
    public function toResponse($request)
    {
        if (Auth::user()->role === "Admin") {
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->route('/');
        }
    }
}
