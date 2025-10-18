<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\RecoveryPasswordRequest;
use App\Http\Requests\SetNewPasswordReqeust;
use App\Http\Requests\UserRegisterRequest;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\RecoveryMail;



class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }
    public function register()
    {
        return view('auth.register');
    }
    public function submitUser(UserRegisterRequest $request)
    {
        $data = $request->all();
        $data['password'] = Hash::make($request->password);
        User::query()->create($data);
        return redirect()->route('login');
    }
    public function enterUser(UserLoginRequest $request)
    {

        // $user = User::query()->where('email',$request->email)->first();
        // if(Hash::check($request->password, $user->password))
        // {
        //     Auth::login($user);
        //     return redirect()->route('admin.users');
        // }
        // else{
        //     return  redirect()->back()->with('message','password is not correct');
        // }
        $member = $request->remember === 'on' ? true : false;
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $member)) {
            return redirect()->route('admin.users');
        } else {
            return  redirect()->back()->with('message', 'password is not correct');
        }
    }
    public function recoveryPassword()
    {
        return view('auth.recovery-password');
    }
    public function getTokenPassword($token)
    {
        return view('auth.changePassword', compact('token'));
    }
    public function setNewPassword(SetNewPasswordReqeust $request)
    {
        $exists = DB::table('password_reset_tokens')->where('token',$request->token)->first();
        if($exists){
            $user = User::query()->where('email',$exists->email)->first();
            $user->update([
                'password' => hash::make($request->password)
            ]);
            DB::table('password_reset_tokens')->where('email',$user->email)->delete();
            return redirect()->route('login');
        }
        else{
            return redirect()->back()->with('token is wrong');
        }
    }


    public function changePassword(RecoveryPasswordRequest $request)
    {
        $exists = DB::table('password_reset_tokens')->where('email', $request->email)->exists();
        if ($exists) {
            return redirect()->back()->with('message', 'darkhast sabt shode hast');
        }
        $token = str()->random(60);
        DB::table('password_reset_tokens')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => now()
        ]);
        Mail::send(new RecoveryMail($token,$request->email));
        return redirect()->back()->with('message', 'link be email ersal shod');
    }
}
