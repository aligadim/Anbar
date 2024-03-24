<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\brendRequest;

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

class brendController extends Controller
{

    


    public function brend_update(brendRequest $post, $id){
        $user_id = Auth::id();
        if(!empty($post->ad))
        {
        $ad = Brend::where('ad','=',$post->ad)->where('user_id','=',$user_id)->count();
        
        
        if($ad==0)
        {
            $con = Brend::find($id);

            if($post->file('image'))
            {
                $post->validate([
                    'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:10000|dimensions:min_width=100,min_height=100,max_width=2000,max_height=5000',
                ]);

                
                    $file = time().'.'.$post->image->extension();
                    $post->image->storeAs('public/uploads/brands',$file);
                    $con->image = 'storage/uploads/brands/'.$file; 
            }


            $con->user_id = $user_id;
            $con->ad = $post->ad;
            $con->save();


            

            return redirect()->route('brend')->with('mesaj','Məlumatlar uğurla yeniləndi');


        }
        }
        
    }


    public function brend_edit($id){
       
        $user_id = Auth::id();  
       
        $edit_data = Brend::find($id);
        $data = Brend::orderBy('id','desc')->get();
        $say = Brend::count();
        $user_id = Auth::id();

        $bsay = Brend::where('user_id','=',$user_id)->count();
        $csay = Clients::where('user_id','=',$user_id)->count();
        $ssay = Order::where('user_id','=',$user_id)->count();
        $psay = Products::where('user_id','=',$user_id)->count();
        $xsay = Xerc::where('user_id','=',$user_id)->count();
        $tsay = Komendant::where('user_id','=',$user_id)->count();
        $userinfo = User::find('user_id');
            
            return view('brend',[
                'data'=>$data,
                'say'=>$say,
                'bsay'=>$bsay,
                'csay'=>$csay,
                'ssay'=>$ssay,
                'psay'=>$psay,
                'xsay'=>$xsay,
                'tsay'=>$tsay,
                'userinfo'=>$userinfo,
                'edit_data'=>$edit_data,
            
        ]);
    }



     public function brend_sil($id){
        $data = Brend::orderBy('id','desc')->get();
        $say = Brend::count();
        $user_id = Auth::id();

        $bsay = Brend::where('user_id','=',$user_id)->count();
        $csay = Clients::where('user_id','=',$user_id)->count();
        $ssay = Order::where('user_id','=',$user_id)->count();
        $psay = Products::where('user_id','=',$user_id)->count();
        $xsay = Xerc::where('user_id','=',$user_id)->count();
        $tsay = Komendant::where('user_id','=',$user_id)->count();
        $userinfo = User::find('user_id');
            
            return view('brend',[
                'data'=>$data,
                'say'=>$say,
                'bsay'=>$bsay,
                'csay'=>$csay,
                'ssay'=>$ssay,
                'psay'=>$psay,
                'xsay'=>$xsay,
                'tsay'=>$tsay,
                'userinfo'=>$userinfo,
                 'sil_id'=>$id,

        ]);
     }

    public function brend_del($id){

        $yoxla = Products::where('products.brand_id','=',$id)->count();
        if($yoxla==0)
        {
            $brend_sil = Brend::find($id)->delete();
            return redirect()->route('brend')->with('mesaj','Məlumatlar uğurla silindi');
        }

        return redirect()->route('brend')->with('mesaj','Brendi silmək mümkün olmadı! Çünki brend aktiv məhsula malikdir');

        
    }

    public function index(Request $x){
        $user_id = Auth::id();
        $axtar = '';

        if(empty($x->axtar))
        {
            if($x->f1=='ASC')
            {$data = Brend::orderBy('ad','desc')->get();}
            elseif($x->f1=='DESC')
            {$data = Brend::orderBy('ad','asc')->get();}
            elseif($x->f2=='DESC')
            {$data = Brend::orderBy('ad','desc')->get();}
            elseif($x->f2=='DESC')
            {$data = Brend::orderBy('ad','desc')->get();}
            else
            {$data = Brend::orderBy('id','desc')->get();}
        }
        else
        {$data = Brend::where('ad','LIKE','%'.$x->axtar.'%')->orderBy('ad','desc')->get();}



        $say = Brend::count();


    

    $bsay = Brend::where('user_id','=',$user_id)->count();
    $csay = Clients::where('user_id','=',$user_id)->count();
    $ssay = Order::where('user_id','=',$user_id)->count();
    $psay = Products::where('user_id','=',$user_id)->count();
    $xsay = Xerc::where('user_id','=',$user_id)->count();
    $tsay = Komendant::where('user_id','=',$user_id)->count();
    $userinfo = User::find('user_id');
        
        return view('brend',[
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


   


        
     
    
    public function brend(brendRequest $post){
        $user_id = Auth::id();
     if(!empty($post->ad))
     {
        $yoxla = Brend::where('ad','=',$post->ad)->where('user_id','=',$user_id)->count();
        if($yoxla==0)
        {

        $con = new Brend();
        $post->validate([
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:10000|dimensions:min_width=100,min_height=100,max_width=2000,max_height=5000',
        ]);

        if($post->file('image'))
        {
            $file=time().'.'.$post->image->extension();
            $post->image->storeAs('public/uploads/brands',$file);
            $con->image = 'storage/uploads/brands/'.$file; 
        }
        $con->user_id = $user_id;
        $con->ad = $post->ad;
        $con ->save();

        return redirect()->route('brend')->with('mesaj','Məlumat uğurla daxil edildi');
        }

     }
     return redirect()->route('brend')->with('mesaj','Brend artıq mövcuddur');


    }


    
}
