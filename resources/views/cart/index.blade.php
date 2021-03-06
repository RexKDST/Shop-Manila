@extends('master')

@section('content')

<script>
$(document).ready(function(){
<?php for($i=1;$i<20;$i++){?>
  $('#upCart<?php echo $i;?>').on('change keyup', function(){

  var newqty = $('#upCart<?php echo $i;?>').val();
   var newstock = $('#upStock<?php echo $i;?>').val();
  var rowId = $('#rowId<?php echo $i;?>').val();
  var proId = $('#proId<?php echo $i;?>').val();

   if(newqty <=0){ alert('Enter valid Quantity!') }
  else {

    $.ajax({
        type: 'get',
        dataType: 'html',
        url: '<?php echo url('/cart/update');?>/'+proId,
        data: "qty=" + newqty + "newstock=" + newstock + "& rowId=" + rowId + "& proId=" + proId,
        success: function (response) {
            console.log(response);
            $('#updateDiv').html(response);
        }
    });
  }

  });
  <?php } ?>


});



</script>
<?php if ($cartItems->isEmpty()) { ?>
    <section id="cart_items">
        <div class="container">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="{{url('/')}}">Home</a></li>
                    <li class="active">Shopping Cart</li>
                </ol>
            </div>
            <div align="center"> 
               <h1><span style="text-align: center; color: #009900"> You have no item in your Cart!</span> </h1>
             <img src="{{asset('images/Cart1.png')}}"/></div>

        </div>
    </section> <!--/#cart_items-->
<?php } else { ?>

    <section id="cart_items">
        <div class="container">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="{{url('/')}}">Home</a></li>
                    <li class="active">Shopping Cart</li>
                </ol>
            </div>

<div id="updateDiv">
                            @if(session('status'))
                                    <div class="alert alert-success">

                                        {{session('status')}}
                                    </div>
                                    @endif

                                      @if(session('error'))
                                    <div class="alert alert-danger">

                                        {{session('error')}}
                                    </div>
                                    @endif


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
                    <?php $count =1;?>
                    @foreach($cartItems as $cartItem)


                    <tbody>

                        <tr>
                            <td class="cart_product">
                                <a href="{{url('/product_details')}}/{{$cartItem->id}}"><img src="{{url('/')}}/upload/images/{{$cartItem->options->img}}" alt="" width="200px"></a>
                            </td>
                            <td class="cart_description">
                                <h4><a href="{{url('/product_details')}}/{{$cartItem->id}}" style="color:blue">{{$cartItem->name}}</a></h4>
                                <p>Product ID: {{$cartItem->id}}</p>
                                 <h4>Only <strong>{{($cartItem->options->stock)-($cartItem->qty)}} </strong> left</h4>
                            </td>
                            <td class="cart_price">
                                <p>₱{{$cartItem->options->spl_price}}</p>
                                
                            </td>
                            <td class="cart_quantity">
                                <div class="cart_quantity_button">
                    
                                  <input type="hidden" id="rowId<?php echo $count;?>" value="{{$cartItem->rowId}}"/>
                                    <input type="hidden" id="proId<?php echo $count;?>" value="{{$cartItem->id}}"/>

                                    <input type="number" size="2" value="{{$cartItem->qty}}" name="qty" id="upCart<?php echo $count;?>"
                                           autocomplete="off" style="text-align:center; max-width:50px; "  MIN="1" MAX="{{$cartItem->options->stock}}">

                                
                                </div>
                            </td>
                            <td class="cart_total">
                                <p class="cart_total_price">₱{{$cartItem->subtotal}}</p>
                            </td>
                            <td class="cart_delete">
                                <a class="cart_quantity_delete" style="background-color:red"
                                   href="{{url('/cart/remove')}}/{{$cartItem->rowId}}"><i class="fa fa-times"></i></a>
                            </td>
                        </tr>

<?php $count++;?>
                    </tbody>  @endforeach
                </table>
            </div>

</div>


        </div>
    </section> <!--/#cart_items-->

    
     <section id="do_action">
        <div class="container">
            <div class="heading">
                <h3>What would you like to do next?</h3>
                <p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    
                  <?php /*      <ul class="user_option">
                            <li>
                                <label>Use Coupon Code</label>
                            </li>
                            <li>
                                <input type="text" id="couponCode">
                            </li>
                            <li>
                                <button id="couponBtn">Apply</button>
                            </li>
                        </ul>
                        */?>
                

            
                </div>
                <div class="col-sm-6">
                    <div class="total_area">
                        <ul>
                            <li>Cart Sub Total <span>₱{{Cart::subtotal()}}</span></li>
                            <li>Eco Tax <span>₱{{Cart::tax()}}</span></li>
                            <li>Shipping Cost <span>Free</span></li>
                            <li>Total <span style="font-weight: bold; font-size:120%; color:#009900">₱{{Cart::total()}}</span></li>
                        </ul>
                        <a class="btn btn-default update" href="">Update</a>
                        <a class="btn btn-default check_out" href="{{url('/')}}/checkout">Check Out</a>
                    </div>
                </div>
            </div>
        </div>
    </section>



<?php } ?>
@endsection
