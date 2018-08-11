 @extends('master')

@section('content')

<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li class="active">Check out</li>
            </ol>
        </div><!--/breadcrums-->

        <div class="step-one">
            <h3 >Step 1: Shopper Informations</h3>
            <br>
        </div>




        <?php // form start here?>
        <form action="{{url('/')}}/formvalidate" method="post">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="shopper-informations">
                <div class="row">
                    <div class="col-sm-8">
                        <div class="shopper-info">

                            <input type="text" name="fullname"  placeholder="Display Name" class="form-control"  value="{{ old('fullname') }}">

                            <span style="color:red">{{ $errors->first('fullname') }}</span>
                            <br>

                            <input type="text" placeholder="Address" name="state" class="form-control" value="{{ old('state') }}">

                            <span style="color:red">{{ $errors->first('state') }}</span>

                            <br>
                            <input type="text" placeholder="Pincode" name="pincode" class="form-control" value="{{ old('pincode') }}">

                            <span style="color:red">{{ $errors->first('pincode') }}</span>

                            <br>
                            <input type="text" placeholder="City Name" name="city" class="form-control" value="{{ old('city') }}">

                            <span style="color:red">{{ $errors->first('city') }}</span>
                            <br>
                            <input type="text" placeholder="Phone Number" name="phone" class="form-control" value="{{ old('phone') }}">

                            <span style="color:red">{{ $errors->first('phone') }}</span>
                            <br>
                            <input type="text" placeholder="Email Address" name="email" class="form-control" value="{{ old('email') }}">

                            <span style="color:red">{{ $errors->first('email') }}</span>



                            <br>
                             <input type="textarea" style="height:150px;" placeholder="Description Box of Order" name="description" class="form-control" value="{{ old('description') }}">

                            <span style="color:red">{{ $errors->first('description') }}</span>



                            <br>

                            <select name="country" class="form-control" >
                                <option value="{{ old('country') }}" selected="selected">Select country</option>
                                <option value="Philippines">Philippines</option>
                                <option value="United States">United States</option>
                                <option value="Singapore">Singapore</option>
                                <option value="Malaysia">Malaysia</option>
                                <option value="Taiwan">Taiwan</option>
                                <option value="Indonesia">Indonesia</option>
                            </select>
                            <span style="color:red">{{ $errors->first('country') }}</span>
                            <br>




                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="order-message">
                           
                        </div>
                    </div>
                </div>
            </div>


        <div class="review-payment">
            <h3>Step 2: Review & Payment</h3>
        </div>

        <div class="table-responsive cart_info">
            <table class="table table-condensed">
                <thead>
                    <tr class="cart_menu">
                        <td class="image">Item</td>
                        <td class="description"></td>
                        <td class="price">Price</td>
                        <td class="quantity">Quantity</td>
                        <td class="total">Total</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cartItems as $cartItem)
                    <tr>
                        <td class="cart_product">
                            <a href=""><img src="/upload/images/{{$cartItem->options->img}}" alt="" style="height:220px; width:250px"></a>
                        </td>
                        <td class="cart_description">
                            <h4><a href="">{{$cartItem->name}}</a></h4>
                            <p>Web ID: {{$cartItem->id}}</p>
                        </td>
                        <td class="cart_price">
                            <p>₱{{$cartItem->price}}</p>
                        </td>
                        <td class="cart_quantity">
                            <div class="cart_quantity_button">

                                <input class="cart_quantity_input" type="text"  value="{{$cartItem->qty}}" readonly="readonly" size="2">

                            </div>
                        </td>
                        <td class="cart_total">
                            <p class="cart_total_price">₱{{$cartItem->subtotal}}</p>
                        </td>
                        <td class="cart_delete">
                            <a class="cart_quantity_delete" href="{{url('/cart/remove')}}/{{$cartItem->rowId}}"><i class="fa fa-times"></i></a>

                        </td>
                    </tr>
                    @endforeach
                    <tr>
                        <td colspan="4">&nbsp;</td>
                        <td colspan="4">
                            <table class="table table-condensed total-result">
                                <tr>
                                    <td>Cart Sub Total</td>
                                    <td>₱{{Cart::subtotal()}}</td>
                                </tr>
                                <tr>
                                    <td> Tax</td>
                                    <td>₱{{Cart::tax()}}</td>
                                </tr>
                                <tr class="shipping-cost">
                                    <td>Shipping Cost</td>
                                    <td>Free</td>
                                </tr>
                                <tr>
                                    <td>Total</td>
                                    <td><span style="font-size: 150%; font-weight:bold">₱{{Cart::total()}}</span></td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
      <div class="payment-options">
        <h3> Select Mode of Payment </h3>
            
             <span style="font-size: 130%">
                <input type="radio" name="pay" value="COD" checked="checked" id="cash"> Cash on Delivery
                &nbsp;&nbsp;&nbsp;
            </span>
            <br>
            <span style="font-size: 130%">
                <input type="radio" name="pay" value="Bank"  id="bank"> Bank <br>
               
            </span>
            <span style="font-size: 130%">
                <input type="radio" name="pay" value="Remittance"  id="remit"> Money Remittance <br>
               
            </span>
            <span style="font-size: 130%">
                <input type="radio" name="pay" value="paypal" id="paypal" "> PayPal
                <br>
                 &nbsp;&nbsp;&nbsp;
                @include('paypal')
          </span>

            <span>
            <input type="image" value="Cash on Delivery" src="{{url('../')}}/images/cod.png" id="cashbtn" name="submit">
            </span>
            <span>
             <input name="submit" id="bankbtn" type="image" src="{{url('../')}}/images/bpi.jpg"" value="Bank" style="height:80px; width:220px;">
             <input name="submit" id="remitbtn" type="image" src="{{url('../')}}/images/palawan.jpg"" value="Remittance" style="height:80px; width:220px;">
         </span>

        </div>
    </div>
 <script>

            $('#paypalbtn').hide();
            $('#bankbtn').hide();
            $('#remitbtn').hide();
          //  $('#cashbtn').hide();

            $(':radio[id=paypal]').change(function(){
                $('#paypalbtn').show();
                $('#cashbtn').hide();
                $('#bankbtn').hide();
                $('#remitbtn').hide();

            });

            $(':radio[id=remit]').change(function(){
                $('#remitbtn').show();
                $('#cashbtn').hide();
                $('#bankbtn').hide();
                $('#paypalbtn').hide();

            });


              $(':radio[id=cash]').change(function(){
                $('#paypalbtn').hide();
                $('#cashbtn').show();
                $('#bankbtn').hide();
                $('#remitbtn').hide();

            });
               $(':radio[id=bank]').change(function(){
                $('#paypalbtn').hide();
                $('#bankbtn').show();
                $('#cashbtn').hide();
                $('#remitbtn').hide();

            });
            </script>
      </form>

@endsection
