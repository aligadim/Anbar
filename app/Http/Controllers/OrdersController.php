<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\OrdersRequest;

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



class OrdersController extends Controller
{   
    public function orders_update(OrdersRequest $post, $id){
        if(!empty($post->miqdar))
        {
           $con = Order::find($id);
           $con->product_id = $post->product_id;
           $con->client_id = $post->client_id;
           $con->miqdar = $post->miqdar;
           $con->save();

           return redirect()->route('orders')->with('mesaj','Sifariş uğurla yeniləndi');

        }
    }




    public function orders_edit($id){
        $user_id = Auth::id();

        $bsay = Brend::where('user_id','=',$user_id)->count();
        $csay = Clients::where('user_id','=',$user_id)->count();
        $ssay = Order::where('user_id','=',$user_id)->count();
        $psay = Products::where('user_id','=',$user_id)->count();
        $xsay = Xerc::where('user_id','=',$user_id)->count();
        $tsay = Komendant::where('user_id','=',$user_id)->count();
        $userinfo = User::find('user_id');
            
       



        $data = Order::join('clients','clients.id','=','orders.client_id')
    ->join('products','products.id','=','orders.product_id')
    ->join('brends','brends.id','=','products.brand_id')
    ->orderBy('orders.id','desc')
    ->select('*','clients.ad as musteri','products.ad as mehsul','products.miqdar as pmiqdar','orders.miqdar as omiqdar','orders.id as oid','brends.ad as brend')
    
    ->get();
    $say = Order::count();
    $clients = Clients::orderBy('ad','asc')->get();
    $products = Products::join('brends','brends.id','=','products.brand_id')
    ->orderBy('products.ad','asc')
    ->select('brends.ad as brend','products.ad as mehsul','products.id as pid','products.miqdar')
    ->get();
    $brends = Brend::orderBy('ad','asc')->get();
    $edit_data = Order::find($id);

    return view('orders',[
        'data'=>$data,
        'say'=>$say,
        'clients'=>$clients,
        'products'=>$products,
        'brends'=>$brends,
        'edit_data'=>$edit_data,
        'brends'=>$brends,
        'bsay' =>$bsay,
        'csay'=>$csay,
        'ssay'=>$ssay,
        'psay'=>$psay,
        'xsay'=>$xsay,
        'tsay'=>$tsay,
        'userinfo'=>$userinfo,
    ]);
    }




   public function orders_sil($id){

    $user_id = Auth::id();

    $bsay = Brend::where('user_id','=',$user_id)->count();
    $csay = Clients::where('user_id','=',$user_id)->count();
    $ssay = Order::where('user_id','=',$user_id)->count();
    $psay = Products::where('user_id','=',$user_id)->count();
    $xsay = Xerc::where('user_id','=',$user_id)->count();
    $tsay = Komendant::where('user_id','=',$user_id)->count();
    $userinfo = User::find('user_id');
        


    $data = Order::join('clients','clients.id','=','orders.client_id')
    ->join('products','products.id','=','orders.product_id')
    ->join('brends','brends.id','=','products.brand_id')
    ->orderBy('orders.id','desc')
    ->select('*','clients.ad as musteri','products.ad as mehsul','products.miqdar as pmiqdar','orders.miqdar as omiqdar','orders.id as oid','brends.ad as brend')
    
    ->get();
    $say = Order::count();
    $clients = Clients::orderBy('ad','asc')->get();
    $products = Products::join('brends','brends.id','=','products.brand_id')
    ->orderBy('products.ad','asc')
    ->select('brends.ad as brend','products.ad as mehsul','products.id as pid','products.miqdar')
    ->get()
    ->where('orders.user_id','=',$user_id);
    $brends = Brend::orderBy('ad','asc')->get();
   
    

    return view('orders',[
        'data'=>$data,
        'say'=>$say,
        'clients'=>$clients,
        'products'=>$products,
        'brends'=>$brends,
        'sil_id'=>$id,
        'brends'=>$brends,
        'bsay' =>$bsay,
        'csay'=>$csay,
        'ssay'=>$ssay,
        'psay'=>$psay,
        'xsay'=>$xsay,
        'tsay'=>$tsay,
        'userinfo'=>$userinfo,
        
        
    ]);
   }

