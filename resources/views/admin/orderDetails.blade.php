@extends('admin.master')

@section('content')
<script>
$(document).ready(function(){
  <?php for($i=1;$i<15;$i++){?>
      $('#successMsg<?php echo $i;?>').hide();
  $('#sale<?php echo $i;?>').change(function(){
    var sale_val<?php echo $i;?> = $('#sale<?php echo $i;?>').val();
      var userId<?php echo $i;?> = $('#saleId<?php echo $i;?>').val();
    $.ajax({
      type: 'get',
      data: 'saleID='+userId<?php echo $i;?> + '&sale_val=' + sale_val<?php echo $i;?>,
      url: '<?php echo url('/admin/updateSale');?>',
      success: function(response){
        console.log(response);
        $('#successMsg<?php echo $i;?>').show();
        $('#successMsg<?php echo $i;?>').html(response);
        // window.location.reload();
      }
    });
  });
    $('#banUser<?php echo $i;?>').click(function(){
        //alert('yes');
        if(document.getElementById('banUser<?php echo $i;?>').checked){
            alert('Checked');
        }else{
            alert('Unchecked');
        }
    });
<?php }?>
});
</script>

    <div class="page-content">
	<div class="row">

		  
		
		  	@include('admin.sidebar')
		 <div class="col-md-10">		
		 	<div class="row">
		 		<h1 style="text-align:center"> Order Details </h1>
                  
        <div class="search_box pull-right" style="margin-right: 40px;">
                            <form action="{{url('/admin/searchOrder')}}" method="post">

                            <input type="text" placeholder="Search"  name="search_data"/>
                            <input type="hidden" name="_token" value= "{{ csrf_token() }}" >
                          
                            </form>
                        </div>
                    </div>    
                    
                
		  		
		  			<div class="content-box-large">
		  				<table class="table table-striped">
                      <thead> <tr>
                                
                                
                                <th>Date</th>
                                <th>Order ID </th>
                                <th>Customer's Address</th>
                                <th>Product Name </th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th>Mode</th>
                                <th>Delivery Status</th>
                                <th>Update</th>
                                                  

                                 
                               
                        </tr>
                        </thead>
                   
          
                        <tbody>
                          <?php $countSale =1;?>
                        @foreach($orders as $order)
                         <input type="hidden" value="{{$order->id}}" id="saleId<?php echo $countSale;?>">
                            <tr>
                        
                                <td> {{date('F j, Y', strtotime($order->updated_at))}}</td>
                                <th style="text-align:center">{{$order->id}}</th>
                                <td>{{$order->fullname}}</td>
                                <td>{{$order->pro_name}}</td>
                                <td><strong>{{$order->qty}}</strong></td>
                                <td>₱{{$order->total}}</td>
                                <td>{{$order->payment_type}}</td>
                                <td>{{$order->status}}</td>

                         <td><select name="role" class="form-control" id="sale<?php echo $countSale;?>">
                           <option value="Pending" @if($order->status=='Pending')
                             selected="selected" @endif>Pending</option>
                           <option value="Delivered"  @if($order->status=='Delivered')
                             selected="selected" @endif>Delivered</<option>
                              <option value="Cancelled"  @if($order->status=='Cancelled')
                             selected="selected" @endif>Cancelled</<option>
                               <option value="Refund"  @if($order->status=='Refund')
                             selected="selected" @endif>Refund</<option>
                           </select>
                           <p id="successMsg<?php echo $countSale;?>"
                                                          class="alert alert-success"></p>
                          </td>                        
                      
                             
                            </tr>
                        </tbody>
                        <?php $countSale++;?>
                        @endforeach
                    </table>
                       
		  		</div>
		  	</div>
		        <p style="text-align: center;">  {{$orders->links()}} </p>
		  	</div>
		  </div>
		 
	</div>

   @endsection