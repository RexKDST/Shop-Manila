@extends('admin.master')

@section('content')
  
    <div class="page-content">
	<div class="row">

		  
		
		  	@include('admin.sidebar')
		 <div class="col-md-10">		
		 	<div class="row">
		 		<h1 style="text-align:center"> Refunded Orders </h1>
                   

		  		
		  			<div class="content-box-large">
		  				<table class="table table-striped" id="datatable">
                      <thead> <tr>
                      			
                                 <th>Date</th>
                                 <th>Orders ID </th>
                                <th>Shipped To </th>
                                <th>Product Name</th>
                                <th>Product Quantity</th>
                                <th>Address</th>
                                <th>Payment Type</th>
                                <th>Subtotal</th>
                               
                                
                               
                        </tr>
                        </thead>
                        @foreach($refunds as $refund)
                     

                          <tbody> 
                           @if ($refund->status=='Refund')
                                <td>{{date('F j, Y', strtotime($refund->updated_at))}}</td>
                                <td>{{$refund->id}}</td>
                                <td>{{$refund->fullname}}</td>
                                <td>{{$refund->pro_name}}</td>
                                 <td>{{$refund->qty}}</td>
                                <td>{{$refund->state}}</td>
                                <td>{{$refund->payment_type}}</td>
                                <td>₱{{$refund->total}}</td>
                                
                            </tbody>
                         @else 
                            


                      
                        @endif
                        @endforeach
                    
                    </table>
		  			  

		  		
		  		
		  		</div>
		  	</div>
            		{{$refunds->links()}}
		  	</div>
		  </div>
		 
	</div>
    <script type="text/javascript">    
        $(document).ready(function() {
          $('#datatable').Datatable();
        });
   </script> 
  @endsection
  