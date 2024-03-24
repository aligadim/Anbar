<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\tehcizatRequest;
use App\Models\Tehcizat;
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


class tehcizatController extends Controller
{
    public function t_update(tehcizatRequest $post, $id){
        $con = Tehcizat::find($id);
        if($post->file('image')){

        $post->validate([
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:10000|dimensions:min_width=100,min_height=100,max_width=2000,max_height=5000',
        ]);

       

            $file=time().'.'.$post->image->extension();
            $post->image->storeAs('public/uploads/tehcizat',$file);
            $con->image = 'storage/uploads/tehcizat/'.$file;
        }

        $con ->ad = $post->ad;
        $con ->soyad = $post->soyad;
        $con ->tel = $post->tel;
        $con ->email = $post->email;
        $con ->shirket = $post->shirket;

        $con->save();

        return redirect()->route('tehcizat')->with('mesaj','Məlumatlar uğurla redakte edildi');
    }


    public function t_edit($id){

        $user_id = Auth::id();

        $bsay = Brend::where('user_id','=',$user_id)->count();
        $csay = Clients::where('user_id','=',$user_id)->count();
        $ssay = Order::where('user_id','=',$user_id)->count();
        $psay = Products::where('user_id','=',$user_id)->count();
        $xsay = Xerc::where('user_id','=',$user_id)->count();
        $tsay = Komendant::where('user_id','=',$user_id)->count();
        $userinfo = User::find('user_id');

        $edit_data = Tehcizat::find($id);
        $data = Tehcizat::get();
        $say = Tehcizat::count();


        return view('tehcizat',[
            'data'=>$data,
            'say'=>$say,
            'edit_data'=>$edit_data,
            'bsay'=>$bsay,
            'csay'=>$csay,
            'ssay'=>$ssay,
            'psay'=>$psay,
            'xsay'=>$xsay,
            'tsay'=>$tsay,
            'userinfo'=>$userinfo
        ]);
    }



    public function t_sil($id){

        $user_id = Auth::id();

        $bsay = Brend::where('user_id','=',$user_id)->count();
        $csay = Clients::where('user_id','=',$user_id)->count();
        $ssay = Order::where('user_id','=',$user_id)->count();
        $psay = Products::where('user_id','=',$user_id)->count();
        $xsay = Xerc::where('user_id','=',$user_id)->count();
        $tsay = Komendant::where('user_id','=',$user_id)->count();
        $userinfo = User::find('user_id');

        $data = Tehcizat::get();
        $say = Tehcizat::count();


        return view('tehcizat',[
            'data'=>$data,
            'say'=>$say,
            'sil_id'=>$id,
            'bsay'=>$bsay,
            'csay'=>$csay,
            'ssay'=>$ssay,
            'psay'=>$psay,
            'xsay'=>$xsay,
            'tsay'=>$tsay,
            'userinfo'=>$userinfo
        ]);
    }

    public function t_del($id){
        $tehcizat_sil = Tehcizat::find($id)->delete();

        return redirect()->route('tehcizat')->with('mesaj','Məlumat uğurla silindi');
    }



    public function index(Request $x){

        $user_id = Auth::id();

        $bsay = Brend::where('user_id','=',$user_id)->count();
        $csay = Clients::where('user_id','=',$user_id)->count();
        $ssay = Order::where('user_id','=',$user_id)->count();
        $psay = Products::where('user_id','=',$user_id)->count();
        $xsay = Xerc::where('user_id','=',$user_id)->count();
        $tsay = Komendant::where('user_id','=',$user_id)->count();
        $userinfo = User::find('user_id');

        $axtar = '';

        if(empty($x->axtar))
        {
            if($x->f1=='ASC')
            {$data = Tehcizat::orderBy('ad','asc')->get();}
            
            elseif($x->f1=='DESC')
            {$data= Tehcizat::orderBy('ad','desc')->get();} 
            
            elseif($x->f2=='ASC')
            {$data = Tehcizat::orderBy('soyad','asc')->get();}
            
            elseif($x->f2=='DESC')
            {$data= Tehcizat::orderBy('soyad','desc')->get();}

            elseif($x->f3=='ASC')
            {$data = Tehcizat::orderBy('tel','asc')->get();}
            
            elseif($x->f3=='DESC')
            {$data= Tehcizat::orderBy('tel','desc')->get();}

            elseif($x->f4=='ASC')
            {$data = Tehcizat::orderBy('email','asc')->get();}
            
            elseif($x->f4=='DESC')
            {$data= Tehcizat::orderBy('email','desc')->get();}

            elseif($x->f5=='ASC')
            {$data = Tehcizat::orderBy('shirket','asc')->get();}
            
            elseif($x->f5=='DESC')
            {$data= Tehcizat::orderBy('shirket','desc')->get();}

            else
            {$data= Tehcizat::orderBy('id','asc')->get();}

        }
        else
        {$data = Tehcizat::where('ad','LIKE','%'.$x->axtar.'%')->get();}
        $say = Tehcizat::count();


        return view('tehcizat',[
            'data'=>$data,
            'say'=>$say,
            'bsay'=>$bsay,
            'csay'=>$csay,
            'ssay'=>$ssay,
            'psay'=>$psay,
            'xsay'=>$xsay,
            'tsay'=>$tsay,
            'userinfo'=>$userinfo
        ]);
    }



    public function tehcizat(tehcizatRequest $post){

        $con = new Tehcizat();
  if($post->file('image'))
        {
        $post->validate([
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:10000|dimensions:min_width=100,min_height=100,max_width=2000,max_height=5000',
        ]);

      
            $file= time().'.'.$post->image->extension();
            $post->image->storeAs('public/uploads/tehcizat',$file);
            $con->image = 'storage/uploads/tehcizat/'.$file;
        }



        $con->ad = $post->ad;
        $con->soyad = $post->soyad;
        $con->tel = $post->tel;
        $con->email = $post->email;
        $con->shirket = $post->shirket;
      

        $con->save();

        return redirect()->route('tehcizat')->with('mesaj','Məlumat uğurla əlavə edildi');

    }
}
