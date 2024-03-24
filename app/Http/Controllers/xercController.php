<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\xercRequest;



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

class xercController extends Controller
{
   public function xerc_update(xercRequest $post, $id){
    if(!empty($post->teyinat) && !empty($post->mebleg))
    {

    
    $con = Xerc::find($id);
    $con->teyinat = $post->teyinat;
    $con->mebleg = $post->mebleg;
    $con->user_id = $user_id;
    $con->save();

    return redirect()->route('xerc')->with('mesaj','Məlumatlar uğurla yenilendi');
    }
   }

   public function xerc_edit($id){

    $edit_data = Xerc::find($id);
    $data = Xerc::orderBy('id','desc')->get();
    $say = Xerc::count();
    $user_id = Auth::id();

    $bsay = Brend::where('user_id','=',$user_id)->count();
    $csay = Clients::where('user_id','=',$user_id)->count();
    $ssay = Order::where('user_id','=',$user_id)->count();
    $psay = Products::where('user_id','=',$user_id)->count();
    $xsay = Xerc::where('user_id','=',$user_id)->count();
    $tsay = Komendant::where('user_id','=',$user_id)->count();
    $userinfo = User::find('user_id');

    return view('xerc',[
        'data'=>$data,
        'say'=>$say,
        'edit_data'=>$edit_data,
        'bsay'=>$bsay,
        'csay'=>$csay,
        'ssay'=>$ssay,
        'psay'=>$psay,
        'xsay'=>$xsay,
        'tsay'=>$tay,
        'userinfo'=>$userinfo,

    ]);
   }



    public function xerc_sil($id){
        $data = Xerc::get();
        $say=Xerc::count();
        $user_id = Auth::id();

        $bsay = Brend::where('user_id','=',$user_id)->count();
        $csay = Clients::where('user_id','=',$user_id)->count();
        $ssay = Order::where('user_id','=',$user_id)->count();
        $psay = Products::where('user_id','=',$user_id)->count();
        $xsay = Xerc::where('user_id','=',$user_id)->count();
        $tsay = Komendant::where('user_id','=',$user_id)->count();
        $userinfo = User::find('user_id');

        return view('xerc',[
            'data'=>$data,
            'say'=>$say,
            'sil_id'=>$id,
            'bsay'=>$bsay,
            'csay'=>$csay,
            'ssay'=>$ssay,
            'psay'=>$psay,
            'xsay'=>$xsay,
            'tsay'=>$tsay,
            'userinfo'=>$userinfo,
        ]);
    }

   function xerc_del($id){
    $sil_get = Xerc::find($id)->delete();

    return redirect()->route('xerc')->with('mesaj','Məlumatlar uğurla silindi');
   }


   public function index(Request $x){
    $axtar ='';
    if(empty($x->axtar))
    {
        if($x->f1=='ASC')
        $data = Xerc::orderBy('teyinat','asc')->get();

        elseif($x->f1=='DESC')
        $data = Xerc::orderBy('teyinat','desc')->get();

        elseif($x->f2=='ASC')
        $data = Xerc::orderBy('mebleg','asc')->get();

        elseif($x->f2=='DESC')
        $data = Xerc::orderBy('mebleg','desc')->get();

        else
        {$data = Xerc::orderBy('id','asc')->get();}
    }
    else
    {$data = Xerc::where('teyinat','LIKE','%'.$x->axtar.'%')->get();}
    $say = Xerc::count();
    $user_id = Auth::id();

    
    $bsay = Brend::where('user_id','=',$user_id)->count();
    $csay = Clients::where('user_id','=',$user_id)->count();
    $ssay = Order::where('user_id','=',$user_id)->count();
    $psay = Products::where('user_id','=',$user_id)->count();
    $xsay = Xerc::where('user_id','=',$user_id)->count();
    $tsay = Komendant::where('user_id','=',$user_id)->count();
    $userinfo = User::find('user_id');
    return view('xerc',[
        'data'=>$data,
        'say'=>$say,
        'bsay'=>$bsay,
        'csay'=>$csay,
        'ssay'=>$ssay,
        'psay'=>$psay,
        'xsay'=>$xsay,
        'tsay'=>$tsay,
        'userinfo'=>$userinfo,


    ]);
   }

   public function xerc(xercRequest $post){
    $user_id = Auth::id();
    if(!empty($post->teyinat) && !empty($post->mebleg))
    {

        $con = new Xerc();
         $con->teyinat = $post->teyinat;
         $con->mebleg = $post->mebleg;
         $con->user_id = $user_id;
         $con->save();

         return redirect()->route('xerc')->with('mesaj','Məlumatlar uğurla elave edildi');

    }
    
   }
}
