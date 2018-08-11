<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\address;
use App\message; 

class ProfileController extends Controller {

    public function index() {
        return view('profile.index');
    }

   public function orders() {
      $user_id = Auth::user()->id;
        $orders = DB::table('orders_products')->leftJoin('products', 'products.id', '=', 'orders_products.products_id')->leftJoin('orders', 'orders.id', '=', 'orders_products.orders_id')->where('orders.user_id', '=', $user_id)
        ->orderBy('orders_id','ASC')
        ->get();
        return view('profile.orders', compact('orders'));
   }



    public function Address() {
        $user_id = Auth::user()->id;
        $address_data = DB::table('address')->where('user_id', '=', $user_id)->orderby('id', 'DESC')->get();
        return view('profile.address', compact('address_data'));
    }

    public function updateAddress(Request $request) {
        $this->validate($request, [
            'fullname' => 'required|min:5|max:35',
            'pincode' => 'required|numeric',
            'city' => 'required|min:5|max:25',
            'state' => 'required|min:5|max:25',
            'country' => 'required']);

        $userid = Auth::user()->id;
        DB::table('address')->where('user_id', $userid)->update($request->except('_token'));

        return back()->with('msg','Your address has been updated');
    }

    public function Password() {
        return view('profile.updatePassword');
    }

      public function message(Request $request) {
       
        if(Auth::check()){
        $message = new message;
        $message->user_id= Auth::user()->id;
        $message->topic = $request->topic;
        $message->message = $request->message;
        $message->save();
        }     
         $user_id = Auth::user()->id;
        

        $message = DB::table('message')->where('id', $user_id)->get();

        return back()->with('msg','Your Message has been sent to the Admin. Thank you for letting us know.');
 
        //  return redirect()->action('AdminController@index')->with('status', 'Product Uploaded!');
    }
    public function messageform(){
      $message = DB::table('message')->get();

      return view('profile.message', compact('message'));
    } 

    public function updatePassword(Request $request) {
        $oldPassword = $request->oldPassword;
        $newPassword = $request->newPassword;


        if(!Hash::check($oldPassword, Auth::user()->password)){
          return back()->with('msg','The specified password does not match the database password'); //when user enter wrong password as current password

        }else{
            $request->user()->fill(['password' => Hash::make($newPassword)])->save(); //updating password into user table
           return back()->with('msg','Password has been updated');
        }
       // echo 'here update query for password';
    }

}
