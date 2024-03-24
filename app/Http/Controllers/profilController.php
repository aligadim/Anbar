<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\profilRequest;

use App\Models\Staff;
use App\Models\Vezife;
use App\Models\Shobe;
use App\Models\Clients;
use App\Models\Order;
use App\Models\Brend;
use App\Models\Products;
use App\Models\Xerc;
use App\Models\User;
use App\Models\Komendant;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Hash;


class profilController extends Controller
{
    public function index(){

        $user_id = Auth::id();

        $bsay = Brend::where('user_id','=',$user_id)->count();
        $csay = Clients::where('user_id','=',$user_id)->count();
        $ssay = Order::where('user_id','=',$user_id)->count();
        $psay = Products::where('user_id','=',$user_id)->count();
        $xsay = Xerc::where('user_id','=',$user_id)->count();
        $tsay = Komendant::where('user_id','=',$user_id)->count();
        $userinfo = User::find('user_id');
        

       

       
        $data = User::get();

        return view('profil',[
            'data'=> $data,
            'bsay'=>$bsay,
            'csay'=>$csay,
            'ssay'=>$ssay,
            'psay'=>$psay,
            'xsay'=>$xsay,
            'tsay'=>$tsay,
            'userinfo'=>$userinfo,
           
        ]);
        
    }
   

    

    public function profil_update(profilRequest $post){

        

        if(!empty($post->password)){
           
        if(Hash::check($post->password,Auth::user()->password)){   
        $con =   User::find(Auth::id());
        $yoxla = User::where('email','=',$post->email)
        ->where('id','!=',Auth::id())
        ->count();

         if($yoxla ==0){
        if($post->file('image')){

            $post->validate([
                'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:10000|dimensions:min_width=100,min_height=100,max_width=2000,max_height=5000',
            ]);

            $file= time().'.'.$post->image->extension();
            $post->image->storeAs('public/uploads/profil',$file);
            $con->image='storage/uploads/profil/'.$file;
        }
        $con->name = $post->name;
        $con->password = Hash::make($post->password);
   
        $con->email = $post->email;

        $con->save();
    }
    else
    {return redirect()->route('profil')->with('mesaj','Bu email artıq mövcuddur');}
    return redirect()->route('profil')->with('mesaj','Profil uğurla redakte edildi');


        return redirect()->route('profil')->with('mesaj','Düzgün cari  parol:');

        }
         return redirect()->route('profil')->with('mesaj','Düzgün cari  parol daxil etmədiniz');
    }
       

        

    }

    public function profil_edit($id){

        $user_id = Auth::id();

        $bsay = Brend::where('user_id','=',$user_id)->count();
        $csay = Clients::where('user_id','=',$user_id)->count();
        $ssay = Order::where('user_id','=',$user_id)->count();
        $psay = Products::where('user_id','=',$user_id)->count();
        $xsay = Xerc::where('user_id','=',$user_id)->count();
        $tsay = Komendant::where('user_id','=',$user_id)->count();
        $userinfo = User::find('user_id');

        $edit_data = User::find($id);

        $data = User::get();



        return view('profil',[
            'data'=> $data,
            'edit_data'=> $edit_data,
            'bsay'=>$bsay,
            'csay'=>$csay,
            'ssay'=>$ssay,
            'psay'=>$psay,
            'xsay'=>$xsay,
            'tsay'=>$tsay,
            'userinfo'=>$userinfo,
        ]);
    }




    

}
