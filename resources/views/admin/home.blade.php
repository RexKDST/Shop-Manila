@extends('admin.master')

@section('content')


  <section id="container" class="">
       @include('admin.sidebar')
       <section id="main-content">
           <section class="wrapper">

            <div class="row">
                <div class="col-md-6">
                    <div class="content-box-large">
                        <div class="panel-heading">
                            <div class="panel-title">Add New Product
                            </div>
                            
                              {!! Form::open(['url' => 'admin/add_product',  'method' => 'post', 'enctype' => 'multipart/form-data']) !!}
                        </div>
                        <div class="panel-body">
                            <Select class="form-control" name="cat_id">
                            @foreach($cat_data as $cat)
                            Category:  <option value="{{ $cat->id }}">{{ ucwords($cat->name) }}</option>
                            @endforeach
                            </select>
                            <br>

                            Name:    <input type="text" name="pro_name" class="form-control">
                            <br/>
                            Price     <input type="text" name="pro_price" class="form-control">
                            <br/>

                            Code:    <input type="text" name="pro_code" class="form-control">
                            <br/>

                             Stock:    <input type="text" name="stock" class="form-control">
                            <br/>

                            Image:    <input type="file" name="pro_img" class="form-control">
                            <br/>


                            Details:    <textarea name="pro_info" class="form-control" rows="5"></textarea>
                            <br/>
                            Spl  price     <input type="text" name="spl_price" class="form-control">
                            <br/>
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <input type="submit" value="Submit" class="btn btn-primary pull-right" style="margin:-5px">
                            {!! Form::close() !!}
                        </div>

                    </div>

                </div>
                   
            </div>
                


      <section>
</section>

@endsection
