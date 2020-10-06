<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Cart;
use Illuminate\Support\Facades\Auth;


class ProductController extends Controller
{
    public function index(Request $request){
        $product = Product::paginate(10);
        $category = Category::paginate(10);
        $category1 = Category::all();



        if($category->total()==0){
            Session()->flash("warning","โปรดกรอกข้อมูลหมวดสินค้าก่อน");
            return view('admin.category')->with('category',$category);
        }else{
            return view('admin.product')->with('product',$product)->with('category',$category1);
        }


    }

    public function create_product(Request $request){




        $request->validate([
            'name' => 'required|unique:products',
            'description' => 'required',
           'category_id' => 'required',
             'price' => 'required|numeric',
             'number_product' => 'required|numeric',
             'image'=>'required|file|image|mimes:jpeg,png,jpg|max:5000',

     ]);


     $product = new Product();

        $stringImageReFormat=base64_encode('_'.time());
        $ext=$request->file('image')->getClientOriginalExtension();
        $imageName="image".$stringImageReFormat.".".$ext;
        $imageEncoded=File::get($request->image);

        Storage::disk('local')->put('public/product_image/'.$imageName,$imageEncoded);

        if($request->image2){
            $stringImageReFormat2=base64_encode('_'.time());
            $ext2=$request->file('image2')->getClientOriginalExtension();
            $imageName2="image2".$stringImageReFormat2.".".$ext2;
            $imageEncoded2=File::get($request->image2);

            Storage::disk('local')->put('public/product_image/'.$imageName2,$imageEncoded2);
            $product->image2 = $imageName2;
        }


        if($request->image3){
            $stringImageReFormat3=base64_encode('_'.time());
            $ext3=$request->file('image3')->getClientOriginalExtension();
            $imageName3="image3".$stringImageReFormat3.".".$ext3;
            $imageEncoded3=File::get($request->image3);

            Storage::disk('local')->put('public/product_image/'.$imageName3,$imageEncoded3);
            $product->image3 = $imageName3;
        }

        if($request->image4){
            $stringImageReFormat4=base64_encode('_'.time());
            $ext4=$request->file('image4')->getClientOriginalExtension();
            $imageName4="image4".$stringImageReFormat4.".".$ext4;
            $imageEncoded4=File::get($request->image4);

            Storage::disk('local')->put('public/product_image/'.$imageName4,$imageEncoded4);
            $product->image4 = $imageName4;
        }




        $product->image = $imageName;



        $product->name = $request->name;
        $product->description = $request->description;
        $product->number_product = $request->number_product;
        $product->price = $request->price;
        $product->category_id = $request->category_id;
        $product->save();
        Session()->flash("add","เพิ่มข้อมูลสินค้าสำเร็จ");
        return back();

    }

