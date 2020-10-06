<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cart;
use App\Delivery;
use App\Delivery_rate;
use App\Order_herd;
use App\Order_list;
use App\Pay;
use App\Product;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;



class CartController extends Controller
{
    public function index(){
        $cart = Cart::where('user_id','=',Auth::user()->id)->get();
        $product = Product::all();

        return view('cart.cart_order')->with('product',$product)->with('cart',$cart);
    }

    public function app_cart($id){
        $cart1 = Cart::where('user_id','=',Auth::user()->id)->get();
        $cart2 = Cart::where('user_id','=',Auth::user()->id)->where('product_id','=',$id)->first();

        if($cart1->first() == ''){
            $cart = new Cart;
            $cart->product_id = $id;
            $cart->user_id = Auth::user()->id;
            $cart->number = 1;
            $cart->save();


        }else{

            if($cart2 != null){
                $cart2->increment('number', 1);
                $cart2->save();


            }else{
                $cart = new Cart;
                $cart->product_id = $id;
                $cart->user_id = Auth::user()->id;
                $cart->number = 1;
                $cart->save();
            }
        }


        Session()->flash("add","เพิ่มสินค้าเรียบร้อย");
        return redirect('/cart');
    }

    public function del_cart($id){
        Cart::destroy($id);
        Session()->flash("add","ลบข้อมูลสำเร็จ");
        return back();
    }


    public function increm($id){

        $cart1 = Cart::where('product_id',$id)->where('user_id',Auth::user()->id)->first();
        $cart1->increment('number',1);
        if($cart1->product->number_product < $cart1->number){
            $cart1->decrement('number',1);
        }

        $product = Product::find($id);
        $cartaa = Cart::where('user_id',Auth::user()->id)->get();
        $productaa = Product::all();
        $json['numberAll'] = 0;
        $json['priceAll'] = 0;
        foreach($cartaa as $taa){
            foreach($productaa as $pro){
               if($taa->product_id == $pro->id){

                $json['numberAll'] += $taa->number;


                $json['priceAll'] += $pro->price*$taa->number;
               }

            }

        }


        $json['price'] = $product->price;
        $json['number'] = $cart1->number;
        $json['message'] = '';
        $json['success'] = true;
        return response()->json($json);

    }

    public function decrem($id){



        $cart1 = Cart::where('product_id',$id)->where('user_id',Auth::user()->id)->first();
        if($cart1->number > 1){
            Cart::where('product_id',$id)->where('user_id',Auth::user()->id)->decrement('number',1);
        }
        $cart = Cart::where('product_id',$id)->where('user_id',Auth::user()->id)->first();
        $product = Product::find($id);
        $cartaa = Cart::where('user_id',Auth::user()->id)->get();
        $productaa = Product::all();
        $json['numberAll'] = 0;
        $json['priceAll'] = 0;
        foreach($cartaa as $taa){
            foreach($productaa as $pro){
               if($taa->product_id == $pro->id){

                $json['numberAll'] += $taa->number;


                $json['priceAll'] += $pro->price*$taa->number;
               }

            }

        }
        $json['price'] = $product->price;
        $json['number'] =$cart->number;
        $json['message'] = '';
        $json['success'] = true;
        return response()->json($json);

    }


    public function cart_pay($number_order){


        $hard_order = Order_herd::where('number_order','=',$number_order)->first();


        $cartaa = Cart::where('user_id',Auth::user()->id)->get();
        $productaa = Product::all();
        $json['numberAll'] = 0;
        $json['priceAll'] = 0;
        foreach($cartaa as $taa){
            foreach($productaa as $pro){
               if($taa->product_id == $pro->id){

                $json['numberAll'] += $taa->number;


                $json['priceAll'] += $pro->price*$taa->number;
               }

            }

        }






            return view('cart.cart_pay')->with('price_net',$hard_order->pay->price_net)->with('numberAll', $json['numberAll'])->with('number_order',$number_order)->with('hard_order',$hard_order);


    }

    public function pay(Request $request,$number_order){



        $request->validate([
             'image'=> 'required|file|image|mimes:jpeg,png,jpg|max:5000',
     ]);



     $stringImageReFormat=base64_encode('_'.time());
     $ext=$request->file('image')->getClientOriginalExtension();
     $imageName="imageOrder".$stringImageReFormat.".".$ext;
     $imageEncoded=File::get($request->image);

     Storage::disk('local')->put('public/Order_image/'.$imageName,$imageEncoded);


            $order_herd = Order_herd::where('number_order','=',$number_order)->first();
            $order_herd->status = 2;
            $order_herd->pay->image_pay = $imageName;
            $order_herd->pay->save();
            $order_herd->save();


        return redirect('/order');
    }

