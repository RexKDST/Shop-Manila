@extends('admin.master')

@section('content')



    <div class="page-content">
	   <div class="row">
		  	@include('admin.sidebar')
		 <div class="col-md-10">	

		  		  <div class="row">
		  			
		              <div class="content-box-large"> 	
                       {!! Form::open(['url' => 'admin/editStock',  'method' => 'post']) !!}			 
                        <div class="panel-title"><h1>Update Stock</h1></div>
                          </div>
                        </div>

                     
                     @foreach($Products as $product)
                     <div class="panel-body">
                        
                         <div class="col-md-6">
                          
                           <input type="hidden" name="id" class="form-control" value="{{$product->id}}">
                            <h3>Stock Available: {{($product->stock)}} </h3> 
                           Add Stock: <input type="text" name="stock" class="form-control">
                           <input type="number" name="avail" class="hidden" value={{$product->stock}}>
                            <br/>
                            <input type="submit" class="btn btn-success"
                          value="Update" ></td>
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            @endforeach  
                            {!! Form::close() !!}                     
                        </div>
                        
                        
                        </div>
                         </div>
                        </div>

                        
                      
                    </div> 
		  	   </div>
		  </div>
		</div>
		 
	</div>

   @endsection