     public function orders_del($id){
     
        $sil_order = Order::find($id)->delete();
        

        return redirect()->route('orders')->with('mesaj','Məlumatlar uğurla silindi');
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
        {$data = Order::join('clients','clients.id','=','orders.client_id')
        ->join('products','products.id','=','orders.product_id')
        ->join('brends','brends.id','=','products.brand_id')
        ->orderBy('clients.ad','asc')
        ->where('orders.user_id','=',$user_id)
        ->select('*','orders.user_id','clients.ad as musteri','orders.tesdiq','products.ad as mehsul','products.miqdar as pmiqdar','orders.miqdar as omiqdar','orders.id as oid','brends.ad as brend')
        
        ->get();}
        elseif($x->f1=='DESC')
        {$data = Order::join('clients','clients.id','=','orders.client_id')
            ->join('products','products.id','=','orders.product_id')
            ->join('brends','brends.id','=','products.brand_id')
            ->orderBy('clients.ad','desc')
            ->where('orders.user_id','=',$user_id)
            ->select('*','orders.user_id','clients.ad as musteri','orders.tesdiq','products.ad as mehsul','products.miqdar as pmiqdar','orders.miqdar as omiqdar','orders.id as oid','brends.ad as brend')
            
            ->get();}

        elseif($x->f2=='ASC')
        {$data = Order::join('clients','clients.id','=','orders.client_id')
         ->join('products','products.id','=','orders.product_id')
         ->join('brends','brends.id','=','products.brand_id')
         ->orderBy('brends.ad','asc')
         ->where('orders.user_id','=',$user_id)
         ->select('*','orders.user_id','clients.ad as musteri','orders.tesdiq','products.ad as mehsul','products.miqdar as pmiqdar','orders.miqdar as omiqdar','orders.id as oid','brends.ad as brend')
         ->get();}

         elseif($x->f2=='DESC')
         {$data = Order::join('clients','clients.id','=','orders.client_id')
          ->join('products','products.id','=','orders.product_id')
          ->join('brends','brends.id','=','products.brand_id')
          ->orderBy('brends.ad','desc')
          ->where('orders.user_id','=',$user_id)
          ->select('*','orders.user_id','clients.ad as musteri','orders.tesdiq','products.ad as mehsul','products.miqdar as pmiqdar','orders.miqdar as omiqdar','orders.id as oid','brends.ad as brend')
          ->get();}

          elseif($x->f3=='ASC')
          {$data = Order::join('clients','clients.id','=','orders.client_id')
           ->join('products','products.id','=','orders.product_id')
           ->join('brends','brends.id','=','products.brand_id')
           ->orderBy('products.ad','asc')
           ->where('orders.user_id','=',$user_id)
           ->select('*','orders.user_id','clients.ad as musteri','orders.tesdiq','products.ad as mehsul','products.miqdar as pmiqdar','orders.miqdar as omiqdar','orders.id as oid','brends.ad as brend')
           ->get();}

           elseif($x->f3=='DESC')
           {$data = Order::join('clients','clients.id','=','orders.client_id')
            ->join('products','products.id','=','orders.product_id')
            ->join('brends','brends.id','=','products.brand_id')
            ->orderBy('products.ad','desc')
            ->where('orders.user_id','=',$user_id)
            ->select('*','orders.user_id','clients.ad as musteri','orders.tesdiq','products.ad as mehsul','products.miqdar as pmiqdar','orders.miqdar as omiqdar','orders.id as oid','brends.ad as brend')
            ->get();}

            elseif($x->f4=='ASC')
           {$data = Order::join('clients','clients.id','=','orders.client_id')
            ->join('products','products.id','=','orders.product_id')
            ->join('brends','brends.id','=','products.brand_id')
            ->orderBy('orders.miqdar','asc')
            ->where('orders.user_id','=',$user_id)
            ->select('*','orders.user_id','clients.ad as musteri','orders.tesdiq','products.ad as mehsul','products.miqdar as pmiqdar','orders.miqdar as omiqdar','orders.id as oid','brends.ad as brend')
            ->get();}

            elseif($x->f4=='DESC')
           {$data = Order::join('clients','clients.id','=','orders.client_id')
            ->join('products','products.id','=','orders.product_id')
            ->join('brends','brends.id','=','products.brand_id')
            ->orderBy('orders.miqdar','desc')
            ->where('orders.user_id','=',$user_id)
            ->select('*','orders.user_id','clients.ad as musteri','orders.tesdiq','products.ad as mehsul','products.miqdar as pmiqdar','orders.miqdar as omiqdar','orders.id as oid','brends.ad as brend')
            ->get();}

            elseif($x->f5=='ASC')
           {$data = Order::join('clients','clients.id','=','orders.client_id')
            ->join('products','products.id','=','orders.product_id')
            ->join('brends','brends.id','=','products.brand_id')
            ->orderBy('products.miqdar','asc')
            ->where('orders.user_id','=',$user_id)
            ->select('*','orders.user_id','clients.ad as musteri','orders.tesdiq','products.ad as mehsul','products.miqdar as pmiqdar','orders.miqdar as omiqdar','orders.id as oid','brends.ad as brend')
            ->get();}

            elseif($x->f5=='DESC')
           {$data = Order::join('clients','clients.id','=','orders.client_id')
            ->join('products','products.id','=','orders.product_id')
            ->join('brends','brends.id','=','products.brand_id')
            ->orderBy('producs.miqdar','desc')
            ->where('orders.user_id','=',$user_id)
            ->select('*','orders.user_id','clients.ad as musteri','orders.tesdiq','products.ad as mehsul','products.miqdar as pmiqdar','orders.miqdar as omiqdar','orders.id as oid','brends.ad as brend')
            ->get();}

            else
            {$data = Order::join('clients','clients.id','=','orders.client_id')
             ->join('products','products.id','=','orders.product_id')
             ->join('brends','brends.id','=','products.brand_id')
             ->orderBy('orders.id','asc')
             ->where('orders.user_id','=',$user_id)
             ->select('*','orders.user_id','clients.ad as musteri','orders.tesdiq','products.ad as mehsul','products.miqdar as pmiqdar','orders.miqdar as omiqdar','orders.id as oid','brends.ad as brend')
             ->get();}
    }
        else
        {$data = Order::where('product_id','LIKE','%'.$x->axtar.'%')->get();}
        $say = Order::count();
        $clients = Clients::orderBy('ad','asc')->get();
        $products = Products::join('brends','brends.id','=','products.brand_id')
        ->orderBy('products.ad','asc')
        ->select('brends.ad as brend','products.ad as mehsul','products.id as pid','products.miqdar')
        ->get();
        $brends = Brend::orderBy('ad','asc')->get();
        $userinfo = User::find('user_id');

        


