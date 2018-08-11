@extends('master')
   
@section('content')


   
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-sm-3">
                        <div class="left-sidebar">
                            <h2>Category</h2>
                                
                                 <div class="brands_products"><!--brands_products-->
                        <div class="brands-name">
                     
                                <ul class="nav nav-pills nav-stacked">

                                    <?php $cats = DB::table('pro_cat')->orderby('name', 'ASC')->get();?>

                                    @foreach($cats as $cat)
                                    <li class="brandLi"> 
                                 <span class="pull-right">({{App\products::where('cat_id',$cat->id)->count()}})</span>
                                  <b> {{ucwords($cat->name)}}</b></li>
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
                  
                             <div class="shipping text-center"><!--shipping-->
                                <img src="images/ADS.png" alt="" style="width: 270px; height: 350px;" />
                            </div>

                        </div>
                    </div>

                    <div class="col-sm-9 padding-right">
                        <div class="features_items"><!--features_items-->
                            <h2 class="title text-center">Most Viewed Products</h2>
                           
                            <div class="recommended_items"><!--
                              recommended_items-->

<div class="col-md-12" style="margin-top: 35px;">
  <h2 style="text-align:center; color:#009900;"> Most Viewed Products </h2>
@include('recommends')
</div>
                        </div><!--/recommended_items-->
                        </div><!--features_items-->
                      
                    </div>
                </div>
            </div>
        </section>


   
      @endsection