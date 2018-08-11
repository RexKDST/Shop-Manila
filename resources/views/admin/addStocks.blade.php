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
                            
                              {!! Form::open(['url' => 'admin/add_stocks',  'method' => 'post', 'enctype' => 'multipart/form-data']) !!}
                        </div>
                        <div class="panel-body">
                            <Select class="form-control" name="cat_id">
                            @foreach($cat_data as $cat)
                            Category:  <option value="{{ $cat->id }}">{{ ucwords($cat->name) }}</option>
                            @endforeach
                            </select>
                            <br>

                           Product Name:    <input type="text" name="stock_name" class="form-control">
                            <br/>
                            Stock Code: <input type="text" name="stock_code" class="form-control">
                            <br/>

                            Supplier: <input type="text" name="suppliers" class="form-control">
                            <br/>

                             Buying Price:  <input type="text" name="buying_price" class="form-control">
                            <br/>

                             Selling Price:  <input type="text" name="selling_price" class="form-control">
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
