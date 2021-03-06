<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Session;

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
            'username' => ['required', 'string', 'max:255'],
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
        return User::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'level' => $data['level'],
        ]);
    }

    public function getRegister() {
        return view('auth/register');
    }

    public function postRegister(Request $request) {
        // Ki???m tra d??? li???u v??o
        $allRequest  = $request->all();	
        $validator = $this->validator($allRequest);
     
        if ($validator->fails()) {
            // D??? li???u v??o kh??ng th???a ??i???u ki???n s??? th??ng b??o l???i
            return redirect('register')->withErrors($validator)->withInput();
        } else {   
            // D??? li???u v??o h???p l??? s??? th???c hi???n t???o ng?????i d??ng d?????i csdl
            if( $this->create($allRequest)) {
                // Insert th??nh c??ng s??? hi???n th??? th??ng b??o
                Session::flash('success', '????ng k?? th??nh vi??n th??nh c??ng!');
                return redirect('register');
            } else {
                // Insert th???t b???i s??? hi???n th??? th??ng b??o l???i
                Session::flash('error', '????ng k?? th??nh vi??n th???t b???i!');
                return redirect('register');
            }
        }
    }
}
