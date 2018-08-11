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
                <h1 style="text-align:center"> Products </h1>
                
                  <div class="dropdown">
                    <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">Product Categories
                     <span class="caret"></span></button>
                    <ul class="dropdown-menu">
                     
                                      <?php $cats=DB::table('pro_cat')->get(); ?>
                                @foreach($cats as $cat)
                                    <li><a href="{{url('/')}}/admin/products/{{$cat->name}}">{{ucwords($cat->name)}} </a> </li>
                                @endforeach
                        
                     </ul>
                     <select name="formal" class="btn btn-default dropdown-toggle" onchange="javascript:handleSelect(this)">
                        <option value=" ">Select</option>
                        <option value="ascPro">A-Z Products</option>
                        <option value="descPro">Z-A Products</option>
                        <option value="highPro">Highest Price</option>
                        <option value="lowPro">Lowest Price</option>
                        </select>

                      <div class="search_box pull-right" style="margin-right: 40px;">
                            <form action="{{url('/admin/searchProduct')}}" method="post">

                            <input type="text" placeholder="Search Product"  name="search_data"/>
                            <input type="hidden" name="_token" value= "{{ csrf_token() }}" >
                          
                            </form>
                        </div>
                    </div>    
                     <div class="col-sm-12">
                        
                    </div>
                
                    <div class="content-box-large">
                        <table class="table table-striped" id="myTable">
                      <thead> <tr>
                                <th>Image </th>
                                <th>Product Category</th>
                                <th>Product ID</th>
                                <th>Product Name</th>
                                <th>Product Code</th>
                                <th>Product Price</th>
                                <th>Category ID</th>
                                <th>Update</th>
                                 <th>Remove</th>
                        </tr>
                        </thead>
                        @foreach($Products as $product)
                        <tbody>
                            <tr>
                                <td><img src="/upload/images/<?php echo $product->pro_img; ?>" alt="" width="60px" height="60px"/></td>
                                <td>{{ucwords($product->name)}}</td>
                                <td>{{$product->id}}</td>
                                <td>{{$product->pro_name}}</td>
                                <td>{{$product->pro_code}}</td>
                                <td>${{$product->pro_price}}</td>
                                <td>{{$product->cat_id}}</td>
                                <td><a href="{{url('/')}}/admin/ProductEditForm/{{$product->id}}" class="btn btn-info btn-small">Edit</a></td>
                                 <td><a href="{{url('/admin/deleteProducts')}}/{{$product->id}}" class="btn btn-danger">Remove</a></td>
                                
                            </tr>
                        </tbody>
                        @endforeach
                    </table>
                        <div class="col-md-6 pull-left">
                    <a href="{{url('/')}}/admin/export_products" class="btn btn-lg btn-primary" style="margin-top: 5px;">Export</a>
                </div>

                      
                </div>
            </div>
        
            </div>
          </div>
         
    </div>
      <script type="text/javascript"> $(function() {
        $('#myTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: 
           
        });
    });
  </script>
   @endsection
