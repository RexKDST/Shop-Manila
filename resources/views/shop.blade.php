@extends('master')

@section('content')
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
$(document).ready(function(){
<?php $maxP = count($Products);
  for($i=0;$i<$maxP; $i++) {?>
    $('#successMsg<?php echo $i;?>').hide();
    $('#cartBtn<?php echo $i;?>').click(function(){
      var pro_id<?php echo $i;?> = $('#pro_id<?php echo $i;?>').val();

      $.ajax({
        type: 'get',
        url: '<?php echo url('/cart/addItem');?>/'+ pro_id<?php echo $i;?>,
        success:function(){
        $('#cartBtn<?php echo $i;?>').hide();
        $('#successMsg<?php echo $i;?>').show();
        $('#successMsg<?php echo $i;?>').append('Product has been added to cart');
        }
      });

    });
    <?php }?>
});

</script>
<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="left-sidebar">
                   <div class="price-range"><!--price-range-->

                                <div class="well">
                                   <h2>Price Range</h2>
                                    <div id="slider-range"></div>
                                    <br>
                                    <b class="pull-left">₱
                                        <input size="2" type="text" id="amount_start" name="start_price"
                                               value="15" style="border:0px; font-weight: bold; " readonly="readonly" /></b>

                                    <b class="pull-right">₱
                                        <input size="2" type="text" id="amount_end" name="end_price" value="4000"
                                               style="border:0px; font-weight: bold; " readonly="readonly"/></b>
                                   </div>

                            </div>

                <div class="brands_products"><!--brands_products-->
                        <div class="brands-name">
                              <h2>Brands</h2>
                                <ul class="nav nav-pills nav-stacked">

                                    <?php $cats = DB::table('pro_cat')->orderby('name', 'ASC')->get();?>

                                    @foreach($cats as $cat)
                                    <li class="brandLi"><input type="checkbox" id="brandId" value="{{$cat->id}}" class="try"/>
                                 <span class="pull-right">({{App\products::where('cat_id',$cat->id)->count()}})</span>
                                  <b>  {{ucwords($cat->name)}}</b></li>
                                   @endforeach
                                 <?php /*   <li><a href=""> <span class="pull-right">(56)</span>Grüne Erde</a></li>
                                    <li><a href=""> <span class="pull-right">(27)</span>Albiro</a></li>
                                    <li><a href=""> <span class="pull-right">(32)</span>Ronhill</a></li>
                                    <li><a href=""> <span class="pull-right">(5)</span>Oddmolly</a></li>
                                    <li><a href=""> <span class="pull-right">(9)</span>Boudestijn</a></li>
                                    <li><a href=""> <span class="pull-right">(4)</span>Rösch creative culture</a></li>
                                  * */?>

                               </ul>
                        </div>
                    </div>

                    <div class="shipping text-center"><!--shipping-->
                        <img src="{{url('../')}}/images/home/shipping.jpg" alt="" />
                    </div><!--/shipping-->

                </div>
            </div>

            <div class="col-sm-9 padding-right"   >

                 <div class="features_items"  id="updateDiv" > <!--features_items-->
                      <b> Total Products</b>:  {{$Products->total()}}
                    <h2 class="title text-center">
                       <?php
                        if (isset($msg)) {
                            echo $msg;
                        } else {
                            ?> Featured Item <?php } ?> </h2>

                    <?php if ($Products->isEmpty()) { ?>
                         <h2 style="text-align: center;"> Sorry, No Products found! </h2>
                    <?php } else {
                      $countP=0;?>
                        @foreach($Products as $product)
                        <input type="hidden" id="pro_id<?php echo $countP;?>" value="{{$product->id}}"/>
                        <div class="col-sm-4" >
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                   <div class="productinfo text-center">
                    <img src="/upload/images/<?php echo $product->pro_img; ?>" alt="" style="height: 220px; width:260px" />
                     <span id="price">
                      <h2>
                                          @if($product->spl_price==0)
                                          ₱{{$product->pro_price}}
                                          @else
                                        <img src="/images/sale.jpg" style="width:60px" />
                                        <span style="text-decoration:line-through; color:#3ad83a">
                                           ₱{{$product->pro_price}} </span>
                                           ₱{{$product->spl_price}}
                                          @endif

                                        </h2>

                      </span>
              
                  
<!-- if <=0 stocks ang ilalabas is No dstocks left else  echo $product->stock-->
                    <span>
                       <h4> <strong> <?php echo $product->pro_name;?> </strong></h4>
                    <h4>Only <strong> <?php echo $product->stock;?></strong> stocks left</h4>
          
                     <a href="{{url('/product_details')}}/<?php echo $product->id;?>" class="btn btn-default"> Quick Look </a>
                     <br/>
                      </span>
                      <br>
                                           <div id="successMsg<?php echo $countP;?>" class="alert alert-success"></div>
                                    </div>

                                </div>
                                <div class="choose">
                                    <?php
                                    $wishData = DB::table('wishlist')->leftJoin('products', 'wishlist.pro_id', '=', 'products.id')->where('wishlist.pro_id', '=', $product->id)->get();
                                    $count = App\wishList::where(['pro_id' => $product->id])->count();
                                    ?>

                                    <?php if ($count == "0") { ?>
                                        <form action="{{url('/addToWishList')}}" method="post">
                                            {{ csrf_field() }}
                                            <input type="hidden" value="{{$product->id}}" name="pro_id"/>
                                            <p align="center">
                                                <input type="submit" value="Add to WishList" class="btn btn-primary"/>
                                            </p>
                                        </form>
                                    <?php } else { ?>
                                        <h5 style="color:green"> Added to <a href="{{url('/WishList')}}">wishList</a></h5>
                                    <?php } ?>

                                </div>
                            </div>
                        </div>
                        <?php $countP++?>
                        @endforeach
                    <?php } ?>


                </div>
                <ul class="pagination">
                    {{ $Products->links()}}
                </ul>
            </div><!--features_items-->
              
        </div>
    </div>
</div>
</section>
@endsection
