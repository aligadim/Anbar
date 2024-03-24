<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;



use App\Http\Requests\clientRequest;


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

class clientController extends Controller
{
    public function update(clientRequest $post, $id){
if(!empty($post->ad) && !empty($post->soyad) && !empty($post->tel) && !empty($post->email) && !empty($post->sirket))
{
    $tel = Clients::where('tel','=',$post->tel)->where('id','!=',$id)->count();
    $email = Clients::where('email','=',$post->email)->where('id','!=',$id)->count();
    if($tel==0 and $email==0)
    {
        $con = Clients::find($id);

        if($post->file('image'))
        {
            
            $post->validate([
                'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:10000|dimensions:min_width=100,min_height=100,max_width=2000,max_height=5000',
            ]);
            $file = time().'.'. $post->image->extension();
            $post->image->storeAs('public/uploads/clients',$file);
            $con->image='storage/uploads/clients/'.$file; 
        }
        
        $con->ad = $post->ad;
        $con->soyad = $post->soyad;
        $con->tel = $post->tel;
        $con->email = $post->email;
        $con->sirket = $post->sirket;

        $con->save();

        return redirect()->route('client')->with('mesaj','Məlumatlar uğurla yeniləndi');
    }

    }    
    }
    public function edit($id){
        $data= Clients::orderBy('id','desc')->get();
        $say = Clients::count();
        $edit_data = Clients::find($id);
        $user_id = Auth::id();

        $bsay = Brend::where('user_id','=',$user_id)->count();
        $csay = Clients::where('user_id','=',$user_id)->count();
        $ssay = Order::where('user_id','=',$user_id)->count();
        $psay = Products::where('user_id','=',$user_id)->count();
        $xsay = Xerc::where('user_id','=',$user_id)->count();
        $tsay = Komendant::where('user_id','=',$user_id)->count();
        $userinfo = User::find('user_id');





        

            
        return view('client',[
            'data'=>$data,
            'say'=> $say,
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

    public function sil($id){
        $data = Clients::orderBy('id','desc')->get();
        $say = Clients::count();
        $user_id = Auth::id();

        $bsay = Brend::where('user_id','=',$user_id)->count();
        $csay = Clients::where('user_id','=',$user_id)->count();
        $ssay = Order::where('user_id','=',$user_id)->count();
        $psay = Products::where('user_id','=',$user_id)->count();
        $xsay = Xerc::where('user_id','=',$user_id)->count();
        $tsay = Komendant::where('user_id','=',$user_id)->count();
        $userinfo = User::find('user_id');

       

        return view('client',[
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

   public function del($id){
        $yoxla = Order::where('orders.client_id','=',$id)->count();
        if($yoxla==0)
         {
            $clients_sil = Clients::find($id)->delete();

            return redirect()->route('client')->with('mesaj','Məlumatlar uğurla silindi');
         }
         return redirect()->route('client')->with('mesaj','Məlumatları siməy mümkün olmadı! Çünki Müştəri aktiv sifarişə malikdir');
    }

public function index(Request $x){
    $user_id = Auth::id();
    $axtar = '';


    if(empty($x->axtar))
    {
        if($x->f1=='ASC')
        {$data = Clients::orderBy('ad','desc')->get();}
        elseif($x->f1=='DESC')
        {$data = Clients::orderBy('ad','asc')->get();}

        elseif($x->f2=='ASC')
        {$data = Clients::orderBY('soyad','desc')->get();}
        elseif($x->f2 =='DESC')
        {$data = Clients::orderBy('soyad','asc')->get();}

        elseif($x->f3=='ASC')
        {$data = Clients::orderBY('soyad','desc')->get();}
        elseif($x->f3 =='DESC')
        {$data = Clients::orderBy('soyad','asc')->get();}

        elseif($x->f4=='ASC')
        {$data = Clients::orderBY('soyad','desc')->get();}
        elseif($x->f4 =='DESC')
        {$data = Clients::orderBy('soyad','asc')->get();}

        elseif($x->f5=='ASC')
        {$data = Clients::orderBY('soyad','desc')->get();}
        elseif($x->f5 =='DESC')
        {$data = Clients::orderBy('soyad','asc')->get();}
        else
        {$data = Clients::orderBy('id','asc')->get();}
    }


    else
    {$data = Clients::where('ad','LIKE','%'.$x->axtar.'%')->orWhere('soyad','LIKE','%'.$x->axtar.'%')->get();}
    $say = Clients::count();
  

    $bsay = Brend::where('user_id','=',$user_id)->count();
    $csay = Clients::where('user_id','=',$user_id)->count();
    $ssay = Order::where('user_id','=',$user_id)->count();
    $psay = Products::where('user_id','=',$user_id)->count();
    $xsay = Xerc::where('user_id','=',$user_id)->count();
    $tsay = Komendant::where('user_id','=',$user_id)->count();
    $userinfo = User::find('user_id');
    return view('client',[
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



    public function clients(clientRequest $post){
        $user_id = Auth::id();
if(!empty($post->ad) && !empty($post->soyad) && !empty($post->ad) && !empty($post->soyad) && !empty($post->soyad))
{
    $yoxla = Clients::where('tel','=',$post->tel)->orwhere('email','=',$post->email)->count();
    if($yoxla==0)
    {
    $con = new Clients();
    $post->validate([
        'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:10000|dimensions:min_width=100,min_height=100,max_width=2000,max_height=5000',
    ]);
    if($post->file('image'))
    {
        $file = time().'.'.$post->image->extension();
        $post->image->storeAs('public/uploads/clients',$file);
        $con->image = 'storage/uploads/clients/'.$file;
    }

    $con->ad = $post->ad;
    $con->soyad = $post->soyad;
    $con->tel = $post->tel;
    $con->email = $post->email;
    $con->sirket = $post->sirket;
    $con->user_id = $user_id;

    $con->save();

    return redirect()->route('client')->with('mesaj','Məlumat uğurla daxil edildi');
    }
}
return redirect()->route('client')->with('mesaj','Məlumat artıq mövcuddur');
       
}
}
