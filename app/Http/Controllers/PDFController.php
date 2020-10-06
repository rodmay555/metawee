<?php

namespace App\Http\Controllers;

use App\Order_herd;
use Illuminate\Http\Request;
use PDF;

class PDFController extends Controller
{
    public function pdf($number_order){
        $order_herd = Order_herd::where('number_order','=',$number_order)->first();

        $pdf = PDF::loadView('report.receiptpdf',compact('order_herd'))->setPaper('a4');
        return @$pdf->stream();
        // return view('report.receiptpdf')->with('order_herd', $order_herd);
    }
}
