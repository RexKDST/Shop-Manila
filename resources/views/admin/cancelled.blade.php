@extends('admin.master')

@section('content')
  
    <div class="page-content">
	<div class="row">

		  
		
		  	@include('admin.sidebar')
		 <div class="col-md-10">		
		 	<div class="row">
		 		<h1 style="text-align:center"> Cancelled Orders </h1>
                   

		  		
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
                        @foreach($cancels as $cancel)
                     

                          <tbody> 
                           @if ($cancel->status=='Cancelled')
                                <td>{{date('F j, Y', strtotime($cancel->updated_at))}}</td>
                                <td>{{$cancel->id}}</td>
                                <td>{{$cancel->fullname}}</td>
                                <td>{{$cancel->pro_name}}</td>
                                 <td>{{$cancel->qty}}</td>
                                <td>{{$cancel->state}}</td>
                                <td>{{$cancel->payment_type}}</td>
                                <td>₱{{$cancel->total}}</td>
                                
                            </tbody>
                         @else 
                            


                      
                        @endif
                        @endforeach
                    
                    </table>
		  			  

		  		
		  		
		  		</div>
		  	</div>
            		{{$cancels->links()}}
		  	</div>
		  </div>
		 
	</div>
    <script type="text/javascript">    
        $(document).ready(function() {
          $('#datatable').Datatable();
        });
   </script> 
  @endsection
  