<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>OpenMedic</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta name="description" content="Bootstrap 3 template for corporate business" />
<link href="css/bootstrap.min.css" rel="stylesheet" />
<link href="css/font-awesome.css" rel="stylesheet" />

<link href="css/style.css" rel="stylesheet" />
<link id="t-colors" href="skins/yellow.css" rel="stylesheet" />
<link id="bodybg" href="bodybg/bg1.css" rel="stylesheet" type="text/css" />
</head>
<body>



<div id="wrapper">

<header>

<div id="signupModal" class="modal fade">
    <div class="modal-dialog">
        <form method="post" id="signup_form">
            <div class="modal-content">
                <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Sign Up</h4>
            </div>
            <div class="modal-body">
			<label>User Type</label>
			<select name="user_type" id="user_type" class="form-control">
			<option value="Hospital">Hospital</option>
			<option value="Pharmacy">Pharmacy</option>
			<option value="Primary Health Care Center">Primary Health Care Center</option>
			</select>
			<label id="name_hidden" class=" ">Type of Hopsital</label>
			<select name="hospital_type" id="hospital_type" class="form-control hidden">
			<option value="Private">Private</option>
			<option value="Government">Government</option>
			</select>
			<label>Name</label>
			<input class="form-control" id="name" name="name" required>
			<label>Email</label>
			<input type="email" name="email" id="email" class="form-control" requied/>
			<label>Phone Number</label>
			<input class="form-control" id="gsm" name="gsm" required>
        
          	<label id="state_label" class=" ">State</label>
			<select name="state" id="state" class="form-control ">
			<option>Select Your State</option>
			</select>
            <label id="lga_label" class=" ">Local Government Area</label>
			<select name="lga" id="lga" class="form-control  ">
			<option>Select Your Local Government Area</option>
			</select>
          	<label id="address_label" class=" ">Address</label>
			<textarea name="address" id="address" class="form-control  "></textarea>
            
        
        	<label>Password</label>
			<input type="password" name="password" id="password" class="form-control" required/>
			<label>Retype Password</label>
			<input type="password" name="cpassword" id="cpassword" class="form-control" required/>
			
			</div>
            <div class="modal-footer">
            <input type="hidden" name="action" id="action" value="register"/>
            <input type="submit" name="operation" id="operation" class="btn btn-success" value="Register"/>
            </div>
			</div>
        </form>
    </div>
</div>

<div id="loginModal" class="modal fade">
    <div class="modal-dialog">
        <form method="post" id="login_form">
            <div class="modal-content">
                <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Login</h4>
            	</div>
            <div class="modal-body">
				<label>Email</label>
                <input type="email" name="email" id="email" class="form-control" required/>
				<label>Password</label>
				 <input type="password" name="password" id="password" class="form-control"  required/>
			</div>
            <div class="modal-footer">
            <input type="hidden" name="action" id="action" value="login"/>
            <input type="submit" name="operation" id="operation" class="btn btn-success" value="Login"/>
                       
            </div>
			</div>
        </form>

    </div>

</div>


<div id="vModal" class="modal fade">
    <div class="modal-dialog">
            <div class="modal-content">
           
		    <div class="modal-body">
				<table class="table">
				<tr>
				<th>
				<label>Drug Name</label>
				</th>
				<td>
				<span id="d_name"></span>
			  	</td>
				</tr>
				<tr>
				<th>
				<label>Drug Description</label>
				</th>
				<td>
				<span id="d_desc"></span>
			  	</td>
				</tr>
				<tr>
				<th>
				<label>Prescription</label>
				</th>
				<td>
				<span id="d_req"></span>
			  	</td>
				</tr>
				<tr>
				<th>
				<label>Qty</label>
				</th>
				<td>
				<span id="d_qty"></span>
				</td>
			  	</tr>
				<th>  
				  <label>Status</label>
				</th>
				<td>
				
				<span id="d_status"></span>
				</td>
				<tr>
				<td>Institution</td>
				<td><span id="d_insti"></span></td>
				</tr>
				<tr>
				<td>Name</td>
				<td><span id="d_real_name"></span></td>
				</tr>
				
				<tr>
				<td>Address</td>
				<td><span id="d_address"></span></td>
				</tr>
				<tr>
				<td>Email</td>
				<td><span id="d_email"></span></td>
				</tr>
				<tr>
				<td>Phone</td>
				<td><span id="d_gsm"></span></td>
				</tr>
				
				
				</table>
			</div>
            <div class="modal-footer">
          	<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
            </div>
			</div>
      
	  
    </div>

