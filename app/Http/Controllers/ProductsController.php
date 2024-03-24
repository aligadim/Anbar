<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
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

class ProductsController extends Controller
{
    public function pr_update(ProductRequest $post, $id){
        if(!empty($post->ad) && !empty($post->alis) && !empty($post->satis) && !empty($post->miqdar))
        {
            
            
                $con = Products::find($id);
                if($post->file('image'))
                {
                  
                
                $post->validate([
                    'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:10000|dimensions:min_width=100,min_height=100,max_width=2000,max_height=5000',
                ]);
                $file= time().'.'.$post->image->extension();
                $post->image->storeAs('public/uploads/products',$file);
                $con ->image='storage/uploads/products/'.$file;

               }
                
                $con->brand_id = $post->brand_id;
                $con->ad = $post->ad;
                $con->alis = $post->alis;
                $con->satis = $post->satis;
                $con->miqdar = $post->miqdar;
                $con->tehcizat_id = $post->tehcizat_id;
                $con->save();

                return redirect()->route('product')->with('mesaj','Məlumatlar uğurla yeniləndi');
            
        }
    }

 public function pr_edit($id){
    $user_id = Auth::id();

    $bsay = Brend::where('user_id','=',$user_id)->count();
    $csay = Clients::where('user_id','=',$user_id)->count();
    $ssay = Order::where('user_id','=',$user_id)->count();
    $psay = Products::where('user_id','=',$user_id)->count();
    $xsay = Xerc::where('user_id','=',$user_id)->count();
    $tsay = Komendant::where('user_id','=',$user_id)->count();
    $userinfo = User::find('user_id');



        $edit_data = Products::find($id);
        $data = Products::join('brends','brends.id','=','products.brand_id')
        ->join('tehcizats','tehcizats.id','=','products.tehcizat_id')
        ->select('*','products.image as foto','tehcizats.shirket as sihirket','brends.ad as brend','products.ad as mehsul','products.id as pid')
        ->get();
        $say = Products::count();
        $brends = Brend::orderBy('ad','asc')->get();
        $tehcizats = Tehcizat::orderBy('ad','asc')->get();

        return view('product',[
            'data'=>$data,
            'say'=>$say,
            'brends'=>$brends,
            'tehcizats'=>$tehcizats,
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

    public function pr_sil($id){
        $user_id = Auth::id();

        $bsay = Brend::where('user_id','=',$user_id)->count();
        $csay = Clients::where('user_id','=',$user_id)->count();
        $ssay = Order::where('user_id','=',$user_id)->count();
        $psay = Products::where('user_id','=',$user_id)->count();
        $xsay = Xerc::where('user_id','=',$user_id)->count();
        $tsay = Komendant::where('user_id','=',$user_id)->count();
        
        $userinfo = User::find('user_id');


        $data = Products::join('brends','brends.id','=','products.brand_id')
        
        ->join('tehcizats','tehcizats.id','=','products.tehcizat_id')
        ->orderBy('products.id','desc')
        ->select('*','products.image as foto','tehcizats.shirket as sihirket','brends.ad as brend','products.ad as mehsul','products.id as pid')
        ->get();
        $say = Products::count();
        $brends = Brend::orderBy('ad','asc')->get();
        $tehcizats = Tehcizat::orderBy('ad','asc')->get();

        return view('product',[
            'data'=>$data,
            'say'=>$say,
            'brends'=>$brends,
            'tehcizats'=>$tehcizats,
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


    function pr_del($id){

        $yoxla = Order::where('orders.product_id','=',$id)->count();
        if($yoxla==0)
        {
        $product_sil = Products::find($id)->delete();

        return redirect()->route('product')->with('mesaj','Məlumat uğurla silindi');
        }
        return redirect()->route('product')->with('mesaj','Məlumatları silmək mümkün olmadı! Çünki məhsul aktiv sifarişə malikdir');
        
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

        $axtar = "";
        if(empty($x->axtar))
        {
          if($x->f1=='ASC')  
        {$data = Products::join('brends','brends.id','=','products.brand_id')
        ->join('tehcizats','tehcizats.id','=','products.tehcizat_id')
        ->orderBy('tehcizats.shirket','asc')
        ->select('*','products.image as foto','tehcizats.shirket as sihirket','brends.ad as brend','products.ad as mehsul','products.id as pid')
        ->get();}
        elseif($x->f1=='DESC')  
        {$data = Products::join('brends','brends.id','=','products.brand_id')
        ->join('tehcizats','tehcizats.id','=','products.tehcizat_id')
        ->orderBy('tehcizats.shirket','desc')
        ->select('*','products.image as foto','tehcizats.shirket as sihirket','brends.ad as brend','products.ad as mehsul','products.id as pid')
        ->get();}

        elseif($x->f2=='ASC')  
        {$data = Products::join('brends','brends.id','=','products.brand_id')
        ->join('tehcizats','tehcizats.id','=','products.tehcizat_id')
        ->orderBy('brends.ad','asc')
        ->select('*','products.image as foto','tehcizats.shirket as sihirket','brends.ad as brend','products.ad as mehsul','products.id as pid')
        ->get();}

        elseif($x->f2=='DESC')  
        {$data = Products::join('brends','brends.id','=','products.brand_id')
        ->join('tehcizats','tehcizats.id','=','products.tehcizat_id')
        ->orderBy('brends.ad','desc')
        ->select('*','products.image as foto','tehcizats.shirket as sihirket','brends.ad as brend','products.ad as mehsul','products.id as pid')
        ->get();}
        
       

        elseif($x->f3=='ASC')  
        {$data = Products::join('brends','brends.id','=','products.brand_id')
        ->join('tehcizats','tehcizats.id','=','products.tehcizat_id')
        ->orderBy('products.ad','asc')
        ->select('*','products.image as foto','tehcizats.shirket as sihirket','brends.ad as brend','products.ad as mehsul','products.id as pid')
        ->get();}

        elseif($x->f3=='DESC')  
        {$data = Products::join('brends','brends.id','=','products.brand_id')
        ->join('tehcizats','tehcizats.id','=','products.tehcizat_id')
        ->orderBy('products.ad','desc')
        ->select('*','products.image as foto','tehcizats.shirket as sihirket','brends.ad as brend','products.ad as mehsul','products.id as pid')
        ->get();}

        elseif($x->f4=='ASC')  
        {$data = Products::join('brends','brends.id','=','products.brand_id')
        ->join('tehcizats','tehcizats.id','=','products.tehcizat_id')
        ->orderBy('products.alis','asc')
        ->select('*','products.image as foto','tehcizats.shirket as sihirket','brends.ad as brend','products.ad as mehsul','products.id as pid')
        ->get();}

        elseif($x->f4=='DESC')  
        {$data = Products::join('brends','brends.id','=','products.brand_id')
        ->join('tehcizats','tehcizats.id','=','products.tehcizat_id')
        ->orderBy('products.alis','desc')
        ->select('*','products.image as foto','tehcizats.shirket as sihirket','brends.ad as brend','products.ad as mehsul','products.id as pid')
        ->get();}

        elseif($x->f5=='ASC')  
        {$data = Products::join('brends','brends.id','=','products.brand_id')
        ->join('tehcizats','tehcizats.id','=','products.tehcizat_id')
        ->orderBy('products.satis','asc')
        ->select('*','products.image as foto','tehcizats.shirket as sihirket','brends.ad as brend','products.ad as mehsul','products.id as pid')
        ->get();}

        elseif($x->f5=='DESC')  
        {$data = Products::join('brends','brends.id','=','products.brand_id')
        ->join('tehcizats','tehcizats.id','=','products.tehcizat_id')
        ->orderBy('products.stis','desc')
        ->select('*','products.image as foto','tehcizats.shirket as sihirket','brends.ad as brend','products.ad as mehsul','products.id as pid')
        ->get();}

        elseif($x->f6=='ASC')  
        {$data = Products::join('brends','brends.id','=','products.brand_id')
        ->join('tehcizats','tehcizats.id','=','products.tehcizat_id')
        ->orderBy('products.miqdar','asc')
        ->select('*','products.image as foto','tehcizats.shirket as sihirket','brends.ad as brend','products.ad as mehsul','products.id as pid')
        ->get();}

        elseif($x->f6=='DESC')  
        {$data = Products::join('brends','brends.id','=','products.brand_id')
        ->join('tehcizats','tehcizats.id','=','products.tehcizat_id')
        ->orderBy('products.miqdar','desc')
        ->select('*','products.image as foto','tehcizats.shirket as sihirket','brends.ad as brend','products.ad as mehsul','products.id as pid')
        ->get();}
        else
        {
            
        $data = Products::join('brends','brends.id','=','products.brand_id')
        ->join('tehcizats','tehcizats.id','=','products.tehcizat_id')
        ->orderBy('products.alis','asc')
        ->select('*','products.image as foto','tehcizats.shirket as sihirket','brends.ad as brend','products.ad as mehsul','products.id as pid')
        ->get();
        }

    }
        else
        {$data = Products::where('ad','LIKE','%'.$x->axtar.'%')->get();}
        
        
        $say = Products::count();
        $brends = Brend::orderBy('ad','asc')->get();
        $tehcizats = Tehcizat::orderBy('ad','asc')->get();
        $userinfo = User::find('user_id');
        return view('product',[
            'data'=>$data,
            'say'=>$say,
            'brends'=>$brends, 
            'tehcizats'=>$tehcizats,
            'bsay'=>$bsay,
            'csay'=>$csay,
            'ssay'=>$ssay,
            'psay'=>$psay,
            'xsay'=>$xsay,
            'tsay'=>$tsay,
            'userinfo'=>$userinfo,
        ]);

    }



    public function product(ProductRequest $post){
         $user_id = Auth::id();
       if(!empty($post->ad) && !empty($post->alis) && !empty($post->satis) && !empty($post->miqdar))
       {
       
        $con = new Products();
        $post->validate([
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:10000|dimensions:min_width=100,min_height=100,max_width=2000,max_height=5000',
        ]);
        if($post->file('image'))
        {
            $file = time().'.'.$post->image->extension();
            $post->image->storeAs('public/uploads/products',$file);
            $con->image = 'storage/uploads/products/'.$file;
        }

        $con->brand_id = $post->brand_id;
        $con->tehcizat_id = $post->tehcizat_id;
        $con->ad = $post->ad;
        $con->alis = $post->alis;
        $con->satis = $post->satis;
        $con->miqdar = $post->miqdar;
        $con->user_id = $user_id;
        $con->save();

        return redirect()->route('product')->with('mesaj','Məlumatlar uğurla əlavə edildi');
       }
    }




    public function tproduct($id){
        $user_id = Auth::id();

        $bsay = Brend::where('user_id','=',$user_id)->count();
        $csay = Clients::where('user_id','=',$user_id)->count();
        $ssay = Order::where('user_id','=',$user_id)->count();
        $psay = Products::where('user_id','=',$user_id)->count();
        $xsay = Xerc::where('user_id','=',$user_id)->count();
        $tsay = Komendant::where('user_id','=',$user_id)->count();
        $userinfo = User::find('user_id');
        
        $data = Products::join('brends','brends.id','=','products.brand_id')
        ->join('tehcizats','tehcizats.id','=','products.tehcizat_id')
        ->where('tehcizats.id','=',$id)
        ->orderBy('products.id','desc')
        ->select('*','products.image as foto','tehcizats.shirket as sihirket','brends.ad as brend','products.ad as mehsul','products.id as pid')
        ->get();
        
        
        $say = Products::count();
        $brends = Brend::orderBy('ad','asc')->get();
        $tehcizats = Tehcizat::orderBy('ad','asc')->get();
        $userinfo = User::find('user_id');
        return view('product',[
            'data'=>$data,
            'say'=>$say,
            'brends'=>$brends, 
            'tehcizats'=>$tehcizats,
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
