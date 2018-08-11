<?php

namespace App;

use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\products;

use Illuminate\Database\Eloquent\Model;

class orders extends Model {

    protected $fillable = ['subtotal', 'status'];

    public function orderFields() {
        return $this->belongsToMany(products::class)->withPivot('qty', 'subtotal');
    }

    public static function createOrder() {

        // for order inserting to database

        $user = Auth::user();
        $order = $user->orders()->create(['subtotal' => Cart::total(), 'status' => 'Pending']);


        $cartItems = Cart::content();
        foreach ($cartItems as $cartItem) {
            $order->orderFields()->attach($cartItem->id, ['qty' => $cartItem->qty, 'tax' => Cart::tax(), 'total' => $cartItem->qty * $cartItem->price]);
        }
    }

}
