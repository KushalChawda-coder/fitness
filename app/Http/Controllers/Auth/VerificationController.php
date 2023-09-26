<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Http\Controllers\Auth\Auth;
use Carbon\Carbon;
use App\Notifications\VerificationEmail;


class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */

    use VerifiesEmails;

    /**
     * Where to redirect users after verification.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
        // $this->middleware('signed')->only('verify');
        // $this->middleware('throttle:6,1')->only('verify', 'resend');
    }
    public function index(Request $request){

        $email = User::find($request->id)->email;

        return view('auth.verify',['email' => $email]);
    }


    public function verifyEmail(Request $request){
        
        $validator = Validator::make($request->all(),[
            'verfication_code' => ['required'],
            'email' => ['required']
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->with('error','Validation error detected!');
        } else {

            $user = User::where('email', $request->input('email'))
                ->where('remember_token', $request->input('verfication_code'))
                ->first();

            if (!$user) {
                return redirect()->back()->with('error','Invalid verfication code');
            }

            $user->email_verified_at = Carbon::now();
            $user->remember_token = Null;
            $user->save();
            session()->forget('success');
            return view('auth.verify-email-success',['user' => $user]);
        }
    }


    public function requestEmailAgain(Request $request)
    {
        $user_email = $request->email;
        $verification_code = rand(100000,999999);

        $user_data = User::where('email', $user_email)->update(['remember_token' => $verification_code]);
        $user = User::where('email',$user_email)->first();

        $user->notify(new VerificationEmail($user) );

        if(!$user_data){
            return response()->json(['status' => false, 'message' => 'Something Went Wrong !']);
        }
        return response()->json(['status' => true, 'message' => 'Verification code sent successfully']);   
    }


}
