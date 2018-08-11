@extends('admin.master')

@section('content')
<script type="text/javascript">
function handleSelect(elm)
{
window.location ="{{url('/')}}/admin/" +elm.value;
}
</script>

 
    <div class="page-content">
	<div class="row">

		  
		
		  	@include('admin.sidebar')
		 <div class="col-md-10">		
		 	<div class="row">
		 		<h1 style="text-align:center"> Sales Information</h1>
        <select name="form" class="form-control" style="width:350px;" onchange="javascript:handleSelect(this)">
        <option selected="selected">Sort by:</option>
         <option value="ascending">Orders ID (Ascending) </option> 
         <option value="descending">Orders ID (Descending)</option>
       <option value="highest">HIGHEST to LOWEST PRICE (Item Price)</option> 
       <option value="lowest">LOWEST to HIGHEST PRICE (Item Price)</option> 
       <option value="highPrice">HIGHEST to LOWEST TOTAL (Total Price)</option> 
       <option value="lowPrice">LOWEST to HIGHEST TOTAL (Total Price)</option> 
       <option value="sortFive">SORT TO 5 (View by 5)</option>        
        </select>
         <a href="{{url('/')}}/admin/sortFive" class="btn btn-info pull-right" style="margin-right: 30px;">View by 5</a>
        <a href="{{url('/')}}/admin/sortTen" class="btn btn-info pull-right" style="margin-right: 30px;">View by 10</a>
		  		
		  			<div class="content-box-large">
		  				<table class="table table-striped" id="datatable">
                      <thead> <tr>
                      			
                                 <th>Date</th>
                                <th>Shipped To </th>
                                <th> Order ID </th>
                                <th>Product Name</th>
                                <th>Product Price </th>
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
                                <td>₱{{$sale->pro_price}}</td>
                                 <td style="text-align: center">{{$sale->qty}}</td>
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
            		{{$sales->links()}}
		  	</div>
		  </div>
		 
	</div>
  


  @endsection
  