<?php

namespace App\Http\Controllers\Auth\Api;

use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerRegisterRequest;
use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class CustomerAuthController extends BaseController
{
     public function showRegisterForm()
    {
        return view('customer.register');
    }

    public function register(CustomerRegisterRequest $request)
    {

        Customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return $this->sendRResponse('success', 'Customer registered successfully. Please login.', null, 201);
    }

    public function showLoginForm()
    {
        return view('customer.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

       if (Auth::guard('customer')->attempt($credentials)) {
    return $this->sendRResponse('success', 'Login successful.', Auth::guard('customer')->user(), 200);
}

        return $this->sendRResponse('error', 'Invalid credentials', null, 401);
    }

    public function logout()
    {
        Auth::guard('customer')->logout();
        return redirect()->route('customer.login');
    }
}
