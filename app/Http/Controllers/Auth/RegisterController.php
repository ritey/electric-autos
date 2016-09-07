<?php

namespace App\Http\Controllers\Auth;

use CoderStudios\Models\Users;
use CoderStudios\Library\Resource;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use CoderStudios\Traits\UUID;
use App\Events\Registered;
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

    use RegistersUsers, UUID;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Resource $resource)
    {
        $this->middleware('guest');
        $this->resource = $resource;
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
            'name' => 'required|max:255',
            'email' => 'required|email|confirmed|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $user = Users::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'user_id' => $this->Uuid(openssl_random_pseudo_bytes(16)),
            'password' => bcrypt($data['password']),
        ]);
        if ($user) {
            event(new Registered(['email' => $data['email']]));
        }
        if (Session::get('vehicle_id')) {
            $data = [
                'user_id' => $user->id,
            ];
            $this->resource->update(Session::get('vehicle_id'),$data);
            Session::forget('vehicle_id');
        }
        return $user;
    }
}
