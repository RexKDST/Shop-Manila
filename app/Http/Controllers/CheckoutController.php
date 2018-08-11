<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\address;
use App\orders;

class CheckoutController extends Controller {

    public function index() {
        // check for user login
        if (Auth::check()) {
              $cartItems = Cart::content(); 
            return view('checkout', compact('cartItems'));
        } else {
            return redirect('login');
        }
    }

    public function formvalidate(Request $request) {
        $this->validate($request, [
            'fullname' => 'required|min:5|max:35',
            'pincode' => 'required|numeric',
            'city' => 'required|min:5|max:50',
            'state' => 'required|min:5|max:50',
            'phone' => 'required|min:11|max:11',
            'email' => 'required|min:7|max:40',
            'description' => 'required|min:10|max:60',
            'country' => 'required']);

        $userid = Auth::user()->id;

        $address = new address;
        $address->fullname = $request->fullname;
        $address->state = $request->state;
        $address->city = $request->city;
        $address->country = $request->country;
        $address->user_id = $userid;
        $address->pincode = $request->pincode;
        $address->phone = $request->phone;
        $address->email = $request->email;
        $address->description = $request->description;
        $address->payment_type = $request->pay;
        $address->save();
       
        
        orders::createOrder();
        
        Cart::destroy();
        return redirect('thankyou');
    }

}
