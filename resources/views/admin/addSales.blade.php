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
                            <div class="panel-title">Add New Sales Entry
                            </div>
                            
                              {!! Form::open(['url' => 'admin/add_sales',  'method' => 'post', 'enctype' => 'multipart/form-data']) !!}
                        </div>
                        <div class="panel-body">
                            
                            Customer Name: <input type="text" name="customer_name" class="form-control">
                            <br/>

                            Product Name: <input type="text" name="product_name" class="form-control">
                            <br/>

                            Quantity: <input type="text" name="quantity" class="form-control">
                            <br/>

                             Address:  <input type="text" name="address" class="form-control">
                            <br/>

                            Contact Number:  <input type="text" name="contact" class="form-control">
                            <br/>

                             Subtotal:  <input type="text" name="sub_total" class="form-control">
                            <br/>

                            Mode:  <select name="mode" class="form-control" >
                    
                                <option value="COD">Cash on Delivery</option>
                                <option value="Paypal">Paypal</option>
                                <option value="Bank">Bank</option>
                              
                            </select>



                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <br>

                            <input type="submit" value="Submit" class="btn btn-primary pull-right" style="margin-right:10px; " >
                            {!! Form::close() !!}
                        </div>



                    </div>
                </div>
            </div>



      <section>
</section>

@endsection
