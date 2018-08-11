@extends('admin.master')

@section('content')


  <section id="container" class="">
        @include('admin.sidebar')
        <section id="main-content">
            <section class="wrapper">

                <div class="content-box-large">
                    <h1>Update Image</h1>
                </div>
                    <div class="col-md-5">
                        {!! Form::open(['url' => 'admin/editProImage',  'method' => 'post', 'enctype' => 'multipart/form-data']) !!}

                    @foreach($Products as $product)
                    <input type="hidden" name="id" class="form-control" value="{{$product->id}}">

                    Item Name: <input type="text" class="form-control" value="{{$product->pro_name}}" readonly="readonly" style="background: white; color:black; font-size: 20px;">
                    <br/>
                    <img src="{{url('/')}}/upload/images/<?php echo $product->pro_img; ?>" alt="" width="450px" height="350px"/>

                    <br/>
                    Select Image:
                    <input type="file" name="new_image" class="form-control" >

                    @endforeach
                    <br/>
                    <input type="submit" value="Upload Image" class="btn btn-success pull-right">

                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    {!! Form::close() !!}
                  </div>
                </div>


        </section>
</section>

@endsection
