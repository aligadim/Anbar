<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\loginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(){
        return view('login');
    }




    public function login(loginRequest $post){

        $yoxla = User::where('email','=',$post->email)
        ->where('blok','=',1)
        ->count();

        if($yoxla==0)
        {
            if(!Auth::attempt(['email'=>$post->email,'password'=>$post->password]))
            {
                return redirect()->back()->with('mesaj','Daxil etdiyiniz parol və ya email yanlışdır');
            }
        
            return redirect()->route('orders');
        }
        else
        {
            return redirect()->back()->with('mesaj','Sizin hesabınız blok olunub, Adminlə əlaqə saxlayın');
        }
    }
    public function logout(){
        auth()->logout();
        return redirect()->route('login');

    }
}
