<?php session_start();
if (!isset($_SESSION['user'])){echo "<script>window.open('index','_self')</script>";}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>OpenMedic - Dashboard</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta name="description" content="Bootstrap 3 template for corporate business" />
<link href="css/bootstrap.min.css" rel="stylesheet" />
<link href="css/bootstrap-table.css" rel="stylesheet" />
<link href="css/font-awesome.css" rel="stylesheet" />

<link href="css/style.css" rel="stylesheet" />
<link id="t-colors" href="skins/yellow.css" rel="stylesheet" />
<link id="bodybg" href="bodybg/bg1.css" rel="stylesheet" type="text/css" />
</head>
<body>



<div id="wrapper">

<header>


<div id="productModal" class="modal fade">
    <div class="modal-dialog">
        <form method="post" id="product_form">
            <div class="modal-content">
                <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Upload Product</h4>
            	</div>
            <div class="modal-body">
			<label id="upload_label">Upload Type</label>
			<select name="upload_type" id="upload_type" class="form-control">
			<option value="reg">Regular</option>
			<option value="excel">Excel</option>
			</select>
			<label id="upload_label" class="hidden">Select File</label>
			<input type="file" name="upload_file" id="upload_file" class="form-control hidden">
			<div id="instr" class="hidden">
				<p>Please follow the following instructions</p>
				<p>Create a blank excel sheet each time you want to add new products to your inventory</p>
				<p>The excel sheets should follow the order as described in the image below</p>
				<img class="img-responsive" src="img/excel.png">
			</div>
			<label id="name_label">Name</label>
			<input name="drug_name" class="form-control" id="drug_name">
			<!--
			<select name="drug_name" class="form-control " id="drug_name">
			</select>
			-->
			<label id="desc_label">Drug Description</label>
			<textarea id="drug_desc" name="drug_desc" class="form-control "></textarea>
			<label id="qty_label">Quantity</label>
			<input name="qty" class="form-control " id="qty">
			
			<label id="pre_label">Prescription Required?</label>
			<select name="pre" class="form-control " id="pre">
			<option value="No">No</option>
			<option value="Yes">Yes</option>
			</select>
		
			<label id="status_label">Status</label>
			<select name="status" class="form-control " id="status">
			<option value="In Use">In Use</option>
			<option value="Not In Use">Not In Use</option>
			</select>
			

			
			</div>
            <div class="modal-footer">
            <input type="hidden" name="id_" id="id_"/>
            <input type="hidden" name="action" id="action"/>
            <input type="submit" name="operation" id="operation" class="btn btn-success" value="Upload"/>
            </div>
			</div>
        </form>
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
					<li><button type="button" class="btn btn-default" id="home">Home</button></li>
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
					<button type="button" class="btn btn-lg btn-theme" id="product" data-toggle="modal" href="#productModal">Add Product</button>
				
	</div>
	</div>
	</section>

	<section id="content">
		<div class="container">
    		<div class="row">
		    	<div class="col-lg-12">
					<div class="panel panel-default">
					<div class="panel-heading">Inventory</div>
					<div class="panel-body">
						<table id="product_table" data-url="app/data.php?action=fetch" data-toggle="table"  data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc">
						    <thead>
						    <tr>
						        <th>#</th>
								<th data-sortable="true">Name</th>
						        <th data-sortable="true">Qty</th>
							<!--	<th>Update</th> -->
								<th>Edit</th>
						    </tr>
						    </thead>
						</table>
					</div>
					</div>
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
<script src="js/bootstrap-table.js"></script>
<script src="app/set.js"></script>
<script></script>
</html>
