<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Models\Staff;
use App\Models\Vezife;
use App\Models\Shobe;
use App\Models\Clients;
use App\Models\Order;
use App\Models\Brend;
use App\Models\Products;
use App\Models\Xerc;

use App\Models\Komendant;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
  public function userIndex()
  {
  
     $data = User::get();
     $user_id = Auth::id();

     $bsay = Brend::where('user_id','=',$user_id)->count();
     $csay = Clients::where('user_id','=',$user_id)->count();
     $ssay = Order::where('user_id','=',$user_id)->count();
     $psay = Products::where('user_id','=',$user_id)->count();
     $xsay = Xerc::where('user_id','=',$user_id)->count();
     $tsay = Komendant::where('user_id','=',$user_id)->count();
     $userinfo = User::find('user_id');
   
    
    return view('user',[
      'data'=>$data,
      'bsay'=>$bsay,
      'csay'=>$csay,
      'ssay'=>$ssay,
      'psay'=>$psay,
      'xsay'=>$xsay,
      'tsay'=>$tsay,
      'userinfo'=>$userinfo

    ] );
  }

  public function admin(request $x){
 

    if($x->f1=='ASC')
    {$data = User::where('id','!=',10)->orderBy('name','asc')->get();}
    elseif($x->f1=='DESC')
    {$data = User::where('id','!=',10)->orderBy('name','desc')->get();}
    elseif($x->f2=='ASC')
    {$data = User::where('id','!=',10)->orderBy('email','asc')->get();}
    elseif($x->f2=='DESC')
    {$data = User::where('id','!=',10)->orderBy('email','desc')->get();}
    else
    {$data = User::where('id','!=',10)->orderBy('id','asc')->get();}

    
    $user_id = Auth::id();

    $bsay = Brend::where('user_id','=',$user_id)->count();
    $csay = Clients::where('user_id','=',$user_id)->count();
    $ssay = Order::where('user_id','=',$user_id)->count();
    $psay = Products::where('user_id','=',$user_id)->count();
    $xsay = Xerc::where('user_id','=',$user_id)->count();
    $tsay = Komendant::where('user_id','=',$user_id)->count();
    $userinfo = User::find('user_id');

    return view('admin',[
    'data'=>$data,
    'bsay'=>$bsay,
    'csay'=>$csay,
    'ssay'=>$ssay,
    'psay'=>$psay,
    'xsay'=>$xsay,
    'tsay'=>$tsay,
    'userinfo'=>$userinfo

  

    ]);
  }

  

   
  
  


    public function user(UserRequest $post)
    {
      $yoxla = User::where('email','=',$post->email)->orwhere('name','=',$post->name)->count();
      if($yoxla==0)
      {
        $con = new User();

        $con->name = $post->name;
        $con->email = $post->email;
        $con->password =  Hash::make($post->password);
        $con->blok= 0;
     
        $con->save();

        return redirect()->route('user')->with('mesaj','Uğurla daxil edildi');
      }
      return redirect()->route('user')->with('mesaj','User artıq mövcuddur');
    }

    public function blok($id){
      $user = User::find($id);

        $user->blok = 1;
        $user->save();

        return redirect()->route('admin')->with('mesaj','User uğurla blok edildi');
      
    }

    public function anblok($id){
      $user = User::find($id);

    
      
        $user->blok = 0;
        $user->save();

        return redirect()->route('admin')->with('mesaj','User uğurla blokdan çıxarıldı');;
      
    }

    
}


