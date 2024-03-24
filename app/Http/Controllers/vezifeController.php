<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\vezifeRequest;


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



class vezifeController extends Controller
{
    public function v_update(vezifeRequest $post, $id){
        $con = Vezife::find($id);
        $con->shobe_id = $post->shobe_id;
        $con->ad = $post->ad;
        $con->save();
        return redirect()->route('vezife')->with('mesaj','Məlumatlar uğurla yenilənd');
    }

    public function v_edit($id){
        $user_id = Auth::id();

        $bsay = Brend::where('user_id','=',$user_id)->count();
        $csay = Clients::where('user_id','=',$user_id)->count();
        $ssay = Order::where('user_id','=',$user_id)->count();
        $psay = Products::where('user_id','=',$user_id)->count();
        $xsay = Xerc::where('user_id','=',$user_id)->count();
        $tsay = Komendant::where('user_id','=',$user_id)->count();
        $userinfo = User::find('user_id');


       $edit_data = Vezife::find($id);
       $data = $data = Vezife::join('shobes','shobes.id','=','vezives.shobe_id')
       ->orderBy('vezives.id','asc')
       ->select('*','shobes.ad as shobe','vezives.ad as vezife','vezives.id as vid')
       ->get();
       $say = Vezife::count();
       $shobes = Shobe::orderBy('ad','asc')->get();
       return view('vezife',[
          'data'=>$data,
          'shobes'=>$shobes,
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


    public function v_sil($id){
       
        $user_id = Auth::id();

        $bsay = Brend::where('user_id','=',$user_id)->count();
        $csay = Clients::where('user_id','=',$user_id)->count();
        $ssay = Order::where('user_id','=',$user_id)->count();
        $psay = Products::where('user_id','=',$user_id)->count();
        $xsay = Xerc::where('user_id','=',$user_id)->count();
        $tsay = Komendant::where('user_id','=',$user_id)->count();
        $userinfo = User::find('user_id');

        $data =$data = Vezife::join('shobes','shobes.id','=','vezives.shobe_id')
        ->orderBy('vezives.id','asc')
        ->select('*','shobes.ad as shobe','vezives.ad as vezife','vezives.id as vid')
        ->get();
        $say = Vezife::count();
        $shobes = Shobe::orderBy('ad','asc')->get();
        

        return view('vezife',[
            'data'=>$data,
            'sil_id'=>$id,
            'say'=>$say,
            'shobes'=>$shobes,
            'bsay'=>$bsay,
            'csay'=>$csay,
            'ssay'=>$ssay,
            'psay'=>$psay,
            'xsay'=>$xsay,
            'tsay'=>$tsay,
            'userinfo'=>$userinfo
        ]);
    }

    public function v_del($id){
        $vezife_sil = Vezife::find($id)->delete();

        return redirect()->route('vezife')->with('mesaj','Məlumat uğurla silindi');
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

    $axtar ='';
    if(empty($x->axtar))
     {
        if($x->f1=='ASC')
     {$data = Vezife::join('shobes','shobes.id','=','vezives.shobe_id')
     ->orderBy('shobe','asc')
     ->select('*','shobes.ad as shobe','vezives.ad as vezife','vezives.id as vid')
     ->get();}

     elseif($x->f1=='DESC')
    {$data = Vezife::join('shobes','shobes.id','=','vezives.shobe_id')
     ->orderBy('shobe','desc')
     ->select('*','shobes.ad as shobe','vezives.ad as vezife','vezives.id as vid')
     ->get();}

     elseif($x->f2=='ASC')
     {$data = Vezife::join('shobes','shobes.id','=','vezives.shobe_id')
      ->orderBy('vezife','asc')
      ->select('*','shobes.ad as shobe','vezives.ad as vezife','vezives.id as vid')
      ->get();}

      elseif($x->f2=='DESC')
      {$data = Vezife::join('shobes','shobes.id','=','vezives.shobe_id')
       ->orderBy('vezife','desc')
       ->select('*','shobes.ad as shobe','vezives.ad as vezife','vezives.id as vid')
       ->get();}

       else
       {$data = Vezife::join('shobes','shobes.id','=','vezives.shobe_id')
        ->orderBy('vezives.id','asc')
        ->select('*','shobes.ad as shobe','vezives.ad as vezife','vezives.id as vid')
        ->get();}
     
    }
     else
     {$data = Vezife::where('ad','LIKE','%'.$x->axtar.'%')->get();}
     $say = Vezife::count();
     $shobes = Shobe::orderBy('ad','asc')->get();
     return view('vezife',[
        'data'=>$data,
        'shobes'=>$shobes,
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


    public function vezife(vezifeRequest $post){
        if(!empty($post->ad)){
            $con = new Vezife();
            $con->shobe_id = $post->shobe_id;
            $con->ad = $post->ad;
            $con->save();

            return redirect()->route('vezife')->with('mesaj','Vəzife uğurla əlavə edildi');

     
        }
        return redirect()->route('vezife')->with('mesaj','Vəzifəni əlavə etmək mümkün olmadı');
    }
}
