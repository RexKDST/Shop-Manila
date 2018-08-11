
<input type="hidden" name="cmd" value="_cart">
<input type="hidden" name="upload" value="1">
<input type="hidden" name="business" value="rexsznndnvg16@yahoo.com">
<?php $count =0;?>
   @foreach($cartItems as $cartItem)
   <?php $count++; ?>
   <input type="hidden" name="item_name_{{$count}}" value="{{$cartItem->name}}">
<input type="hidden" name="item_number_{{$count}}" value="{{$cartItem->id}}">
<input type="hidden" name="quantity_{{$count}}" value="{{$cartItem->qty}}">
<input type="hidden" name="amount_{{$count}}" value="{{$cartItem->price}}">
<input type="hidden" name="shipping_{{$count}}" value="0.00">

<input type="hidden" name="tax_{{$count}}" value="0.6">

<!-- after payment -->
 <input type="hidden" name="return" id="return" value="http://127.0.0.1:8000/easyshop/index.php/thankyou" />
<!-- Cancel payment -->
  <input type="hidden" name="cancel_return" id="cancel_return" value="http://127.0.0.1:8000/easyshop/index.php/checkout" />

@endforeach

<br>
<input name="submit" id="paypalbtn" type="image" src="{{url('../')}}/images/paypal.png" style="height:100px; border: 3px solid #999999;" value="PayPal" formaction="https://www.paypal.com/cgi-bin/webscr" title="Paypal Payments">


<!--Paypal Developer Checkout Form -->