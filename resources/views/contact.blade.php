@extends('master')

@section('content')
<div id="contact-page" class="container">
    	<div class="bg">
	    	<div class="row">    		
	    		<div class="col-sm-12">    			   			
					<h2 class="title text-center" style="font-size: 150%;">Contact<strong>Us</strong></h2>    			    				    				
					<div id="gmap" class="contact-map">
						<div class= "col-sm-4"> 
							<h2 style="color: #009900;"> How long does it take to receive an item? </h2>
							<br>
							<p style="font-size: 18px;"> The delivery of an item depends on customer's location. You can check it in Profile -> My Orders -> Status 
						</div>
						<div class= "col-sm-4"> 
							<h2 style="color: #009900;">I want to return or cancel my order? </h2> 
							<br>
							<p style="font-size: 18px;">  If a customer want to return or cancel an order. He or she is free to contact us via call, text or email. 
						</div>
						<div class= "col-sm-4"> 
							<h2 style="color: #009900;"> What are the Payment Methods? </h2>
							<br>
							<p style="font-size: 18px;">  Shop Manila accepts payments via Cash on Delivery, Paypal, Bank or Remittances.
						</div>
					</div>
				</div>			 		
			</div>    	
    		<div class="row">  	
	    		<div class="col-sm-8">
	    			<div class="contact-form">
	    				<h2 class="title text-center">Get In Touch</h2>
	    				<div class="status alert alert-success" style="display: none"></div>
				    	<form id="main-contact-form" class="contact-form row" name="contact-form" method="post">
				            <div class="form-group col-md-6">
				                <input type="text" name="name" class="form-control" required="required" placeholder="Name">
				            </div>
				            <div class="form-group col-md-6">
				                <input type="email" name="email" class="form-control" required="required" placeholder="Email">
				            </div>
				            <div class="form-group col-md-12">
				                <input type="text" name="subject" class="form-control" required="required" placeholder="Subject">
				            </div>
				            <div class="form-group col-md-12">
				                <textarea name="message" id="message" required="required" class="form-control" rows="8" placeholder="Your Message Here"></textarea>
				            </div>                        
				            <div class="form-group col-md-12">
				                <input type="submit" name="submit" class="btn btn-primary pull-right" value="Submit">
				            </div>
				        </form>
	    			</div>
	    		</div>
	    		<div class="col-sm-4">
	    			<div class="contact-info">
	    				<h2 class="title text-center">Contact Info</h2>
	    				<address>
	    					<p>Shop Manila Inc.</p>
							<p>San Marcelino Street Ermita Manila City</p>
							<p>Manila PHI</p>
							<p>Mobile: +63 947 8748 884</p>
							<p>Email: shopmanila@yahoo.com</p>
	    				</address>
	    				<div class="social-networks">
	    					<h2 class="title text-center">Social Networking</h2>
							<ul>
								<li>
									<a href="#"><i class="fa fa-facebook"></i></a>
								</li>
								<li>
									<a href="#"><i class="fa fa-twitter"></i></a>
								</li>
								<li>
									<a href="#"><i class="fa fa-google-plus"></i></a>
								</li>
								<li>
									<a href="#"><i class="fa fa-youtube"></i></a>
								</li>
							</ul>
	    				</div>
	    			</div>
    			</div>    			
	    	</div>  
    	</div>	
    </div><!--/#contact-page --> 

    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
     <script type="text/javascript" src="{{asset('js/gmaps.js') }}"></script>
     <script src="{{asset('js/contact.js') }}"></script>
    @endsection