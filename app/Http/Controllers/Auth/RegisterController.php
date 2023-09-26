<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Domain;
use App\Models\admin\PagesCms;
use App\Models\Role;
use Auth;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Notifications\VerificationEmail;
use Illuminate\Http\Request;

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
    //protected $redirectTo = RouteServiceProvider::HOME;
    public function redirectTo() {
        $role_id = Auth::user()->role_id; 
        switch ($role_id) {
            case Role::ROLE_COACH:
                return route('coach_dashboard.index');
            break;
        }
        
    }

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
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'min:6', 'regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/', 'confirmed'],
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
        $VerificationCode = rand(100000,999999);

        $user = User::create([
            'name' => $data['name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'role_id' => Role::ROLE_COACH,
            'password' => Hash::make($data['password']),
            'remember_token' => $VerificationCode
        ]);

        $this->sendVerificationEmail($user);

        return $user;
    }

    protected function sendVerificationEmail($user)
    {
        $user->notify(new VerificationEmail($user) );
    }


    public function register(Request $request)
    {
        $this->validator($request->all())->validate();
        $user = $this->create($request->all());

        return to_route('verify-email',['id' => $user->id])->with('success','Verification code has been sent to your email.');
    }

    public function showRegistrationForm()
    {
        $page = PagesCms::with('getPageSection')->find(1);
        $section = json_decode($page->getPageSection->page_section_data)->Section;
             
        return view('auth.register',['packages'  => $section->Pricing]);
    }

}
