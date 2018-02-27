<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Business;
use App\Traits\ActivationTrait;
use App\Traits\CaptchaTrait;
use App\Traits\CaptureIpTrait;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Validator;
use jeremykenedy\LaravelRoles\Models\Role;

//RegistersUsers trait
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;

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

    use ActivationTrait;
    use CaptchaTrait;
    use RegistersUsers;


    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        $data = [
            'roles' => Role::whereIn('slug', ['business.owner', 'investor'])->get(),
        ];

        return view('auth.register')->with($data);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));  

        $this->guard()->login($user);

        return $this->registered($request, $user)
                        ?: redirect($this->redirectPath());
    }



    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/activate';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', [
            'except' => 'logout',
        ]);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $data['captcha'] = $this->captchaCheck();

        if (!config('settings.reCaptchStatus')) {
            $data['captcha'] = true;
        }


        if ($data["user_role"] === "Business Owner") {
            return Validator::make($data,
                [
                    'user_role'             => 'required|in:Business Owner',
                    'business_name'         => 'required',
                    'business_nature'       => 'required',
                    'business_address'      => 'required',
                    'name'                  => 'required|max:255|unique:users',
                    'first_name'            => '',
                    'last_name'             => '',
                    'email'                 => 'required|email|max:255|unique:users',
                    'password'              => 'required|min:6|max:20|confirmed',
                    'password_confirmation' => 'required|same:password',
                    'g-recaptcha-response'  => '',
                    'captcha'               => 'required|min:1',
                ],
                [
                    'name.unique'                   => trans('auth.userNameTaken'),
                    'name.required'                 => trans('auth.userNameRequired'),
                    'first_name.required'           => trans('auth.fNameRequired'),
                    'last_name.required'            => trans('auth.lNameRequired'),
                    'email.required'                => trans('auth.emailRequired'),
                    'email.email'                   => trans('auth.emailInvalid'),
                    'password.required'             => trans('auth.passwordRequired'),
                    'password.min'                  => trans('auth.PasswordMin'),
                    'password.max'                  => trans('auth.PasswordMax'),
                    'g-recaptcha-response.required' => trans('auth.captchaRequire'),
                    'captcha.min'                   => trans('auth.CaptchaWrong'),
                ]
            );
        } else {
            return Validator::make($data,
            [
                'user_role'             => 'required|in:Investor',
                'name'                  => 'required|max:255|unique:users',
                'first_name'            => '',
                'last_name'             => '',
                'email'                 => 'required|email|max:255|unique:users',
                'password'              => 'required|min:6|max:20|confirmed',
                'password_confirmation' => 'required|same:password',
                'g-recaptcha-response'  => '',
                'captcha'               => 'required|min:1',
            ],
            [
                'name.unique'                   => trans('auth.userNameTaken'),
                'name.required'                 => trans('auth.userNameRequired'),
                'first_name.required'           => trans('auth.fNameRequired'),
                'last_name.required'            => trans('auth.lNameRequired'),
                'email.required'                => trans('auth.emailRequired'),
                'email.email'                   => trans('auth.emailInvalid'),
                'password.required'             => trans('auth.passwordRequired'),
                'password.min'                  => trans('auth.PasswordMin'),
                'password.max'                  => trans('auth.PasswordMax'),
                'g-recaptcha-response.required' => trans('auth.captchaRequire'),
                'captcha.min'                   => trans('auth.CaptchaWrong'),
            ]
        );
        }




        
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     *
     * @return User
     */
    protected function create(array $data)
    {
        $ipAddress = new CaptureIpTrait();


        $role = $data['user_role']; //Retrieving the user_role field

        $role_r = Role::where('name', '=', $role)->first();            
            
        

        $user = User::create([
                'name'              => $data['name'],
                'first_name'        => $data['first_name'],
                'last_name'         => $data['last_name'],
                'email'             => $data['email'],
                'password'          => bcrypt($data['password']),
                'token'             => str_random(64),
                'signup_ip_address' => $ipAddress->getClientIp(),
                'activated'         => !config('settings.activation'),
            ]);

        if ($role_r->slug == "business.owner") {
             Business::create([
                'name'                  => $data['business_name'],
                'nature'                => $data['business_nature'],
                'address'               => $data['business_address'],
                'user_id'               => $user->id,
            ]);
        } 



        $user->attachRole($role_r);

        $this->initiateEmailActivation($user);

        return $user;
    }
}
