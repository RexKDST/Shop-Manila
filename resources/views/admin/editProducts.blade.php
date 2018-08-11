@extends('admin.master')

@section('content')



    <div class="page-content">
	   <div class="row">
		  	@include('admin.sidebar')
		 <div class="col-md-10">	

		  		  <div class="row">
		  			
		              <div class="content-box-large"> 	
                       {!! Form::open(['url' => 'admin/editProduct',  'method' => 'post']) !!}			 
                        <div class="panel-title"><h1>Edit Products</h1></div>

                          </div>

                 

                     <?php $cats = DB::table('pro_cat')->get(); ?>
                    @foreach($Products as $product)

                     <div class="panel-body">
                             
                         <div class="col-md-6">
                         Product Categories:
                        <select name="cat_id" class="form-control">
                                @foreach($cats as $cat)
                                <option value="{{$cat->id}}" <?php if ($product->cat_id == $cat->id) { ?> selected="selected"<?php } ?>>{{ucwords($cat->name)}}</option>
                                @endforeach
                            </select>
                            <br>
                           <input type="hidden" name="id" class="form-control" value="{{$product->id}}">
                            Product Name:    <input type="text" name="pro_name" class="form-control" value="{{$product->pro_name}}">
                            <br/>
                           Product Price     <input type="text" name="pro_price" class="form-control" value="{{$product->pro_price}}">
                            <br/>
                            Product Code:    <input type="text" name="pro_code" class="form-control" value="{{$product->pro_code}}">
                            <br/>
                            Sale Price: <input type="text" name="spl_price" class="form-control"
                             value="{{$product->spl_price}}">
                            <br/>
                            Details:  <textarea name="pro_info" class="form-control" rows="2">{{$product->pro_info}}</textarea>
                            <br/>
                            <input type="submit" class="btn btn-lg btn-success"
                          value="Update" ></td>

                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            @endforeach  
                            {!! Form::close() !!}                     
                        </div>
                        
                        <div class="content-box-large " align="center">
                         <div class="panel-heading">
                             <div class="panel-title">
                             <h2 style="text-align: center"> Update Product Image </h2> <br>
                             <img src="/upload/images/<?php echo $product->pro_img; ?>" alt="" width="250px" height="220px" class="img-rounded"/> 
                                   <br> <br>
                                <p><a href="{{url('/admin/EditImage')}}/{{$product->id}}"
                                   class="btn btn-lg btn-info">Change Image</a>
                                </p> <br>
                    
                
                        </div>
            
                         </div>

                        </div>
                      
                    </div> 
                    
		  	   </div>

		  </div>
		</div>

	</div>

   @endsection