@extends('admin.master')

@section('content')

<script type="text/javascript">
function handleSelect(elm)
{
window.location = "{{url('')}}/admin/"+elm.value;
}
</script>

    <div class="page-content">
	<div class="row">

		  
		
		  	@include('admin.sidebar')
		 <div class="col-md-10">		
		 	<div class="row">
		 		<h1 style="text-align:center"> Stock Available </h1>
           
                      <div class="search_box pull-right" style="margin-right: 40px;">
                            <form action="{{url('/admin/searchStock')}}" method="post">

                            <input type="text" placeholder="Search Product"  name="search_data"/>
                            <input type="hidden" name="_token" value= "{{ csrf_token() }}" >
                          
                            </form>
                        </div>
                        <select name="formal" class="btn btn-default dropdown-toggle" onchange="javascript:handleSelect(this)">
                        <option value=" ">Select</option>
                        <option value="ascStock">Many to Least</option>
                        <option value="descStock">Least to Many</option>
                        </select>

                    </div>    
                     <div class="col-sm-12">
                        
                    </div>
                
		  			<div class="content-box-large">
		  				<table class="table table-striped">
                      <thead> <tr>
                      			<th>Image </th>
                              
                                <th>Product Name</th>
                                <th>Category </th>
                                <th>Stock Available</th>
                                <th>Update</th>
                                 <th>Remove</th>
                        </tr>
                        </thead>
                        @foreach($Products as $product)
                        <tbody>
                            <tr>
                            	<td><img src="/upload/images/<?php echo $product->pro_img; ?>" alt="" width="60px" height="60px"/></td>
                                
                                <td>{{ucwords($product->pro_name)}}</td>
                                <td>{{ucwords($product->name)}}
                              @if($product->stock <= 5)         
                                <td style="background:#ff9999;">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<span style="font-weight:bold; font-size: 16px;">{{($product->stock)}}</span></td>
                              
                                @elseif($product->stock >= 5 AND $product->stock <= 10)
                                 <td style="background:#FFC966" >&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<span style="font-weight:bold; font-size: 16px;">{{($product->stock)}}</span></td>

                                @else 
                                  <td >&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<span style="font-weight:bold; font-size: 16px;">{{($product->stock)}}</span></td>
                              
                                @endif
                                
                                <td><a href="{{url('/')}}/admin/StockEditForm/{{$product->id}}" class="btn btn-info btn-small">Edit</a></td>
                                 <td><a href="{{url('/admin/deleteCategory')}}/{{$product->id}}" class="btn btn-danger">Remove</a></td>
                                
                            </tr>
                        </tbody>
                        @endforeach
                    </table>
		  			
		  		      
		  		
		  		</div>
		  	</div>
        <div class="col-md-6 pull-left">
                    <a href="{{url('/')}}/admin/export_stocks" class="btn btn-lg btn-primary" style="margin-top: 5px;">Export</a>
                </div>
        <div  style="text-align: center;">
		        {{$Products->links()}}
          </div>
		  	</div>
		  </div>
		 
	</div>

   @endsection