    public function editaddress(Request $request){
        $user = User::find(Auth::user()->id);
        $user->address = $request->address;
        $user->save();

        return back();
    }



    public function cart_order(){



        $delivery_rate = Delivery_rate::all();


        if(Auth::check()){
            $cartaa = Cart::where('user_id',Auth::user()->id)->get();
            $productaa = Product::all();
            $json['numberAll'] = 0;
            $json['priceAll'] = 0;
            foreach($cartaa as $taa){
                foreach($productaa as $pro){
                   if($taa->product_id == $pro->id){

                    $json['numberAll'] += $taa->number;


                    $json['priceAll'] += $pro->price*$taa->number;
                   }

                }

            }


            return view('cart.cart_order_1')->with('numberAll',$json['numberAll'])->with('priceAll',$json['priceAll'])->with('address',Auth::user()->address)->with('delivery_rate', $delivery_rate)->with('cart',$cartaa);
        }else{
            return redirect('/');
        }

    }

    public function order_pay(Request $request){

        $deadline_pay=Carbon::now()->addDays(3)->toDateTimeString();



        $request->validate([
            'select'=> 'required',

     ]);

     if($request->select == 0){
        Session()->flash("warning","โปรดเลือกบริษัทการจัดส่ง");
        return back();
     }


        $number_orderencode= Auth::user()->id.''.time() ;
        $number_order =  "22".base_convert($number_orderencode,8, 5);

        $cart = Cart::where('user_id','=',Auth::user()->id)->get();

        $hard = new Order_herd;
        $hard->number_order = $number_order;
        $hard->user_id = Auth::user()->id;
        $hard->status = 1;
        $hard->deadline_pay = $deadline_pay;
        $hard->save();

        foreach($cart as $car){
            $list = new Order_list;
            $list->user_id = $hard->user_id;
            $list->number_order = $hard->number_order;
            $list->product_id = $car->product_id;
            $list->number = $car->number;
            $list->save();

            $product = Product::find($car->product_id);
            $product->number_product =  $product->number_product-$car->number;
            $product->save();
        }

        $cartaa = Cart::where('user_id',Auth::user()->id)->get();
        $productaa = Product::all();
        $json['numberAll'] = 0;
        $json['priceAll'] = 0;
        foreach($cartaa as $taa){
            foreach($productaa as $pro){
               if($taa->product_id == $pro->id){


                $json['priceAll'] += $pro->price*$taa->number;
               }

            }

        }

        $delivery_rate = Delivery_rate::find($request->select);
        $delivery_rate->price_rates;


        $pay = new Pay;
        $pay->number_order = $hard->number_order;
        $pay->user_id =  $hard->user_id;
        $pay->price_net = $json['priceAll']+$delivery_rate->price_rates;
        $pay->image_pay = null;
        $pay->save();

        $delivery = new Delivery;
        $delivery->number_order = $hard->number_order;
        $delivery->firstname = $request->firstname;
        $delivery->lastname = $request->lastname;
        $delivery->phone_number = $request->phone_number;
        $delivery->address = $request->address;
        $delivery->delivery_rate = $request->select;
        $delivery->save();

        Cart::where('user_id','=',Auth::user()->id)->delete();

        return redirect("/cart_pay".'/'.$hard->number_order);

    }


    public function input_number(Request $request){

        $cart1 = Cart::where('product_id',$request->id)->where('user_id',Auth::user()->id)->first();


        if($cart1->product->number_product < $request->number){
            $cart1->number = $cart1->product->number_product;
        }elseif($request->number < 1){
            $cart1->number = 1;
        }else{
            $cart1->number = $request->number;
        }

        $cart1->save();
        $cartaa = Cart::where('user_id',Auth::user()->id)->get();
        $productaa = Product::all();
        $json['numberAll'] = 0;
        $json['priceAll'] = 0;
        foreach($cartaa as $taa){
            foreach($productaa as $pro){
               if($taa->product_id == $pro->id){

                $json['numberAll'] += $taa->number;


                $json['priceAll'] += $pro->price*$taa->number;
               }

            }

        }

        $json['price'] = $cart1->product->price;
        $json['number'] = $cart1->number;
        $json['message'] = '';
        $json['success'] = true;

        return response()->json($json);
    }
}
