@extends('master')

@section('content')
<style>
    table td { padding:10px
    }</style>



<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="{{url('/profile')}}">Profile</a></li>
                <li class="active">My Address</li>
            </ol>
        </div><!--/breadcrums-->




        <div class="row">

            @include('profile.menu')
            <div class="col-md-8">
               @if(session('msg'))
                <div class="alert alert-success">  
                    <a href='#' class="close" data-dismiss="alert" aria-label="close">x</a>
                  
                    {{session('msg')}}
                
                </div>
                @endif
          
                <h3><span style='color:green'>{{ucwords(Auth::user()->name)}}</span>, You can message us about your concerns.</h3>

                {!! Form::open(['url' => 'message',  'method' => 'post']) !!}

    
                     <select name="topic" class="form-control" style="width: 300px;" >
                                <option value="Cancel Order" selected="selected">Cancel Order</option>
                                <option value="Refund">Refund</option>
                                <option value="Feedbacks">Feedbacks</option>
                                <option value="Questions">Questions</option>
                                
                    </select>
                    <h3> Message: </h3>
                      <textarea name="message" class="form-control" placeholder="Enter your message.." style="width:500px; height: 250px"></textarea>
                       <br/>
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">

                      <input type="submit" value="Send" class="btn btn-primary pull-right"  style="height: 40px; width: 100px">
                  
               
                
                {!! Form::close() !!}
            </div>
        </div>


    </div>
</section>
@endsection
