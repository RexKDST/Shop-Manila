@extends('admin.master')

@section('content')


 
    <div class="page-content">
	<div class="row">

		  
		
		  	@include('admin.sidebar')
		 <div class="col-md-10">		
		 	<div class="row">
		 		<h1 style="text-align:center"> Sales Information </h1>
              <div class="search_box pull-right" style="margin-right: 40px;">
                            <form action="{{url('/admin/searchSales')}}" method="post">

                            <input type="text" placeholder="Search Sales"  name="search_data"/>
                            <input type="hidden" name="_token" value= "{{ csrf_token() }}" >
                          
                            </form>
                        </div>
		  		
		  			<div class="content-box-large">
		  				<table class="table table-striped" id="datatable">
                      <thead> <tr>
                      			
                                 <th>Date</th>
                                <th>Shipped To </th>
                                <th> Order ID </th>
                                <th>Product Name</th>
                                <th>Product Quantity</th>
                                <th>Address</th>
                                <th>Payment Type</th>
                                <th>Subtotal</th>
                               
                                <th>Print</th>
                               
                        </tr>
                        </thead>
                        @foreach($sales as $sale)
                     

                          <tbody> 
                           @if ($sale->status=='Delivered')
                                <td>{{date('F j, Y', strtotime($sale->created_at))}}</td>
                                <td>{{$sale->fullname}}</td>
                                <td>{{$sale->id}}</td>
                                <td>{{$sale->pro_name}}</td>
                                 <td>{{$sale->qty}}</td>
                                <td>{{$sale->state}}</td>
                                <td>{{$sale->payment_type}}</td>
                                <td>₱{{($sale->subtotal)}}</td>
                                <td><a href="{{url('/')}}/admin/PrintForm/{{$sale->id}}" class="btn btn-info btn-small">Print</a></td>
                            </tbody>
                         @else 
                            


                      
                        @endif
                        @endforeach
                    
                    </table>
		  			   <div class="col-md-6 pull-left">
                    <a href="{{url('/')}}/admin/export_sales" class="btn btn-lg btn-primary" style="margin-top: 5px;">Export</a>
                </div>

		  		
		  		
		  		</div>
		  	</div>
            		
		  	</div>
		  </div>
		 
	</div>
  

   <script type="text/javascript"> $(function() {
        $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: 'https://datatables.yajrabox.com/eloquent/basic-data'
        });
    });
  </script>
  @endsection
  