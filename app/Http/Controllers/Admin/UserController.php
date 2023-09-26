<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;


class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   
        $user_id = Auth::user()->id;
        $user = User::with('role')->find($user_id);
        $image = asset('assets/admin/img/profile/profile-11.webp');

        if(!empty($user->image)){
            $image = asset($user->image);
        }

        return view('admin.Profile.index', compact('user', 'image'));
    }

}
