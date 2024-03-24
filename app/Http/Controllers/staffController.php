<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\staffRequest;
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

class staffController extends Controller
{
     public function s_update(staffRequest $post, $id){
      
            $telefon = Staff::where('telefon','=',$post->telefon)->where('id','!=', $id)->count();
            $email = Staff::where('email','=',$post->email)->where('id','!=', $id)->count();

            $con = Staff::find($id);

            if($telefon==0 and $email == 0){

                if($post->file('image')){
                    $post->validate([
                        'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:10000|dimensions:min_width=100,min_height=100,max_width=2000,max_height=5000',
                    ]);

                    $file = time().'.'. $post->image->extension();
                    $post->image->storeAs('public/uploads/staff',$file);
                    $con->image='storage/uploads/staff/'.$file; 
                }


                $con->shobe_id = $post->shobe_id; 
                $con->vezife_id = $post->vezife_id;
                $con->ad = $post->ad;
                $con->soyad = $post->soyad;
                $con->d_tarix = $post->d_tarix;
                $con->telefon = $post->telefon;
                $con->email = $post->email;
                $con->maash = $post->maash;
                $con->i_tarix = $post->i_tarix;
                

                $con -> save();

                return redirect()->route('staff')->with('mesaj',' Staff uğurla yeniləndi');

            }
            

     

     }


    public function staff_edit($id){
        $edit_data = Staff::find($id);
        $user_id = Auth::id();

        $bsay = Brend::where('user_id','=',$user_id)->count();
        $csay = Clients::where('user_id','=',$user_id)->count();
        $ssay = Order::where('user_id','=',$user_id)->count();
        $psay = Products::where('user_id','=',$user_id)->count();
        $xsay = Xerc::where('user_id','=',$user_id)->count();
        $tsay = Komendant::where('user_id','=',$user_id)->count();
        $userinfo = User::find('user_id');



           $data = Staff::join('vezives','vezives.id','=','staff.vezife_id')
           ->join('shobes','shobes.id','=','vezives.shobe_id')
           ->orderBy('staff.id','asc')
           ->select('*','shobes.ad as shobe','staff.ad as staff_ad','vezives.ad as vezife','staff.id as sid')
           ->get();
           $vezife = Vezife::orderBy('ad','asc')->get();
           $shobes = Shobe::orderBy('ad','asc')->get();
           $say = Staff::count();

           return view('staff',[
            'data'=>$data,
            'vezife'=>$vezife,
            'shobes'=>$shobes,
            'say'=>$say,
            'edit_data'=>$edit_data,
            'bsay'=>$bsay,
            'csay'=>$csay,
            'ssay'=>$ssay,
            'psay'=>$psay,
            'xsay'=>$xsay,
            'tsay'=>$tsay,
            'userinfo'=>$userinfo,


           ]);
    }


