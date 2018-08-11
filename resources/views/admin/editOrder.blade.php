@extends('admin.master')

@section('content')



    <div class="page-content">
     <div class="row">
        @include('admin.sidebar')
     <div class="col-md-10">  

            <div class="row">
            
                  <div class="content-box-large">   
                       {!! Form::open(['url' => 'admin/editOrder',  'method' => 'post']) !!}       
                        <div class="panel-title"><h1>Update Order</h1></div>
                          </div>
                        </div>

                     
                     @foreach($orders as $order)
                     <div class="panel-body">
                        
                         <div class="col-md-6">
                          
                           <input type="hidden" name="id" class="form-control" value="{{$order->id}}">
                            <h3>Status: <h3> <input type="text" name="status" class="form-control" value="{{$order->status}}">
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