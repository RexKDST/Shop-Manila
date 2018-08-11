@extends('master')

@section('content')




<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="left-sidebar">
                    <h2>Category</h2>
                    <div class="panel-group category-products" id="accordian"><!--category-productsr-->
                      
                        
                    </div><!--/category-productsr-->

                    <div class="brands_products"><!--brands_products-->
                       
                        <div class="brands-name">
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
                    </div><!--/brands_products-->

                   

                    <div class="shipping text-center"><!--shipping-->
                        <img src="images/home/shipping.jpg" alt="" />
                    </div><!--/shipping-->

                </div>
            </div>

            <div class="col-sm-9 padding-right">
                <div class="features_items"><!--features_items-->
                    <h2 style="text-align: center;color:#009900" ">
                        <?php if (isset($msg)) {
                            echo $msg;
                        } else { ?> Wishlist Items <?php } ?> </h2>

                    <?php if ($Products->isEmpty()) { ?>
                        <h1 style="text-align: center; color:#009900"> Sorry, No Products Found! </h1>
<?php } else { ?>
                        @foreach($Products as $product)
                        <div class="col-sm-4">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center">
                                        <a href="{{url('/product_details')}}">
                                            <img src="/upload/images/<?php echo $product->pro_img; ?>" alt="" style="height:240px;width:260px;" />
                                        </a>
                                        <h2>$<?php echo $product->pro_price; ?></h2>

                                        <p><a href="{{url('/product_details')}}"><?php echo $product->pro_name; ?></a></p>
                                        <a href="{{url('/cart/addItem')}}/<?php echo $product->id; ?>" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Move to cart</a>
                                    </div>
                                    <a href="{{url('/product_details')}}/<?php echo $product->id; ?>">
                                        <div class="product-overlay">
                                            <div class="overlay-content">
                                                <h2>$<?php echo $product->pro_price; ?></h2>
                                                <p><?php echo $product->pro_name; ?></p>
                                                <a href="{{url('/cart/addItem')}}/<?php echo $product->id; ?>" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Move to cart</a>
                                            </div>
                                        </div></a>
                                </div>
                                <div class="choose">
                                    <ul class="nav nav-pills nav-justified">
                                        <li><a href="{{url('/')}}/removeWishList/{{$product->id}}" style="color:red"><i class="fa fa-minus-square"></i>Remove from wishlist</a></li>

                                    </ul>
                                </div>
                            </div>
                        </div>
                        @endforeach
<?php } ?>


                </div>
                <ul class="pagination">
                   
                </ul>
            </div><!--features_items-->
        </div>
    </div>
</div>
</section>



@endsection