    public function update_product($id,Request $request){
        $product = Product::find($id);
        $request->validate([
            'name' => 'required',
            'description' => 'required',
           'category_id' => 'required',
             'price' => 'required|numeric',
             'number_product' => 'required|numeric',
             'image'=>'file|image|mimes:jpeg,png,jpg|max:5000',
     ]);



            $check = Product::where('name','=',$request->name)->where('id','!=',$id)->first();
            if($check==null){

                    if($request->hasFile("image")){
                        $existe=Storage::disk('local')->exists("public/product_image/".$product->image);

                    if($existe){
                            Storage::delete("public/product_image/".$product->image);
                    }
                    $request->image->storeAs("public/product_image/",$product->image);

                    }

                    if($request->hasFile("image2")){
                        if($product->image2!=null){
                            $existe2=Storage::disk('local')->exists("public/product_image/".$product->image2);
                            if($existe2){
                                    Storage::delete("public/product_image/".$product->image2);
                            }
                                $request->image2->storeAs("public/product_image/",$product->image2);
                        }else{
                            $stringImageReFormat2=base64_encode('_'.time());
                            $ext2=$request->file('image2')->getClientOriginalExtension();
                            $imageName2="image2".$stringImageReFormat2.".".$ext2;
                            $imageEncoded2=File::get($request->image2);

                            Storage::disk('local')->put('public/product_image/'.$imageName2,$imageEncoded2);
                            $product->image2 = $imageName2;
                        }

                    }

                    if($request->hasFile("image3")){
                        if($product->image3!=null){
                            $existe3=Storage::disk('local')->exists("public/product_image/".$product->image3);
                            if($existe3){
                                    Storage::delete("public/product_image/".$product->image3);
                            }
                                $request->image3->storeAs("public/product_image/",$product->image3);
                        }else{
                            $stringImageReFormat3=base64_encode('_'.time());
                            $ext3=$request->file('image3')->getClientOriginalExtension();
                            $imageName3="image3".$stringImageReFormat3.".".$ext3;
                            $imageEncoded3=File::get($request->image3);

                            Storage::disk('local')->put('public/product_image/'.$imageName3,$imageEncoded3);
                            $product->image3 = $imageName3;
                        }


                    }

                    if($request->hasFile("image4")){
                        if($product->image4!=null){
                            $existe4=Storage::disk('local')->exists("public/product_image/".$product->image4);
                            if($existe4){
                                    Storage::delete("public/product_image/".$product->image4);
                            }
                                $request->image4->storeAs("public/product_image/",$product->image4);
                        }else{
                            $stringImageReFormat4=base64_encode('_'.time());
                            $ext4=$request->file('image4')->getClientOriginalExtension();
                            $imageName4="image4".$stringImageReFormat4.".".$ext4;
                            $imageEncoded4=File::get($request->image4);

                            Storage::disk('local')->put('public/product_image/'.$imageName4,$imageEncoded4);
                            $product->image4 = $imageName4;
                        }

                    }


                    $product->name = $request->name;
                    $product->description = $request->description;
                    $product->number_product = $request->number_product;
                    $product->price = $request->price;
                    $product->category_id = $request->category_id;
                    $product->save();
                    Session()->flash("update","อัพเดทข้อมูลสำเร็จ");
                    return back();

            }elseif($request->name == $check->name){
                Session()->flash("delete1","ชื่อนี้ถูกใช้ไปแล้ว");
                return back();
            }



    }

    public function delete($id,$currentPage,$itemPage){
        $pro = Product::paginate(10);
        $product = Product::find($id);
        if($itemPage == 1){

            Product::destroy($id);
            Session()->flash("delete","ลบข้อมูลสำเร็จ");
            return redirect("/admin/product?".$pro->getPageName()."=".($currentPage-1));
        }else{

            Product::destroy($id);
            Session()->flash("delete","ลบข้อมูลสำเร็จ");
            return back();
        }



    }

    public function search(Request $request){


        $product = Product::where('name','LIKE','%'.$request->search.'%')->paginate(20);
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



    public function detail($id){
        $product = Product::find($id);

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


            return view('detail')->with('product',$product)->with('numberAll',$json['numberAll']);
        }else{
            return view('detail')->with('product',$product);
        }



    }

    public function deleteimage($id,$imageName){

        $product = Product::find($id);


                    $existe=Storage::disk('local')->exists("public/product_image/".$product[$imageName]);
                if($existe){
                        Storage::delete("public/product_image/".$product[$imageName]);
                }
                $product[$imageName] = null;
                $product->save();


        $json['id'] = $id;
        $json['imageName'] =$imageName;
        $json['message'] = '';
        $json['success'] = true;
        return response()->json($json);
    }

    public function product_expire(Request $request){
        if($request->number_product){
            $product = Product::where('number_product','<=',$request->number_product)->get();
            $number_product = $request->number_product;
        }else{
            $product = Product::where('number_product','<=',10)->get();
            $number_product = 10;
        }
      return view('admin.product_exprie')->with('product',$product)->with('number_product',$number_product);
    }


    public function add_number_product(Request $request,$id){
        $product = Product::find($id);
        $product->number_product = $request->number_product;
        $product->save();
        return back();
    }



}
