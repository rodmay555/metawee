<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use App\Product;
use App\Cart;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $user = User::where('id','=',Auth::user()->id)->first();
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
            return view('home')->with('user',$user)->with('numberAll',$json['numberAll']);
        }else{
            return view('home')->with('user',$user);
        }
    }

    public function welcome(){
        $product = Product::paginate(20);
        $category = Category::all();
        return view('welcome')->with('product',$product)->with('category',$category);
    }

    public function update(Request $request , $id){
        $user = User::find($id);
        $user->name = $request->name;
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->email =  $request->email;
        $user->phone_number = $request->phone_number;
        $user->address = $request->address;
        $user->save();
        return back();
    }

    public function update_password(Request $request ,$id){

        if(Hash::check($request->password_old, Auth::user()->password)){
            if($request->password == $request->password_confirmation){
                Auth::user()->password = Hash::make($request->password);
                Auth::user()->save();
            }
        }
        return back();
    }
}
