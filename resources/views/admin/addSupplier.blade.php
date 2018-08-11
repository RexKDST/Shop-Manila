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
                            <div class="panel-title">Add New Supplier
                            </div>
                            
                              {!! Form::open(['url' => 'admin/add_supplier',  'method' => 'post', 'enctype' => 'multipart/form-data']) !!}
                        </div>
                        <div class="panel-body">
                            
                           Company Name:    <input type="text" name="company_name" class="form-control">
                            <br/>
                            First Name: <input type="text" name="first_name" class="form-control">
                            <br/>

                            Last Name: <input type="text" name="last_name" class="form-control">
                            <br/>

                             Address:  <input type="text" name="address" class="form-control">
                            <br/>

                             Email Address:  <input type="text" name="email_address" class="form-control">
                            <br/>

                            Contact Number:  <input type="text" name="contact_number" class="form-control">
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
