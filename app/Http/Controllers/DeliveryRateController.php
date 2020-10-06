<?php

namespace App\Http\Controllers;

use App\Delivery;
use App\Delivery_rate;
use Illuminate\Http\Request;

class DeliveryRateController extends Controller
{
    public function index(){
        $delivery = Delivery_rate::all();
        return view('admin.delivery_rates')->with('delivery',$delivery);
    }

    public function create(Request $request){
        $request->validate([
             'price_rates' => 'required|numeric',
        ]);
        // dd($request);
        $delivery_check = Delivery_rate::all();
        foreach($delivery_check as $del){
            if($request->company == $del->company){
                Session()->flash("delete1","ชื่อนี้ถูกใช้ไปแล้ว");
                return back();
            }
        }


        $delivery = new Delivery_rate();
        $delivery->company = $request->company;
        $delivery->price_rates = $request->price_rates;
        $delivery->save();
        Session()->flash("add","เพิ่มข้อมูลสำเร็จ");
        return back();
    }

    public function delete($id){
        $delivery = Delivery_rate::find($id);
        if($delivery->delivary_d->count() == 0){
            Delivery_rate::destroy($id);
            Session()->flash("add","ลบข้อมูลสำเร็จ");
            return back();
        }else{
            Session()->flash("warning","ไม่สามารถลบได้ เนื่องจากมีการใช้ข้อมูลนี้");
            return back();
        }


    }

    public function edit(Request $request ,$id){
        $request->validate([
            'price_rates' => 'required|numeric',
       ]);
        $delivery = Delivery_rate::find($id);
        $delivery->company = $request->company;
        $delivery->price_rates = $request->price_rates;
        $delivery->save();
        Session()->flash("add","เพิ่มข้อมูลสำเร็จ");
        return back();
    }
}