    public function staff_sil($id){


        $user_id = Auth::id();

        $bsay = Brend::where('user_id','=',$user_id)->count();
        $csay = Clients::where('user_id','=',$user_id)->count();
        $ssay = Order::where('user_id','=',$user_id)->count();
        $psay = Products::where('user_id','=',$user_id)->count();
        $xsay = Xerc::where('user_id','=',$user_id)->count();
        $tsay = Komendant::where('user_id','=',$user_id)->count();
        $userinfo = User::find('user_id');

        $data = Staff::join('vezives','vezives.id','=','staff.vezife_id')
        ->join('shobes','shobes.id','=','vezives.shobe_id')
        ->orderBy('staff.id','asc')
        ->select('*','shobes.ad as shobe','staff.ad as staff_ad','vezives.ad as vezife','staff.id as sid')
        ->get();
        $vezife = Vezife::orderBy('ad','asc')->get();
        $shobes = Shobe::orderBy('ad','asc')->get();
        $say = Staff::count();

        return view('staff',[
         'data'=>$data,
         'vezife'=>$vezife,
         'shobes'=>$shobes,
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


    public function s_del($id){
       $staff_del= Staff::find($id)->delete();

       return redirect()->route('staff')->with('mesaj','Məlumat uğurla silindi');
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

        $axtar='';
        if(empty($x->axtar))

        {
         if($x->f1=='ASC')   
        {$data = Staff::join('vezives','vezives.id','=','staff.vezife_id')
        ->join('shobes','shobes.id','=','vezives.shobe_id')
        ->orderBy('vezives.ad','asc')
        ->select('*','shobes.ad as shobe','staff.ad as staff_ad','vezives.ad as vezife','staff.id as sid')
        ->get();}

        elseif($x->f1=='DESC')   
        {$data = Staff::join('vezives','vezives.id','=','staff.vezife_id')
        ->join('shobes','shobes.id','=','vezives.shobe_id')
        ->orderBy('vezives.ad','desc')
        ->select('*','shobes.ad as shobe','staff.ad as staff_ad','vezives.ad as vezife','staff.id as sid')
        ->get();}

        elseif($x->f2=='ASC')   
        {$data = Staff::join('vezives','vezives.id','=','staff.vezife_id')
        ->join('shobes','shobes.id','=','vezives.shobe_id')
        ->orderBy('shobes.ad','asc')
        ->select('*','shobes.ad as shobe','staff.ad as staff_ad','vezives.ad as vezife','staff.id as sid')
        ->get();}

        elseif($x->f2=='DESC')   
        {$data = Staff::join('vezives','vezives.id','=','staff.vezife_id')
        ->join('shobes','shobes.id','=','vezives.shobe_id')
        ->orderBy('shobes.ad','desc')
        ->select('*','shobes.ad as shobe','staff.ad as staff_ad','vezives.ad as vezife','staff.id as sid')
        ->get();}

        elseif($x->f3=='ASC')   
        {$data = Staff::join('vezives','vezives.id','=','staff.vezife_id')
        ->join('shobes','shobes.id','=','vezives.shobe_id')
        ->orderBy('staff.ad','asc')
        ->select('*','shobes.ad as shobe','staff.ad as staff_ad','vezives.ad as vezife','staff.id as sid')
        ->get();}

        elseif($x->f3=='DESC')   
        {$data = Staff::join('vezives','vezives.id','=','staff.vezife_id')
        ->join('shobes','shobes.id','=','vezives.shobe_id')
        ->orderBy('staff.ad','desc')
        ->select('*','shobes.ad as shobe','staff.ad as staff_ad','vezives.ad as vezife','staff.id as sid')
        ->get();}

        elseif($x->f4=='ASC')   
        {$data = Staff::join('vezives','vezives.id','=','staff.vezife_id')
        ->join('shobes','shobes.id','=','vezives.shobe_id')
        ->orderBy('staff.soyad','asc')
        ->select('*','shobes.ad as shobe','staff.ad as staff_ad','vezives.ad as vezife','staff.id as sid')
        ->get();}

        elseif($x->f4=='DESC')   
        {$data = Staff::join('vezives','vezives.id','=','staff.vezife_id')
        ->join('shobes','shobes.id','=','vezives.shobe_id')
        ->orderBy('staff.soyad','desc')
        ->select('*','shobes.ad as shobe','staff.ad as staff_ad','vezives.ad as vezife','staff.id as sid')
        ->get();}

        elseif($x->f5=='ASC')   
        {$data = Staff::join('vezives','vezives.id','=','staff.vezife_id')
        ->join('shobes','shobes.id','=','vezives.shobe_id')
        ->orderBy('staff.d_tarix','asc')
        ->select('*','shobes.ad as shobe','staff.ad as staff_ad','vezives.ad as vezife','staff.id as sid')
        ->get();}

        elseif($x->f5=='DESC')   
        {$data = Staff::join('vezives','vezives.id','=','staff.vezife_id')
        ->join('shobes','shobes.id','=','vezives.shobe_id')
        ->orderBy('staff.d_tarix','desc')
        ->select('*','shobes.ad as shobe','staff.ad as staff_ad','vezives.ad as vezife','staff.id as sid')
        ->get();}

        elseif($x->f6=='ASC')   
        {$data = Staff::join('vezives','vezives.id','=','staff.vezife_id')
        ->join('shobes','shobes.id','=','vezives.shobe_id')
        ->orderBy('staff.telefon','asc')
        ->select('*','shobes.ad as shobe','staff.ad as staff_ad','vezives.ad as vezife','staff.id as sid')
        ->get();}

        elseif($x->f6=='DESC')   
        {$data = Staff::join('vezives','vezives.id','=','staff.vezife_id')
        ->join('shobes','shobes.id','=','vezives.shobe_id')
        ->orderBy('staff.telefon','desc')
        ->select('*','shobes.ad as shobe','staff.ad as staff_ad','vezives.ad as vezife','staff.id as sid')
        ->get();}

        elseif($x->f7=='ASC')   
        {$data = Staff::join('vezives','vezives.id','=','staff.vezife_id')
        ->join('shobes','shobes.id','=','vezives.shobe_id')
        ->orderBy('staff.email','asc')
        ->select('*','shobes.ad as shobe','staff.ad as staff_ad','vezives.ad as vezife','staff.id as sid')
        ->get();}

        elseif($x->f7=='DESC')   
        {$data = Staff::join('vezives','vezives.id','=','staff.vezife_id')
        ->join('shobes','shobes.id','=','vezives.shobe_id')
        ->orderBy('staff.email','desc')
        ->select('*','shobes.ad as shobe','staff.ad as staff_ad','vezives.ad as vezife','staff.id as sid')
        ->get();}

        elseif($x->f8=='ASC')   
        {$data = Staff::join('vezives','vezives.id','=','staff.vezife_id')
        ->join('shobes','shobes.id','=','vezives.shobe_id')
        ->orderBy('staff.maash','asc')
        ->select('*','shobes.ad as shobe','staff.ad as staff_ad','vezives.ad as vezife','staff.id as sid')
        ->get();}

        elseif($x->f8=='DESC')   
        {$data = Staff::join('vezives','vezives.id','=','staff.vezife_id')
        ->join('shobes','shobes.id','=','vezives.shobe_id')
        ->orderBy('staff.maash','desc')
        ->select('*','shobes.ad as shobe','staff.ad as staff_ad','vezives.ad as vezife','staff.id as sid')
        ->get();}

        elseif($x->f9=='ASC')   
        {$data = Staff::join('vezives','vezives.id','=','staff.vezife_id')
        ->join('shobes','shobes.id','=','vezives.shobe_id')
        ->orderBy('staff.i_tarix','asc')
        ->select('*','shobes.ad as shobe','staff.ad as staff_ad','vezives.ad as vezife','staff.id as sid')
        ->get();}

        elseif($x->f9=='DESC')   
        {$data = Staff::join('vezives','vezives.id','=','staff.vezife_id')
        ->join('shobes','shobes.id','=','vezives.shobe_id')
        ->orderBy('staff.i_tarix','desc')
        ->select('*','shobes.ad as shobe','staff.ad as staff_ad','vezives.ad as vezife','staff.id as sid')
        ->get();}

        else
          
        {$data = Staff::join('shobes','shobes.id','=','staff.shobe_id')
        ->join('vezives','vezives.id','=','staff.vezife_id')
        ->orderBy('staff.id','asc')
        ->select('*','shobes.ad as shobe','staff.ad as staff_ad','vezives.ad as vezife','staff.id as sid')
        ->get();}

       }
        else
        {$data = Staff::where('ad','LIKE','%'.$x->axtar.'%')->orWhere('soyad','LIKE','%'.$x->axtar.'%')->get();}
        $vezife = Vezife::orderBy('ad','asc')->get();
        $shobes = Shobe::orderBy('ad','asc')->get();
        $say = Staff::count();

        return view('staff',[
         'data'=>$data,
         'vezife'=>$vezife,
         'shobes'=>$shobes,
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

    public function staff(staffRequest $post)
    {
        if(!empty($post->ad) && !empty($post->soyad) && !empty($post->email))
        {
            $con = new Staff();
            if($post->file('image')){
                $post->validate([
                    'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:10000|dimensions:min_width=100,min_height=100,max_width=2000,max_height=5000',
                ]);

                $file = time().'.'. $post->image->extension();
                $post->image->storeAs('public/uploads/staff',$file);
                $con->image='storage/uploads/staff/'.$file; 
            }
            
                $con->shobe_id = $post->shobe_id; 
                $con->vezife_id = $post->vezife_id;
                $con->ad = $post->ad;
                $con->soyad = $post->soyad;
                $con->d_tarix = $post->d_tarix;
                $con->telefon = $post->telefon;
                $con->email = $post->email;
                $con->maash = $post->maash;
                $con->i_tarix = $post->i_tarix;
                

                $con -> save();

                return redirect()->route('staff')->with('mesaj','Daxil etdiyiniz Staff uğurla əlavə edildi');


            

        }
    }
}
