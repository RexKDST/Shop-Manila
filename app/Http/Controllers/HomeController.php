<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Mail;
use App\Mail\contacts;
use App\wishList;
use App\recommends;

class HomeController extends Controller {

    public function __construct() {
        return view('home');
        //$this->middleware('auth');
    }

    public function index() {
        return view('home');
    }
 
    public function chatbot() {
        return view('chatbot');
    }


 public function shop(Request $request) {
        if ($request->ajax() && isset($request->start)) {
            $start = $request->start; // min price value
            $end = $request->end; // max price value

            $Products = DB::table('products')
                    ->where('pro_price', '>=', $start)->where('pro_price', '<=', $end)->orderby('pro_price', 'ASC')->paginate(6);

             response()->json($Products); //return to ajax
            return view('products', compact('Products'));
        }
        else if(isset($request->brand)){

           $brand = $request->brand; //brand

            $Products = DB::table('products')->whereIN('cat_id', explode( ',', $brand ))->paginate(6);
            response()->json($Products); //return to ajax
            return view('products', compact('Products'));


        }
        else {

            $Products = DB::table('products')->paginate(6); // now we are fetching all products
            return view('shop', compact('Products'));
        }
    }

    public function proCats(Request $request) {
           if ($request->ajax() && isset($request->start)) {
            $start = $request->start; // min price value
            $end = $request->end; // max price value
            $catName = $request->name;
            $Products = DB::table('pro_cat')->leftJoin('products', 'pro_cat.id', '=', 'products.cat_id')
                     ->where('pro_cat.name', '=', $catName)
                     ->where('pro_price', '>=', $start)
                    ->where('pro_price', '<=', $end)
                    ->orderby('pro_price', 'ASC')
                    ->paginate(6);
             response()->json($Products); //return to ajax
            return view('products', compact('Products'));
        } else if(isset($request->brand)){
            $brand = $request->brand; //brand
            $Products = DB::table('products')->whereIN('cat_id', explode( ',', $brand ))->paginate(6);
             response()->json($Products); //return to ajax
            return view('products', compact('Products'));
        } else{
        $catName = $request->name;
        $Products = DB::table('pro_cat')->leftJoin('products', 'pro_cat.id', '=', 'products.cat_id')->where('pro_cat.name', '=', $catName)->paginate(6);
         return view('shop', compact('Products'));
        }
    }

    Public function product_details($id) {
        //insert command for views
        if(Auth::check()){
        $recommends = new recommends;
        $recommends->uid = Auth::user()->id;
        $recommends->pro_id = $id;
         $recommends->save();
        }


        //view product details
        $Products = DB::table('products')
        ->where('id', $id)->get();
        return view('product_details', compact('Products'));

    }

    public function contact() {
        return view('contact');
    }

    public function search(Request $request) {
        $search = $request->search_data;
        if ($search == '') {
            return view('home');
        } else {
            $Products = DB::table('products')->where('pro_name', 'like', '%' . $search . '%')->paginate(12);
            return view('shop', ['msg' => 'Results: ' . $search], compact('Products'));
        }
    }


    public function wishList(Request $request) {


        $wishList = new wishList;
        $wishList->user_id = Auth::user()->id;
        $wishList->pro_id = $request->pro_id;
        $wishList->save();

        $Products = DB::table('products')->where('id', $request->pro_id)->get();
        //$Products = DB::table('wishlist')->leftJoin('products', 'wishlist.pro_id', '=', 'products.ic')->get();

        return view('product_details', compact('Products'));
    }

    public function View_wishList() {

        $Products = DB::table('wishlist')->leftJoin('products', 'wishlist.pro_id', '=', 'products.id')->get();
        return view('wishList', compact('Products'));
    }

    public function removeWishList($id) {

        DB::table('wishlist')->where('pro_id', '=', $id)->delete();

        return back()->with('msg', 'Item Removed from Wishlist');
    }
   
    public function addReview(Request $request){
      DB::table('reviews')->insert(
    ['person_name' => $request->person_name, 'person_email' => $request->person_email,
  'review_content' => $request->review_content,
  'created_at' => date("Y-m-d H:i:s"),'updated_at' =>date("Y-m-d H:i:s")]
      );
      return back();
    }



}

       
