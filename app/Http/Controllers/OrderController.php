<?php

namespace App\Http\Controllers;

use App\Order_herd;
use App\Order_list;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Cart;
use App\Delivery;
use App\Pay;
use App\Product;
use App\Status;
use App\User;
use Carbon\Carbon;

class OrderController extends Controller
{
    public function index(Request $request){


        $timeNow = Carbon::now()->toDateTimeString();
        $status = Status::all();
        $date1 = $request->date1;
        $dd1 = substr($date1,0,2);
        $mm1 = substr($date1,3,2);
        $yyyy1 = substr($date1,6,4);
        $time1 = $yyyy1.'-'.$mm1.'-'.$dd1;

        $date2 = $request->date2;
        $dd2 = substr($date2,0,2);
        $mm2 = substr($date2,3,2);
        $yyyy2 = substr($date2,6,4);
        $time2 = $yyyy2.'-'.$mm2.'-'.$dd2;


        $cartaa = Cart::where('user_id',Auth::user()->id)->get();
        $productaa = Product::all();
        $json['numberAll'] = 0;



        foreach($cartaa as $taa){
            foreach($productaa as $pro){
               if($taa->product_id == $pro->id){
                $json['numberAll'] += $taa->number;
               }
            }
        }

        if($request->date1){

            $order_herd_cheke = Order_herd::where('deadline_pay','<=',$timeNow)->where('user_id','=',Auth::user()->id)->where('status','=', 1)->get();

            foreach($order_herd_cheke as $check){
                $check->status = 6 ;
                $check->save();



                foreach($check->order_list as $list){

                    $product = Product::find($list->product_id);
                    $product->number_product = $product->number_product+$list->number ;
                    $product->save();
                }
            }

            $order_herd = Order_herd::whereDate('created_at','>=',$time1)->whereDate('created_at','<=',$time2)->orderBy('id', 'desc')->paginate(5);
            return view('order.order')->with('order_herd',$order_herd)->with('numberAll',$json['numberAll'])->with('status',$status);
        }else{


            $order_herd_cheke = Order_herd::where('deadline_pay','<=',$timeNow)->where('user_id','=',Auth::user()->id)->where('status','=', 1)->get();

            foreach($order_herd_cheke as $check){
                $check->status = 6 ;
                $check->save();



                foreach($check->order_list as $list){

                    $product = Product::find($list->product_id);
                    $product->number_product = $product->number_product+$list->number ;
                    $product->save();
                }
            }

            $order_herd = Order_herd::where('user_id','=',Auth::user()->id)->orderBy('id', 'desc')->paginate(5);

            return view('order.order')->with('order_herd',$order_herd)->with('numberAll',$json['numberAll'])->with('status',$status);
        }

    }

    public function order_admin(){
        $order_herd = Order_herd::orderBy('id', 'desc')->get();
        $pay = Pay::orderBy('id', 'desc')->get();
        return view('order.order_admin')->with('order_herd',$order_herd)->with('pay',$pay);
    }

    public function order_approve($number_order){
        $order_herd = Order_herd::where('number_order','=',$number_order)->first();
        $order_herd->status = 3;
        $order_herd->save();

        return back();
    }


    public function order_tracking(Request $request,$number_order){

        $request->validate([
            'tracking' => 'required',
        ]);
        $order_herd = Order_herd::where('number_order','=',$number_order)->first();
        $order_herd->status = 4;
        $order_herd->save();

        $delivery = Delivery::where('number_order','=',$number_order)->first();
        $delivery->tracking = $request->tracking;
        $delivery->save();

        return back();
    }

    public function order_search(Request $request){

        $status = Status::all();

        $date1 = $request->date1;
        $dd1 = substr($date1,0,2);
        $mm1 = substr($date1,3,2);
        $yyyy1 = substr($date1,6,4);
        $time1 = $yyyy1.'-'.$mm1.'-'.$dd1;

        $date2 = $request->date2;
        $dd2 = substr($date2,0,2);
        $mm2 = substr($date2,3,2);
        $yyyy2 = substr($date2,6,4);
        $time2 = $yyyy2.'-'.$mm2.'-'.$dd2;


        if($request->date1){
            $order_herd = Order_herd::whereDate('created_at','>=',$time1)->whereDate('created_at','<=',$time2)->orderBy('id', 'desc')->paginate(20);
            return view('order.order_admin')->with('order_herd',$order_herd)->with('status',$status);
        }else{
            $order_herd = Order_herd::orderBy('id', 'desc')->paginate(20);
            return view('order.order_admin')->with('order_herd',$order_herd)->with('status',$status);
        }




    }

    public function order_search_status_id(Request $request,$status_id){
        $status = Status::all();

        $date1 = $request->date1;
        $dd1 = substr($date1,0,2);
        $mm1 = substr($date1,3,2);
        $yyyy1 = substr($date1,6,4);
        $time1 = $yyyy1.'-'.$mm1.'-'.$dd1;

        $date2 = $request->date2;
        $dd2 = substr($date2,0,2);
        $mm2 = substr($date2,3,2);
        $yyyy2 = substr($date2,6,4);
        $time2 = $yyyy2.'-'.$mm2.'-'.$dd2;


        if($request->date1){
            $order_herd = Order_herd::whereDate('created_at','>=',$time1)->whereDate('created_at','<=',$time2)->orderBy('id', 'desc')->paginate(20);
            return view('order.order_admin')->with('order_herd',$order_herd)->with('status',$status);
        }else{
            $order_herd = Order_herd::orderBy('id', 'desc')->where('status','=',$status_id)->paginate(20);
            return view('order.order_admin')->with('order_herd',$order_herd)->with('status',$status);
        }
    }



