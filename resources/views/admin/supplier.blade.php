@extends('admin.master')

@section('content')



    <div class="page-content">
	<div class="row">

		  
		
		  	@include('admin.sidebar')
		 <div class="col-md-10">		
		 	<div class="row">
		 		<h1 style="text-align:center"> Supplier Informations </h1>
		  		
		  			<div class="content-box-large">
		  				<table class="table table-striped">
                      <thead> <tr>
                      			
                                <th>Company</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Address</th>
                                <th>Email</th>
                                <th>Contact</th>
                                <th>Update</th>
                                 <th>Remove</th>
                        </tr>
                        </thead>
                        @foreach($suppliers as $supplier)
                        <tbody>
                            <tr>
                                <td>{{$supplier->company_name}}</td>
                                <td>{{$supplier->first_name}}</td>
                                <td>{{$supplier->last_name}}</td>
                                <td>{{$supplier->address}}</td>
                                <td>{{$supplier->email_address}}</td>
                                <td>{{$supplier->contact_number}}</td>
                                <td><a href="" class="btn btn-info btn-small">Edit</a></td>
                                 <td><a href="{{url('/admin/deleteSuppliers')}}/{{$supplier->id}}" class="btn btn-danger">Remove</a></td>
                                
                            </tr>
                        </tbody>
                        @endforeach
                    </table>
		  			
		  		
		  		
		  		</div>
		  	</div>
		
		  	</div>
		  </div>
		 
	</div>

   @endsection