</div>

	<div class="navbar navbar-default navbar-static-top">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="index"><img src="img/logo.png" alt="" width="199" height="52" /></a>
			</div>
			<div class="navbar-collapse collapse ">
				<ul class="nav navbar-nav">
					<?php if (!isset($_SESSION['user'])){ ?>
					<li><button type="button" class="btn btn-default" id="signup" data-toggle="modal" href="#signupModal">Sign Up</button></li>
					
					<li><button type="button" class="btn btn-default" id="login" data-toggle="modal" href="#loginModal">Login</button></li>
					<?php }else{ ?>
					<li><button type="button" class="btn btn-default" id="dashboard">Dashboard</button></li>
				
					<li><button type="button" class="btn btn-default" id="logout">Logout</button></li>
					<?php }?>
					<li><button type="button" class="btn btn-default" id="donate">Donate</button></li>
			
				</ul>
			</div>
		</div>
	</div>
</header>
<div class="modal fade" id="msgModal">
	<div class="alert text-center col-lg-offset-5 col-lg-2 col-md-offset-4 col-md-3" id="color">
		<span id="msg" class="text-center"></span>
	</div>
</div>
	<section class="callaction">
	<div class="container">
		<div class="row">
						<form id="search-form">
							<div class="col-lg-12 text-center">
								<div>
								 <h3>Find your essential drugs</h3> 
								</div>
								<br>
								<div class="col-lg-4  col-md-6 col-sm-4">
								<p>
								<input class="form-control" name="product_name" id="product_name" placeholder="Enter Drug Name Here....." required>
								</p>
								</div>

								<div class="col-lg-3  col-md-4 col-sm-3">
								<p>
								
								<select name="state_" id="state_" class="form-control">
								<option>Select Your State</option>
								</select>
            
				
								<!--
								<select class="form-control" name="community" id="community">
									<option value="hospital">By Hospital</option>
									<option value="pham">By Pharmacy</option>
									<option value="phcc">By Primary Health Care Center</option>
								</select>
								-->
								
								</p>
								</div>
								<div class="col-lg-3  col-md-4 col-sm-3">
								<p>
		
								<select name="lga_" id="lga_" class="form-control">
								<option>Select Your Local Government Area</option>
								</select>
								</p>
								</div>
								<input type="hidden" name="action" id="action" value="search">
								<div class="col-lg-2  col-md-2 col-sm-2">
								<p>
								<input class="btn btn-theme" type="submit" name="search" id="search" value="&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;Search &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;">
								</p>
								<div>
							</div>	
						</form>
		</div>
	</div>
	</section>
	
	<section id="content">
		<div class="container">
    		<div class="row">
	    		<div class="col-lg-12">
		    		<div class="row">
					<img src="img\cbp-loading-popup.gif" id="loader" class="hidden" style="display: block; margin: auto;">
					<span id="result"></span>
					</div>
				</div>
			</div>
		</div>
		
		<!-- 
			

		<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="solidline">
				</div>
			</div>
		</div>
		</div>
		
		
		
		<div class="container">
				<div class="row">
								<div class="col-xs-6 col-md-2 aligncenter client">
									<img alt="logo" src="img/clients/logo1.png" class="img-responsive" />
								</div>											
													
								<div class="col-xs-6 col-md-2 aligncenter client">
									<img alt="logo" src="img/clients/logo2.png" class="img-responsive" />
								</div>											
													
								<div class="col-xs-6 col-md-2 aligncenter client">
									<img alt="logo" src="img/clients/logo3.png" class="img-responsive" />
								</div>											
													
								<div class="col-xs-6 col-md-2 aligncenter client">
									<img alt="logo" src="img/clients/logo4.png" class="img-responsive" />
								</div>									
								
								<div class="col-xs-6 col-md-2 aligncenter client">
									<img alt="logo" src="img/clients/logo5.png" class="img-responsive" />
								</div>									
								<div class="col-xs-6 col-md-2 aligncenter client">
									<img alt="logo" src="img/clients/logo6.png" class="img-responsive" />
								</div>	

				</div>
		</div>
	 -->
	</section>
	
	<footer>
	<div id="sub-footer">
		<div class="container">
			<div class="row">
				<div class="col-lg-6">
					<div class="copyright">
						<p>&copy; OpenMedic</p>
    				</div>
				</div>
				<div class="col-lg-6">
					<ul class="social-network">
						<li><a href="https://facebook.com/openmedic" data-placement="top" title="Facebook"><i class="fa fa-facebook"></i></a></li>
						<li><a href="https://twitter.com/openmedic" data-placement="top" title="Twitter"><i class="fa fa-twitter"></i></a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	</footer>
</div>
<a href="#" class="scrollup"><i class="fa fa-angle-up active"></i></a>
<span id="mode"></span>
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="app/set.js"></script>
<script>loadstate();</script>
<script>loadstate_();</script>

</html>
