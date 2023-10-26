<?php

namespace App\Http\Controllers\Auth;

use App\Enums\Role;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterAdminRequest;
use App\Http\Requests\Auth\RegisterMemberRequest;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Lang;

class RegisterController extends Controller
{
    /**
     * Method to show register view
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function show(): View
    {
        return view('auth.register');
    }

    /**
     * Method to register a new user
     *
     * @param  \App\Http\Requests\Auth\RegisterMemberRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register(RegisterMemberRequest $request) 
    {
        
    }


    /**
     * Method to show register admin view
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function registerAdminView(): View
    {
        return view('auth.registerAdmin');
    }

    /**
     * Method to add new admin-level user
     *
     * @param  \App\Http\Requests\Auth\RegisterAdminRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function registerAdmin(RegisterAdminRequest $request)
    {

    }
}
