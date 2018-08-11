@extends('admin.master')

@section('content')



    <div class="page-content">
	<div class="row">

		  
		
		  	@include('admin.sidebar')
		 <div class="col-md-10">		
		 	<div class="row">
		 		<h1 style="text-align:center"> Messages </h1>
		  		
		  			<div class="content-box-large">
		  				<table class="table table-striped">
                      <thead> <tr>
                                <th>Date</th>
                                <th>User ID</th>
                                <th> Name </th>
                                <th>Topic</th>
                                <th>Message</th>
                                 <th>Remove</th>
                        </tr>
                        </thead>
                        @foreach($messages as $message)
                        <tbody>
                            <tr>
                            
                                <td>{{date('F j, Y', strtotime($message->updated_at))}}</td>
                                <td>{{$message->user_id}}</td>
                                <td>{{$message->name}}</td>
                                <td>{{$message->topic}}</td>
                                <td>{{$message->message}}</td>
                                
                                
                                 <td><a href="{{url('/admin/deleteMessage')}}/{{$message->id}}" class="btn btn-danger">Remove</a></td>
                                
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