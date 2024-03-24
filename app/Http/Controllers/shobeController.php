<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\shobeRequest;
use App\Models\Shobe;

use App\Models\Staff;
use App\Models\Vezife;

use App\Models\Clients;
use App\Models\Order;
use App\Models\Brend;
use App\Models\Products;
use App\Models\Xerc;
use App\Models\User;
use App\Models\Komendant;
use Illuminate\Support\Facades\Auth;



class shobeController extends Controller
{
    public function shobe_update(shobeRequest $post, $id){
        $con = Shobe::find($id);

        $con->ad = $post->ad;
        $con->save();

        return redirect()->route('shobe')->with('mesaj','Şöbə uğurla redakte edildi');

    }

    public function shobe_edit($id){
        
        $user_id = Auth::id();

        $bsay = Brend::where('user_id','=',$user_id)->count();
        $csay = Clients::where('user_id','=',$user_id)->count();
        $ssay = Order::where('user_id','=',$user_id)->count();
        $psay = Products::where('user_id','=',$user_id)->count();
        $xsay = Xerc::where('user_id','=',$user_id)->count();
        $tsay = Komendant::where('user_id','=',$user_id)->count();
        $userinfo = User::find('user_id');

        $data = Shobe::get();
        $say= Shobe::count();
        $edit_data = Shobe::find($id);

        return view('shobe',[
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

   

    public function shobe_sil($id){

        $user_id = Auth::id();

        $bsay = Brend::where('user_id','=',$user_id)->count();
        $csay = Clients::where('user_id','=',$user_id)->count();
        $ssay = Order::where('user_id','=',$user_id)->count();
        $psay = Products::where('user_id','=',$user_id)->count();
        $xsay = Xerc::where('user_id','=',$user_id)->count();
        $tsay = Komendant::where('user_id','=',$user_id)->count();
        $userinfo = User::find('user_id');

        $data = Shobe::get();
        $say = Shobe::count();

        return view('shobe',[
            'data'=> $data,
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

    public function shobe_del($id){
    $shobe_sil = Shobe::find($id)->delete();

    return redirect()->route('shobe')->with('mesaj','Şöbə uğurla silindi');
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
    {$data = Shobe::orderBy('ad','asc')->get();}
    elseif($x->f1=='DESC')
    {$data = Shobe::orderBy('ad','desc')->get();}
    else
    {$data = Shobe::orderBy('id','asc')->get();}
   }
   else
   {$data = Shobe::where('ad','LIKE','%'.$x->axtar.'%')->get();}
    $say = Shobe::count();

    return view('shobe',[
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



    public function shobe(shobeRequest $post){
        
        $con = new Shobe();
        $con->ad = $post->ad;
        $con->save();

        return redirect()->route('shobe')->with('mesaj','Şöbə ugurla əlavə edildi');
    }
}
