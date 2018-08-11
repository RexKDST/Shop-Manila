@extends('admin.master')

@section('content')

  <section id="container" class="">

        @include('admin.sidebar')
          <div class="container" style="height: 700px; " >
            <div class="row" style=" width: 100%; height: 100%; padding: 20px; margin-top: 20px; margin-left: 100px;">
               <h1 style="text-align:center; font-family:'Anonymous Pro'; font-size: 60px;"> Shop Manila Admin Page </h1>
              <div class="col-md-4" style="border: 1px  black; height: 100px; background: #ffae19; margin-right: 5px;">
                 <?php $users = DB::table('users')->count('id');
                                        $admins = DB::table('users')->where('admin','=','1')->count('id');
                                         $total = $users - $admins; 

                                 echo "<h1 style='font-weight:bold; font-size:40px; font-family:Anonymous Pro; color:white;text-align: center; margin-right: 20px;'>".'<i class="fa fa-user"></i>'."&nbspCustomers:".$total."</h1>";
                  ?>
              </div>
               <div class="col-md-4" style="border: 1px  black; height: 100px; background: #329932; margin-right: 5px;">
                 <?php $users = DB::table('users')->count('id');
                                       $products = DB::table('products')->count('id');

                                 echo "<h1 style='font-weight:bold; font-size:40px; font-family:Anonymous Pro; color:white;text-align: center; margin-right: 20px;'>".'<i class="fa fa-shopping-cart"></i>'."&nbspProducts:".$products."</h1>";
                  ?>
              </div>
                <div class="col-md-4" style="border: 1px  black; height: 100px; background: #ff3232; margin-right: -10px;">
                 <?php $users = DB::table('users')->count('id');
                                       $stocks = DB::table('products')->sum('stock');

                                 echo "<h1 style='font-weight:bold; font-size:40px; font-family:Anonymous Pro; color:white;text-align: center; margin-right: 20px;'>".'<i class="fa fa-bars"></i>'."&nbspStock:".$stocks."</h1>";
                  ?>
              </div>
              <br>
               <div class="col-md-10" style="border: 1px  black; height: 300px; background: #337ab7; margin-top: 10px; margin-left:90px;">
                 <?php $sold = DB::table('orders_products')->count('id');
                                       $sold = DB::table('orders_products')
                                              ->leftJoin('orders','orders.id','=','orders_products.orders_id')
                                              ->where('status','=','Delivered')
                                              ->sum('qty');

                                      $sales = DB::table('orders')
                                              ->where('status', '=','Delivered')
                                              ->sum('subtotal');    

                                      $expenses = DB::table('stock_info')->sum('buying_price');    

                                      $overall = $sales - $expenses;

                                 echo "<h1 style='font-weight:bold; font-size:40px; font-family:Anonymous Pro; color:white;text-align: center; margin-right: 20px;'>".'<i class="fa fa-tags"></i>'."&nbspTotal Products Sold:".$sold."</h1>";

                                   echo "<h1 style='font-weight:bold; font-size:40px; font-family:Anonymous Pro; color:white;text-align: center; margin-right: 20px;'>".'<i class="fa fa-money"></i>'."&nbspTotal Sales: ₱".$sales."</h1>";

                                    echo "<h1 style='font-weight:bold; font-size:40px; font-family:Anonymous Pro; color:white;text-align: center; margin-right: 20px;'>".'<i class="fa fa-suitcase"></i>'."&nbspTotal Expenses: ₱".$expenses."</h1>";

                                    echo "<h1 style='font-weight:bold; font-size:40px; font-family:Anonymous Pro; color:white;text-align: center; margin-right: 20px;'>".'<i class="fa fa-money"></i>'."&nbspOverall Income: ₱".$overall."</h1>";
                  ?>
                  <?php
                  $best = DB::table('orders_products')
                  ->leftJoin('products','orders_products.products_id','products.id')
                   ->leftJoin('orders','orders.id','=','orders_products.orders_id')
                   ->where('status','=','Delivered')  
                    ->select('products_id','pro_name','qty','status', DB::raw('count(*) as total'))
                    ->groupBy('products_id','pro_name','qty','status')
                    ->orderby('total','DESC') 
                    ->take(3)
                    ->get();
             
                   ?>
                     <?php
                  $less = DB::table('orders_products')
                  ->leftJoin('products','orders_products.products_id','products.id')
                   ->leftJoin('orders','orders.id','=','orders_products.orders_id')
                     ->where('status','=','Delivered')   
                    ->select('products_id','pro_name','qty','status', DB::raw('count(*) as total'))
                    ->groupBy('products_id','pro_name','qty','status')
                    ->orderby('total','ASC') 
                    ->take(3) 
                    ->get();
             
                   ?>
                  
                 </br>
              </div>
              <div class="col-md-6" style="border: 1px solid black; margin-top: 10px; ">
                <div class="row">
                  <div class="content-box-large">
                      <h3 style="text-align: center"> Most Ordered Items </h3>
                    <table class="table table-striped" id="datatable">
                      <thead> <tr>
                            
                                 <th style="text-align:center" >Products ID</th>
                                <th>Products Name</th>
                              
                           
                               
                        </tr>
                        </thead>
                        @foreach($best as $be)
                     

                          <tbody> 
                           
                                <td style="text-align:center">{{$be->products_id}}</td>
                                <td>{{$be->pro_name}}</td>
                               
                             
                               
                            </tbody>
                        @endforeach
                    
                    </table>
                  </div>
                </div>
              </div>

                 <div class="col-md-6" style="border: 1px solid black; margin-top: 10px;">
                <div class="row">
                  <div class="content-box-large">
                      <h3 style="text-align: center"> Least Ordered Items </h3>
                    <table class="table table-striped" id="datatable">
                      <thead> <tr>
                            
                                 <th style="text-align:center">Products ID</th>
                                <th>Products Name</th>
                               
                              
                               
                        </tr>
                        </thead>
                        @foreach($less as $le)
                     

                          <tbody> 
                           
                                <td style="text-align: center">{{$le->products_id}}</td>
                                <td>{{$le->pro_name}}</td>
                                
                             
                               
                            </tbody>
                        @endforeach
                    
                    </table>
                  </div>
                </div>
              </div>

















            </div>
          </div>

  </section>

@endsection
