<?php
// most view in
$products1 = DB::table('recommends')
        ->leftJoin('products','recommends.pro_id','products.id')
        ->select('pro_id','pro_name','pro_img','pro_price','spl_price','stock', DB::raw('count(*) as total'))
        ->groupBy('pro_id','pro_name','pro_img','pro_price','spl_price','stock')
        ->orderby('total','DESC') // total nung pumapasok sa database = most viewed
        ->take(6)
        ->get();

        
if(Auth::check()){
 $products2 = DB::table('recommends')
         ->leftJoin('products','recommends.pro_id','products.id')     
         ->where('uid',Auth::user()->id)
         ->inRandomOrder()
        ->take(6)
        ->get();
}else{
 $products2 = DB::table('recommends') // pangalawang ikot 
         ->leftJoin('products','recommends.pro_id','products.id')
         ->inRandomOrder()
        ->take(6)
        ->get();  
}    
?>
                                    
                                      @foreach($products1 as $p)
                                       <div class="col-sm-4">
                                            <div class="product-image-wrapper">
                                                <div class="single-products">
                                                    <div class="productinfo text-center">
                                                       <a href="{{url('/product_details')}}/{{$p->pro_id}}"> 
                                                           <img src="/upload/images/<?php echo $p->pro_img; ?>" alt=""  style="height:248px;width:269px"/></a>

                                                        <h2 id="price">
                                          @if($p->spl_price==0)
                                          ₱{{$p->pro_price}}
                                          @else
                                        <img src="/images/sale.jpg" style="width:60px" />
                                        <span style="text-decoration:line-through; color:#3ad83a">
                                           ₱{{$p->pro_price}} </span>
                                           ₱{{$p->spl_price}}
                                          @endif

                                        </span>
                                                        <h4>  <a href="{{url('/product_details')}}/{{$p->pro_id}}">{{$p->pro_name}}</a></p>
                                                        </h4>
                      
                              <h4>Only <?php echo $p->stock;?> stocks left</h4>
          
                     <a href="{{url('/product_details')}}/<?php echo $p->pro_id;?>" class="btn btn-default"> Quick Look </a>
                     <br/>
                      </span>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                      @endforeach
                                    </div>
                                    
                                      
                                 