<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use App\Product;
use App\Cart;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function index(){
        $category = Category::paginate(10);
        return view('admin.category')->with('category',$category);
    }

    public function create_category(Request $request){
        $check = Category::all();
        foreach($check as $ch){
            if($request->name == $ch->name){
                Session()->flash("delete1","ชื่อนี้ถูกใช้ไปแล้ว");
                return back();
            }
        }


        $category = new Category();
        $category->name = $request->name;
        $category->save();
        Session()->flash("add","เพิ่มข้อมูลสำเร็จ");
        return back();

    }

    public function update_category($id, Request $request){
        $check = Category::find($id);
        if($request->name == $check->name){
            Session()->flash("delete1","ชื่อนี้ถูกใช้ไปแล้ว");
            return back();
        }

        $category = Category::find($id);
        $category->name = $request->name;
        $category->save();
        Session()->flash("update","อัพเดทข้อมูลสำเร็จ");
        return back();
    }

    public function delete($id,$currentPage,$itemPage){
        $category = Category::paginate(10);
        if($itemPage == 1){
            $cat = Category::find($id);
            if($cat->product->count() == 0){
                Category::destroy($id);
            Session()->flash("delete","ลบข้อมูลสำเร็จ");
            }else{
                Session()->flash("warning","ไม่สามารถลบได้ เนื่องจากมีสินค้าอยู่ในหมวดสินค้า");
            }

            return redirect("/admin/category?".$category->getPageName()."=".($currentPage-1));
        }else{
            $cat = Category::find($id);
            if($cat->product->count() == 0){
                Category::destroy($id);
                Session()->flash("delete","ลบข้อมูลสำเร็จ");
            }else{
                Session()->flash("warning","ไม่สามารถลบได้ เนื่องจากมีสินค้าอยู่ในหมวดสินค้า");
            }

            return back();
        }
    }

    public function select_category($id){
        $product = Product::where('category_id', '=', $id)
        ->paginate(20);

        $category = Category::all();

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
        return view('welcome')->with('product',$product)->with('category',$category)->with('numberAll',$json['numberAll']);
        }else{
            return view('welcome')->with('product',$product)->with('category',$category);
        }
    }


}
