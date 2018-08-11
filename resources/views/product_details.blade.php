@extends('master')

@section('content')

<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="left-sidebar">

                    <div class="brands_products"><!--brands_products-->
                        <h2>Brands</h2>
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


                 

                </div>
            </div>
            <h1 style="text-align: center; color: #009900;"> Product Details </h1>
            @foreach($Products as $value)
            <div class="col-sm-9 padding-right">
                <div class="product-details"><!--product-details-->
                    <div class="col-sm-5">
                        <div class="view-product">
                            <img src="/upload/images/<?php echo $value->pro_img; ?>"  alt="" style="height:300px; width:320px"/>
                          
                        </div>

                    </div>
                    <div class="col-sm-7">

                        <div class="product-information"><!--/product-information-->

                            <h2 style="font-weight: bold; font-size: 200%;"><?php echo ucwords($value->pro_name); ?></h2>
                            <p>Web Code: <?php echo $value->pro_code; ?></p>
                              <form action="{{url('/cart/addItem')}}/<?php echo $value->id; ?>">
                              <span>
                                  <span id="price">
                                    @if($value->spl_price ==0)
                                    ₱{{$value->pro_price}}
                                     <input type="hidden" value="{{$value->pro_price}}"
                                      name="newPrice"/>
                                      @else
                                       <img src="/images/sale.jpg" style="width:60px" />
                                    <b style="text-decoration:line-through; color:#3ad83a">
                                      ₱{{$value->pro_price}} </b>
                                       ₱{{$value->spl_price}}
                                       <input type="hidden" value="{{$value->spl_price}}"
                                        name="newPrice"/>
                                      @endif

                                  </span>
                                  <span>
                                   <label> </label>
                                  
                                     <button class="btn btn-fefault cart" id="addToCart_default">
                                         <i class="fa fa-shopping-cart"></i>
                                         Add to cart
                                     </button>
                                  
                                    </span>
                                    <input type="hidden" value="<?php echo $value->id; ?>" id="proDum"/>
                              </span>
                            <p style="font-size: 20px;"><b>Availability:</b> There are <strong> <?php echo $value->stock; ?></strong> available </p> 


                            <?php
                            //wishlist Code start
                            if(Auth::check()){
                            $wishData = DB::table('wishlist')->leftJoin('products', 'wishlist.pro_id', '=', 'products.id')->where('wishlist.pro_id', '=',$value->id)->get();

                            //if($wishData==""){ echo 'empty'; } else { echo 'filled';}
                            $count = App\wishList::where(['pro_id' => $value->id])->count();
                            ?>
                          <?php if($count=="0"){?>
                            <form action="{{url('/addToWishList')}}" method="post">
                                {{ csrf_field() }}
                                <input type="hidden" value="{{$value->id}}" name="pro_id"/>
                                <input type="submit" value="Add to WishList" class="btn btn-success"/>
                               
                            </form>
                         

                          <?php } else {?>
                            <h5 style="color:green"> ADDED TO YOUR <a href="{{url('/WishList')}}">wishList</a></h5>
                          <?php }
                            }?>
                        </div><!--/product-information-->

                       
                             
                  
                    </div>
                </div><!--/product-details-->
    <?php $reviews = DB::table('reviews')->get();
    $count_reviews = count($reviews);?>
           <div class="category-tab shop-details-tab"><!--category-tab-->
            <div class="col-sm-12">
              <ul class="nav nav-tabs">
                <li><a href="#details" data-toggle="tab">Details</a></li>
                <li class="active"><a href="#reviews" data-toggle="tab">Reviews ({{$count_reviews}})</a></li>
              </ul>
            </div>
            <div class="tab-content">
             <div class="tab-pane fade active in" id="details" >
                          <p>{{ $value->pro_info}}</p>
                </div>
                           
              <div class="tab-pane fade active in" id="reviews" >
                 <div class="col-sm-12">

                              @foreach($reviews as $review)
                                <ul>
                                    <li><a href=""><i class="fa fa-user"></i>{{$review->person_name}}</a></li>
                                    <li><a href=""><i class="fa fa-clock-o"></i>
                                      {{date('H: i', strtotime($review->created_at))}}</a></li>
                                    <li><a href=""><i class="fa fa-calendar-o"></i>
                                        {{date('F j, Y', strtotime($review->created_at))}}</a></li>
                                </ul>
                                <p>{{$review->review_content}}</p>
                                @endforeach
                                <p><b>Write Your Review</b></p>

                                <form action="{{url('/addReview')}}" method="post">
                                  {{ csrf_field() }}
                                    <span>
                                        <input type="text" name="person_name" placeholder="Your Name"/>
                                        <input type="email", name="person_email" placeholder="Email Address"/>
                                    </span>
                                    <textarea name="review_content" ></textarea>

                                    <button type="submit" class="btn btn-default pull-right">
                                        Submit
                                    </button>
                                </form>
                            </div>
              </div>
              
            </div>
          </div><!--/category-tab-->

                   

            </div>

            @endforeach
        </div>
    </div>
</section>


@endsection