    public function order_status(Request $request,$status_id){
        $status = Status::all();

        $date1 = $request->date1;
        $dd1 = substr($date1,0,2);
        $mm1 = substr($date1,3,2);
        $yyyy1 = substr($date1,6,4);
        $time1 = $yyyy1.'-'.$mm1.'-'.$dd1;

        $date2 = $request->date2;
        $dd2 = substr($date2,0,2);
        $mm2 = substr($date2,3,2);
        $yyyy2 = substr($date2,6,4);
        $time2 = $yyyy2.'-'.$mm2.'-'.$dd2;


        $cartaa = Cart::where('user_id',Auth::user()->id)->get();
        $productaa = Product::all();
        $json['numberAll'] = 0;



        foreach($cartaa as $taa){
            foreach($productaa as $pro){
               if($taa->product_id == $pro->id){

                $json['numberAll'] += $taa->number;



               }

            }

        }

        if($request->date1){
            $order_herd = Order_herd::whereDate('created_at','>=',$time1)->whereDate('created_at','<=',$time2)->orderBy('id', 'desc')->paginate(5);
            return view('order.order')->with('order_herd',$order_herd)->with('numberAll',$json['numberAll'])->with('status',$status);
        }else{
            $order_herd = Order_herd::where('user_id','=',Auth::user()->id)->where('status','=',$status_id)->orderBy('id', 'desc')->paginate(5);
            return view('order.order')->with('order_herd',$order_herd)->with('numberAll',$json['numberAll'])->with('status',$status);
        }
    }


    public function order_received($number_order){
        $order_herd = Order_herd::where('number_order','=',$number_order)->first();
        $order_herd->status = 5 ;
        $order_herd->save();
        return back();
    }


    public function order_delete($number_order){
        $order_herd = Order_herd::where('number_order','=',$number_order)->first();
        $order_herd->status = 6 ;
        $order_herd->save();

        foreach($order_herd->order_list as $list){

            $product = Product::find($list->product_id);
            $product->number_product = $product->number_product+$list->number ;
            $product->save();
        }
        return back();
    }


    public function sales_daily(){
        $timeNow = Carbon::now()->isoFormat('YYYY-MM-D');
        $order_herd = Order_herd::whereDate('created_at','=',$timeNow)->orderBy('id', 'desc')->paginate(5);

        return view("report.sales_daily")->with('order_herd',$order_herd)->with('time',Carbon::now()->isoFormat('DD/MM/YYYY'));
    }

    // public function sales_period(){
    //     $timeNow = Carbon::now()->isoFormat('YYYY-MM');


    //     $order_herd = Order_herd::whereDate('created_at','like', $timeNow.'%')->get();
    //     $product = Product::all();
    //     return view("report.sales_period")->with('product',$product)->with('order_herd',$order_herd)->with('time',$timeNow);
    // }

    // public function sales_annual(){
    //     $timeNow = Carbon::now()->isoFormat('YYYY');


    //     $order_herd = Order_herd::whereDate('created_at','like', $timeNow.'%')->get();
    //     $product = Product::all();
    //     return view("report.sales_annual")->with('product',$product)->with('order_herd',$order_herd)->with('time',$timeNow);
    // }


    public function sales_daily_s(Request $request){
        $date1 = $request->date1;
        $dd1 = substr($date1,0,2);
        $mm1 = substr($date1,3,2);
        $yyyy1 = substr($date1,6,4);
        $time1 = $yyyy1.'-'.$mm1.'-'.$dd1;

        $date2 = $request->date2;
        $dd2 = substr($date2,0,2);
        $mm2 = substr($date2,3,2);
        $yyyy2 = substr($date2,6,4);
        $time2 = $yyyy2.'-'.$mm2.'-'.$dd2;

        $startTime = Carbon::parse($time1)->format('d/m/Y');
        $startTime2 = Carbon::parse($time2)->format('d/m/Y');


        $time_date = $startTime.' ถึง '.$startTime2;
        $order_herd = Order_herd::whereDate('created_at','>=',$time1)->whereDate('created_at','<=',$time2)->orderBy('id', 'desc')->paginate(10);
        return view("report.sales_daily")->with('order_herd',$order_herd)->with('time',$time_date);
    }

    // public function sales_period_s(Request $request){
    //     $date1 = $request->date1;
    //     $mm1 = substr($date1,0,2);
    //     $yyyy1 = substr($date1,3,4);
    //     $time1 = $yyyy1.'-'.$mm1;
    //     $order_herd = Order_herd::whereDate('created_at','like',$time1.'%')->get();
    //     return view("report.sales_period")->with('order_herd',$order_herd)->with('time',$time1);

    // }

    // public function sales_annual_s(Request $request){
    //     $date1 = $request->date1;


    //     $yyyy1 = substr($date1,0,4);
    //     $time1 = $yyyy1;


    //     $order_herd = Order_herd::whereDate('created_at','like',$time1.'%')->get();
    //     $product = Product::all();
    //     return view("report.sales_annual")->with('product',$product)->with('order_herd',$order_herd)->with('time',$time1);
    // }
}
