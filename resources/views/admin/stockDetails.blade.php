@extends('admin.master')

@section('content')



    <div class="page-content">
	<div class="row">

		  
		
		  	@include('admin.sidebar')
		 <div class="col-md-10">		
		 	<div class="row">
		 		<h1 style="text-align:center"> Stock Purchases </h1>
		  		
		  			<div class="content-box-large">
		  				<table class="table table-striped">
                      <thead> <tr>
                      			
                                
                                <th>Date Purchased</th>
                                <th>Product Name</th>
                                <th>Product Code</th>
                                <th>Buying Price</th>
                                <th>Selling Price</th>
                                <th>Supplier</th>
                        
                                 <th>Remove</th>
                        </tr>
                        </thead>
                        @foreach($stocks as $stock)
                        <tbody>
                            <tr>
                            	
                                
                                <td> {{date('F j, Y', strtotime($stock->updated_at))}} </td>
                                <td style="text-align: center">{{$stock->stock_name}}</td>
                                <td>{{$stock->stock_code}}</td>
                                <td>${{$stock->buying_price}}</td>
                                <td>${{$stock->selling_price}}</td>
                                <td>{{$stock->suppliers}}</td>
                            
                                <td><a href="{{url('/admin/deleteStockDetails')}}/{{$stock->id}}" class="btn btn-danger">Remove</a></td>
                                
                            </tr>
                        </tbody>
                        @endforeach
                    </table>
		  			
		  		
		  		
		  		</div>
		  	</div>
		
		  	</div>
		  </div>
		 
	</div>

   @endsection