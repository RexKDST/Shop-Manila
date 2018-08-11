@extends('admin.master')

@section('content')



    <div class="page-content">
	<div class="row">

		  
		
		  	@include('admin.sidebar')
		 <div class="col-md-10">		
		 	<div class="row">
		 		<h1 style="text-align:center"> Stock Available </h1>
		  		
		  			<div class="content-box-large">
		  			<div class="col-xs-12">
        <button class="btn btn-primary btn-sm" data-target="#loginModal" data-toggle="modal">Login</button> 
        <div class="modal" id="loginModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="model-content">
                    <button class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"> Login </h4>
                </div>
                <div class="model-body">
                    <form>
                    <div class="form-group">
                        <label for="inputUserName">Username</label>
                        <input class="form-control" placeholder="Login Username"
                                type="text" id="inputUserName" />
                    </div>
                    <div class="form-group">
                        <label for="inputPassword">Password</label>
                        <input class="form-control" placeholder="Login Password"
                                type="password" id="inputPassword" />
                    </div>
                </form>
                </div>
                <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Login</button>
                <button type="button" class="btn btn-primary"
                        data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
		  			
		  		      
		  		
		  		</div>
		  	</div>
        <div  style="text-align: center;">
		        {{$Products->links()}}
          </div>
		  	</div>
		  </div>
		 
	</div>

   @endsection