        return view('orders',[
            'data'=>$data,
            'say'=>$say,
            'clients'=>$clients,
            'products'=>$products,
            'brends'=>$brends,
            'bsay' =>$bsay,
            'csay'=>$csay,
            'ssay'=>$ssay,
            'psay'=>$psay,
            'xsay'=>$xsay,
            'tsay'=>$tsay,
            'userinfo'=>$userinfo,

        ]);
    }


    public function orders(OrdersRequest $post){
        $user_id = Auth::id();
       if( !empty($post->miqdar))
       {
        
        $con = new Order();

        $con->client_id = $post->client_id;
        $con->product_id = $post->product_id;
        $con->miqdar = $post->miqdar;
        $con->user_id = $user_id;

        $con->tesdiq=0;

        $con->save();

        return redirect()->route('orders')->with('mesaj','Məlumatlar uğurla əlavə edildi');

       }
    }

    public function tesdiq($id){
        $order = Order::find($id);
        $product = Products::find($order->product_id);
        
        if($order->miqdar <= $product->miqdar )
        {
            $netice = $product->miqdar - $order->miqdar;
            $order->tesdiq=1;
            $order->save();

            $product->miqdar = $netice;
            $product->save();

            return redirect()->route('orders')->with('mesaj','Sifariş uğurla təsdiq edildi');
        }
        return redirect()->route('orders')->with('mesaj','Sifarişi təsdiq etmək mümkün olmadı');
    }

    public function legv($id){
        $order = Order::find($id);
        $product = Products::find($order->product_id);
        
        $netice = $order->miqdar + $product->miqdar;
            $order->tesdiq=0;
            $order->save();

            $product->miqdar = $netice;
            $product->save();

            return redirect()->route('orders')->with('mesaj','Sifariş uğurla ləğv edildi');
    }

    

}
