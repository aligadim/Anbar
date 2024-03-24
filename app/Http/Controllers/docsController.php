<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\docsRequest;
use App\Models\Staff;
use App\Models\Docs;
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


class docsController extends Controller
{ 
    public function docs_update(docsRequest $post,$id){
       $con = Docs::find($id);

       if($post->file('image')){

        $post->validate([
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:10000|dimensions:min_width=100,min_height=100,max_width=2000,max_height=5000',
        ]);

        $file= time().'.'.$post->image->extension();
        $post->image->storeAs('public/uploads/docs',$file);
        $con->image='storage/uploads/docs/'.$file;
    }

       $con->basliq = $post->basliq;
       $con->haqqinda = $post->haqqinda;

       $con->save();

       return redirect()->route('docs',$id)->with('mesaj','Məlumatlar uğurla yeniləndi');
    }



    public function docs_edit($id){
        $edit_data = Docs::find($id);
        $data =Docs::where('staff_id','=',$id)->get();
        $say = Docs::count();
        $staff = Staff::find($id);
        $user_id = Auth::id();

        $bsay = Brend::where('user_id','=',$user_id)->count();
        $csay = Clients::where('user_id','=',$user_id)->count();
        $ssay = Order::where('user_id','=',$user_id)->count();
        $psay = Products::where('user_id','=',$user_id)->count();
        $xsay = Xerc::where('user_id','=',$user_id)->count();
        $tsay = Komendant::where('user_id','=',$user_id)->count();
        $userinfo = User::find('user_id');


        return view('docs',[
            'data'=>$data,
            'say'=>$say,
            'edit_data'=>$edit_data,
            'staff'=>$staff,
            'staff_id'=>$id,
            'bsay'=>$bsay,
            'csay'=>$csay,
            'ssay'=>$ssay,
            'psay'=>$psay,
            'xsay'=>$xsay,
            'tsay'=>$tsay,
            'userinfo'=>$userinfo
        ]);
    }


    public function docs_del($id){
        $staff = Staff::find($id);
        $data = Docs::where('staff_id','=',$id)->get();
        $say = Docs::count();
        $user_id = Auth::id();

        $bsay = Brend::where('user_id','=',$user_id)->count();
        $csay = Clients::where('user_id','=',$user_id)->count();
        $ssay = Order::where('user_id','=',$user_id)->count();
        $psay = Products::where('user_id','=',$user_id)->count();
        $xsay = Xerc::where('user_id','=',$user_id)->count();
        $tsay = Komendant::where('user_id','=',$user_id)->count();
        $userinfo = User::find('user_id');
        return view('docs',[
            'data'=>$data,
            'say'=>$say,
            'sil_id'=>$id,
            'staff'=>$staff,
            'staff_id'=>$id,
            'bsay'=>$bsay,
            'csay'=>$csay,
            'ssay'=>$ssay,
            'psay'=>$psay,
            'xsay'=>$xsay,
            'tsay'=>$tsay,
            'userinfo'=>$userinfo
        ]);
        
    }

    public function docs_sil($id){
        $d_sil = Docs::find($id)->delete();

        return redirect()->route('docs',$id)->with('mesaj','Sənəd uğurla silindi');
    }

     public function index(Request $x,$id){
        $staff = Staff::find($id);
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
        {$data = Docs::where('staff_id','=',$id)->get();}
        else
        {$data = Docs::where('basliq','LIKE','%'.$x->axtar.'%')->orWhere('haqqinda','LIKE','%'.$x->axtar.'%')->get();}
        $say = Docs::count();

        return view('docs',[
            'data'=>$data,
            'say'=>$say,
            'staff'=>$staff,
            'staff_id'=>$id,
            'bsay'=>$bsay,
            'csay'=>$csay,
            'ssay'=>$ssay,
            'psay'=>$psay,
            'xsay'=>$xsay,
            'tsay'=>$tsay,
            'userinfo'=>$userinfo
        ]);
        
        

     }


    public function docs(docsRequest $post,$id){ 
      
        $con = new Docs();

        if($post->file('image')){

            $post->validate([
                'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:10000|dimensions:min_width=100,min_height=100,max_width=2000,max_height=5000',
            ]);

            $file= time().'.'.$post->image->extension();
            $post->image->storeAs('public/uploads/docs',$file);
            $con->image='storage/uploads/docs/'.$file;
        }

        $con->basliq = $post->basliq;
        $con->haqqinda = $post->haqqinda;
        $con->staff_id = $id;
  
        $con->save();

        return redirect()->route('docs',$id)->with('mesaj','Məlumat uğurla əlavə edildi');
    }
    
}
