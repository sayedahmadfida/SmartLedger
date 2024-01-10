<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Currency;
use App\Models\CurrencyAttend;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
     */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'lastName' => ['required', 'string', 'max:255'],
            'userName' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'f_name' => $data['name'],
            'l_name' => $data['lastName'],
            'default_password' => $data['name'],
            'user_id' => 1,
            'email' => $data['email'],
            'username' => $data['userName'],
            'type' => 'ADMIN',
            'status' => 1,
            'admin_id' => 1,
            'password' => Hash::make($data['password']),
        ]);
        $user->assignRole('Super-Admin');

        $lastUserId = User::latest()->take(1)->get()[0]->id;
        User::where('id', $lastUserId)
            ->update([
                'admin_id' => $lastUserId,
            ]);


        CurrencyAttend::create([
            'currency_id' => $data['currencies'],
            'is_default' => 1,
            'user_id' => $lastUserId,
            'admin_id' => $lastUserId,
        ]);

        return $user;
    }
    public function showRegistrationForm()
    {
        $currency = Currency::all();
        return view('auth.register', compact('currency'));
    }

}
