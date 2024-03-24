<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\komendantRequest;

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


class komendantController extends Controller
{
    public function k_update(komendantRequest $post,$id){
        $con=  Komendant::find($id);
        
        $post->validate([
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:10000|dimensions:min_width=100,min_height=100,max_width=2000,max_height=5000',
        ]);
        if($post ->file('image'))
        {
            $file = time().'.'.$post->image->extension();
            $post->image->storeAs('public/uploads/komendants',$file);
            $con->image='storage/uploads/komendants/'.$file;
        }
        $con->staff_data = $post->staff_data;
        $con->tapsiriq = $post->tapsiriq;
        $con->tarix = $post->tarix;
        $con->vaxt = $post->vaxt;

        $con->save();

        return redirect()->route('komendant')->with('mesaj','Məlumatlar uğurla yeniləndi');

    }



    public function k_edit($id){
        $user_id = Auth::id();
   
        $bsay = Brend::where('user_id','=',$user_id)->count();
        $csay = Clients::where('user_id','=',$user_id)->count();
        $ssay = Order::where('user_id','=',$user_id)->count();
        $psay = Products::where('user_id','=',$user_id)->count();
        $xsay = Xerc::where('user_id','=',$user_id)->count();
        $tsay = Komendant::where('user_id','=',$user_id)->count();
        $userinfo = User::find('user_id');
        $step = '';
        $data = Komendant::join('staff','staff.id','=','komendants.staff_data')
        ->orderBy('komendants.id','asc')
        ->select('*','staff.ad as ad','staff.soyad as soyad','komendants.id as kid')
        ->get();
        $say = Komendant::count();
        $staffs = Staff::orderBy('ad','asc')->get();
        $edit_data = Komendant::find($id);


        $aktiv = 0;
        $tamam = 0;
        $toplam = 0;

        foreach($data as $info){
        
            $t1 = $info->tarix.' '.$info->vaxt;
            $t1 = strtotime($t1);
  
            $t2 = time();
  
            $san = $t1 - $t2;
            $deq = round($san/60);
            $saat = round($deq/60);
            $gun = round($saat/24);
  
            if($deq<60 && $san>0)
            {$qaliq = $deq.' deqiqe'; $aktiv++;}
            elseif($deq>60 && $saat<24)
            {$qaliq = $saat.' saat'; $aktiv++;}
            elseif($saat>23)
            {$qaliq = $gun.' gun'; $aktiv++;}
            else
            {$qaliq = 'Tamam'; $tamam++;}
  
      
   
    }

    $toplam = $aktiv + $tamam;
       
    

	 

        return view('komendant',[
           'data'=>$data,
           'say'=>$say,
           'step'=>$step,
           'toplam'=>$toplam,
           'tamam'=>$tamam,
           'active'=>$aktiv,
           'staffs'=>$staffs,
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



    public function k_del($id){
        $komendant_sil = Komendant::find($id)->delete();

        return redirect()->route('komendant')->with('mesaj','Tapşırığ uğurla silindi');
        
    }



    public function k_sil($id){
        $user_id = Auth::id();
   
        $bsay = Brend::where('user_id','=',$user_id)->count();
        $csay = Clients::where('user_id','=',$user_id)->count();
        $ssay = Order::where('user_id','=',$user_id)->count();
        $psay = Products::where('user_id','=',$user_id)->count();
        $xsay = Xerc::where('user_id','=',$user_id)->count();
        $tsay = Komendant::where('user_id','=',$user_id)->count();
        $userinfo = User::find('user_id');
        $step = '';
        $data = Komendant::join('staff','staff.id','=','komendants.staff_data')
        ->orderBy('komendants.id','asc')
        ->select('*','staff.ad as ad','staff.soyad as soyad','komendants.id as kid')
        ->get();
        $say = Komendant::count();
        $staffs = Staff::orderBy('ad','asc')->get();


        $aktiv = 0;
        $tamam = 0;
        $toplam = 0;

        foreach($data as $info){
        
            $t1 = $info->tarix.' '.$info->vaxt;
            $t1 = strtotime($t1);
  
            $t2 = time();
  
            $san = $t1 - $t2;
            $deq = round($san/60);
            $saat = round($deq/60);
            $gun = round($saat/24);
  
            if($deq<60 && $san>0)
            {$qaliq = $deq.' deqiqe'; $aktiv++;}
            elseif($deq>60 && $saat<24)
            {$qaliq = $saat.' saat'; $aktiv++;}
            elseif($saat>23)
            {$qaliq = $gun.' gun'; $aktiv++;}
            else
            {$qaliq = 'Tamam'; $tamam++;}
  
         
   
    }

    $toplam = $aktiv + $tamam;
       
    

	 

        return view('komendant',[
           'data'=>$data,
           'say'=>$say,
           'step'=>$step,
           'toplam'=>$toplam,
           'tamam'=>$tamam,
           'active'=>$aktiv,
           'staffs'=>$staffs,
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


    public function index(Request $x){
        $user_id = Auth::id();
   
        $bsay = Brend::where('user_id','=',$user_id)->count();
        $csay = Clients::where('user_id','=',$user_id)->count();
        $ssay = Order::where('user_id','=',$user_id)->count();
        $psay = Products::where('user_id','=',$user_id)->count();
        $xsay = Xerc::where('user_id','=',$user_id)->count();
        $tsay = Komendant::where('user_id','=',$user_id)->count();
        $userinfo = User::find('user_id');

        $step = '';
        $axtar = '';
        if(empty($x->axtar))
        {
            if($x->f1 == 'ASC')
            {$data=Komendant::join('staff','staff.id','=','komendants.staff_data')
                ->orderBy('staff.ad','asc')
                ->select('*','staff.ad as ad','staff.soyad as soyad','komendants.id as kid')
                ->get();}
            elseif($x->f1 == 'DESC')
            {$data=Komendant::join('staff','staff.id','=','komendants.staff_data')
                ->orderBy('staff.ad','desc')
                ->select('*','staff.ad as ad','staff.soyad as soyad','komendants.id as kid')
                ->get();}

            elseif($x->f2 == 'ASC')
            {$data=Komendant::join('staff','staff.id','=','komendants.staff_data')
                ->orderBy('komendants.tapsiriq','asc')
                ->select('*','staff.ad as ad','staff.soyad as soyad','komendants.id as kid')
                ->get();}
            elseif($x->f2 == 'DESC')
            {$data=Komendant::join('staff','staff.id','=','komendants.staff_data')
                ->orderBy('komendants.tapsiriq','desc')
                ->select('*','staff.ad as ad','staff.soyad as soyad','komendants.id as kid')
                ->get();}

            elseif($x->f3 == 'ASC')
            {$data=Komendant::join('staff','staff.id','=','komendants.staff_data')
                ->orderBy('komendants.tarix','asc')
                ->select('*','staff.ad as ad','staff.soyad as soyad','komendants.id as kid')
                ->get();}
            elseif($x->f3 == 'DESC')
            {$data=Komendant::join('staff','staff.id','=','komendants.staff_data')
                ->orderBy('komendants.tarix','desc')
                ->select('*','staff.ad as ad','staff.soyad as soyad','komendants.id as kid')
                ->get();}

            elseif($x->f4 == 'ASC')
            {$data=Komendant::join('staff','staff.id','=','komendants.staff_data')
                ->orderBy('komendants.vaxt','asc')
                ->select('*','staff.ad as ad','staff.soyad as soyad','komendants.id as kid')
                ->get();}
            elseif($x->f4 == 'DESC')
            {$data=Komendant::join('staff','staff.id','=','komendants.staff_data')
                ->orderBy('komendants.vaxt','desc')
                ->select('*','staff.ad as ad','staff.soyad as soyad','komendants.id as kid')
                ->get();}

            else
            { $data = Komendant::join('staff','staff.id','=','komendants.staff_data')
                ->orderBy('komendants.id','asc')
                ->select('*','staff.ad as ad','staff.soyad as soyad','komendants.id as kid')
                ->get();}
        }
        else
        {$data  = Komendant::where('tapsiriq','LIKE','%'.$x->axtar.'%')->get();}
        $say = Komendant::count();
        $staffs = Staff::orderBy('ad','asc')->get();


        $aktiv = 0;
        $tamam = 0;
        $toplam = 0;

        foreach($data as $info){
        
            $t1 = $info->tarix.' '.$info->vaxt;
            $t1 = strtotime($t1);
  
            $t2 = time();
  
            $san = $t1 - $t2;
            $deq = round($san/60);
            $saat = round($deq/60);
            $gun = round($saat/24);
  
            if($deq<60 && $san>0)
            {$qaliq = $deq.' deqiqe'; $aktiv++;}
            elseif($deq>60 && $saat<24)
            {$qaliq = $saat.' saat'; $aktiv++;}
            elseif($saat>23)
            {$qaliq = $gun.' gun'; $aktiv++;}
            else
            {$qaliq = 'Tamam'; $tamam++;}
  
    
   
    }

    $toplam = $aktiv + $tamam;
       
    

	 

        return view('komendant',[
           'data'=>$data,
           'say'=>$say,
           'step'=>$step,
           'toplam'=>$toplam,
           'tamam'=>$tamam,
           'active'=>$aktiv,
           'staffs'=>$staffs,
           'bsay'=>$bsay,
           'csay'=>$csay,
           'ssay'=>$ssay,
           'psay'=>$psay,
           'xsay'=>$xsay,
           'tsay'=>$tsay,
           'userinfo'=>$userinfo,
           
           

        ]);
    }


    public function komendant_say(Request $x){
        $user_id = Auth::id();
   
        $bsay = Brend::where('user_id','=',$user_id)->count();
        $csay = Clients::where('user_id','=',$user_id)->count();
        $ssay = Order::where('user_id','=',$user_id)->count();
        $psay = Products::where('user_id','=',$user_id)->count();
        $xsay = Xerc::where('user_id','=',$user_id)->count();
        $tsay = Komendant::where('user_id','=',$user_id)->count();
        $userinfo = User::find('user_id');
        $data = Komendant::get();
        $say = Komendant::count();
        
        $step = '';
        if($x->btn == 'aktiv')
        {$step = 'aktiv';}
        elseif($x->btn == 'tamam')
        {$step = 'tamam';}
        elseif($x->btn == 'toplam')
        {$step = 'toplam';}

        
        $aktiv = 0;
        $tamam = 0;
        $toplam = 0;


        foreach($data as $info){
        
          $t1 = $info->tarix.' '.$info->vaxt;
          $t1 = strtotime($t1);

          $t2 = time();



          $san = $t1 - $t2;
          $deq = round($san/60);
          $saat = round($deq/60);
          $gun = round($saat/24);


          if($deq<60 && $san>0)
          {$qaliq = $deq.' deqiqe'; $aktiv++;}
          elseif($deq>60 && $saat<24)
          {$qaliq = $saat.' saat'; $aktiv++;}
          elseif($saat>23)
          {$qaliq = $gun.' gun'; }
          else
          {$qaliq = 'Tamam'; $tamam++;}

          

          $toplam = $aktiv + $tamam;

          
 
        }
         return view('komendant',[
            'data'=>$data,
            'say'=>$say,
            'step'=>$step,
            'toplam'=>$toplam,
            'active'=>$aktiv,
            'tamam'=>$tamam,
            'bsay'=>$bsay,
            'csay'=>$csay,
            'ssay'=>$ssay,
            'psay'=>$psay,
            'xsay'=>$xsay,
            'tsay'=>$tsay,
            'userinfo'=>$userinfo,
            
            
 
         ]);

    }

    


    public function komendant(komendantRequest $post){
        $con= new Komendant();

        $post->validate([
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:10000|dimensions:min_width=100,min_height=100,max_width=2000,max_height=5000',
        ]);
        if($post ->file('image'))
        {
            $file = time().'.'.$post->image->extension();
            $post->image->storeAs('public/uploads/komendants',$file);
            $con->image='storage/uploads/komendants/'.$file;
        }
        $con->staff_data = $post->staff_data;
        $con->tapsiriq = $post->tapsiriq;
        $con->tarix = $post->tarix;
        $con->vaxt = $post->vaxt;
        $con->user_id = Auth::id();

        $con->save();

        return redirect()->route('komendant')->with('mesaj','Məlumatlar uğurla əlavə edildi');

    }


}
