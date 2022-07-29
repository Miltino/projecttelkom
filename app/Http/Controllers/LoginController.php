<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\MessageBag;

class LoginController extends Controller
{
    public function login(){
        return view('/login');
    }

    public function loginproses(Request $request){
        
        if(Auth::attempt($request->only('email','password'))){
            $request->session()->regenerate();
            $user = Auth::user();
            Session::put('user',$user);
            $user=Session::get('user');
    
            $name = $user->name;
            $email = $user->email;
            $dt = Carbon::now();
            $todayDate = $dt->toDayDateTimeString();
    
            $activityLog = [
    
                'name' => $name,
                'email' => $email,
                'description' => "Login",
                'date_time' => $todayDate,
            ];
            DB::table('activitylog')->insert($activityLog);
            return redirect('/');
        }
        $errors = ['Account not found'];
        return redirect('/login')->withErrors($errors);
    }
    public function register(){
        return view('/register');
    }

    public function registeruser(Request $request){
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'remember_token' => Str::random(60),
        ]);

        return redirect('/login');
    }

    public function logout(){
        $user = Auth::user();
        Session::put('user',$user);
        $user=Session::get('user');

        $name = $user->name;
        $email = $user->email;
        $dt = Carbon::now();
        $todayDate = $dt->toDayDateTimeString();

        $activityLog = [

            'name' => $name,
            'email' => $email,
            'description' => "Logout",
            'date_time' => $todayDate,
        ];
        DB::table('activitylog')->insert($activityLog);
        Auth::logout();
        return redirect('/login');
    }
}
