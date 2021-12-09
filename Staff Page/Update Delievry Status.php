<?php
session_start();
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Using bootstrap 3.4.1 -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>EDE(Staff) - Generate Report</title>	  
	<style>	
		.blocktext {
			margin-left: auto;
			margin-right: auto;
		}

		html, body {
			height: 100%;
			margin: 0;
		}

		#header1{
			background-color: #FFBD42;
			z-index: 0;
		}

		#logout{
			background-color: #FFFFFF;
			position: fixed;
			top: 0;
			right: 0;
		}

		.footer{
			background: #FF0004;
			position: relative;
			left: 0;
			bottom: 0;
			width: 100%;
			z-index: 2;
			box-shadow: inset 0 1.3px 0 rgba(0, 0, 0, 0.3);
		}

		#signout{
			position: relative;
			top: 0;
			right: 0;
			background: #E4E4E4
		}

		.footer-img{
			margin: auto;
			width: auto;
			height: auto;
			display: flex;
			justify-content: center;
			align-items: center;
		}

		#sidebarMenu{
			position:sticky;
			bottom: 10;
		}
	
		.footer-text{
			text-align: center;
		}

		#form-item{
			outline-color: black;
		}

		tr:hover {
			background-color:#FFBD42;
		}
		
	</style>
	<script>	
		function refresh(){
			window.location.reload()
		}
	</script>
</head>	
<body>
	<header id="header1" class="bd-header py-3 d-flex align-items-stretch border-bottom border-dark">	
  	<div class="container-fluid d-flex align-items-center">
    	<h3 class="d-flex align-items-center fs-4 text-white mb-0">Edit Panel</h3>
 		<small class="d-flex align-items-center fs-4 text-white mb-0">&nbsp;&nbsp;&nbsp;
			 <?php echo "Welcome! " . $_SESSION["username"] . ".";?></small>
  	</div>
	<div class="nav-item text-nowrap">
      	<a class="nav-link px-3" href="../Login.php" id="signout">Sign out</a>
	</div>
	</header>
	<div class="container-fluid">
  		<div class="row">
			<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      			<div class="position-sticky pt-3">
        			<ul class="nav flex-column">
          				<li class="nav-item">
            				<a class="nav-link active" aria-current="page" href="#">
              				<span data-feather="home"></span></a>Order Management<a class="nav-link" href="Confirm Orders.php">Confirm orders</a>
          				</li>
          				<li class="nav-item">
            				<a class="nav-link" href="Update Airway Bill.php">
              				<span data-feather="file"></span>Update Airway Bill</a>
          				</li>
          				<li class="nav-item">
            				<a class="nav-link" href="Update Delievry Status.php">
              				<span data-feather="shopping-cart"></span>
              				Update Delivery Status</a>
          				</li>
          				<li class="nav-item">
            				<a class="nav-link" href="Generate Report.php">
            				<span data-feather="users"></span>Generate Report</a>
						</li>
					</ul>
      			</div>
    		</nav>
    		<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">	
      		<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        		<h1 class="h2">Update Delivery Status</h1>
			</div>
			<h4>Update Record </h4>
			<div class="btn-toolbar mb-2 mb-md-0">
		  		<form class="form-inline" method="post">
					<p>
						<label>Airway Bill ID: &nbsp; </label>
						<input class="form-control mr-sm-2" type="search" aria-label="Search" name="id"><br>
					</p>
		      		<p>
						<label>Status ID: &nbsp; </label>
						<select name="status" id="status" class="form-control">
							<option disabled selected value> -- select a status -- </option>
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="2">4</option>
							<option value="3">5</option>
						</select>
					</p>
		     		<p> 
						<label>Current Location: &nbsp; </label>
	        			<input class="form-control mr-sm-4" type="text" aria-label="Search" name="curLoc">
						<p> <input type="submit" name="update" value="Update" class="btn btn-info">	
	      		</form>
	  		</div><br>
			  <div class="justify-content-center">
	        		<div class="bd-example">
						<table class="table table-striped">
							<tr>
								<th width="5%" scope="col">AWB_No#</th>
								<th width="8%" scope="col">Shipment Status ID</th>
								<th width="8%" scope="col">Record Time</th>
								<th width="4%" scope="col">Current Location</th>
							</tr>

							<!-- generate table of record when the web is being initialized -->
							<?php
							require_once("../connection/mysqli_conn.php");
							$sql="SELECT * FROM airwaybilldeliveryrecord ORDER BY airWaybillNo, recordDateTime DESC";
							$rs=mysqli_query($conn, $sql);

							while($rc=mysqli_fetch_assoc($rs)){
								echo "<tr>
										<td>$rc[airWaybillNo]</td>
										<td>$rc[deliveryStatusID]</td>
										<td>$rc[recordDateTime]</td>
										<td>$rc[currentLocation]</td>
									</tr>";					
							}

							?>
						</table><br>
        			</div>
					<h3> Information for StatusID</h3>
						1.	“Waiting for Confirmation” Means that the customer initiated the delivery request by completing the AWB.<br>
						2.	“Confirmed” Means that the staff checked the input from the customer and confirm the request.<br>
						3.	“In Transit” Means that the parcel is on the way to the destination.<br>
						4.	“Delivering” Means that the deliveryman is sending the parcel to the receiver.<br>
						5.	“Completed” Means that the receiver received the parcel.<br><br>
				</div> 
		</div><br><br><br><br>
		<footer class="footer bg-light" id="wrapper">
		<img src="img/footer.png" width = "100%" height = "1">
		<div class="footer-img">
			<table>
				<tr>
					<th><img src="../img/footer-Address@2x.png" width = "30" height = "30"> </img></th>
					<th>&nbsp;888 Hennessy Rd, Wan Chai, Hong Kong</th>
				</tr>
			</table>
		</div>
		<div class="footer-img">
			<table>
				<tr>
					<th><img src="../img/footer-Email@2x.png" width = "30" height = "30"></img></th>
					<th>&nbsp;	amywong1234@ede.com</th>
				</tr>
			</table>
		</div>
		<div class="footer-img">
			<table>
				<tr>
					<th><img src="../img/footer-Telephone@2x.png" width = "30" height = "30"> </img></th>
					<th> &nbsp; +852 1234-5678</th>
				</tr>	
			</table>
		</div><br>
		<div class="footer-text">
			About us   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			Overview    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			News    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			FAQ    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			Collaborate With Us  <br/>
		</div>
		<br>
		</footer>	
    	</main>
  	</div>	
</body>	
</html>
<?php

// when the update btn is clicked
if(isset($_POST['update'])){
	if(!empty($_POST['id']) && !empty($_POST['status'])){
		
		// acquire from input fields
		$id = $_POST['id'];
		$status = $_POST['status'];
		$loc = $_POST['curLoc'];

		require_once("../connection/mysqli_conn.php");

		// find airWaybillNo from table airwaybill
		$sql="SELECT airWaybillNo FROM airwaybill WHERE airWaybillNo = $id";
		$bills=mysqli_query($conn, $sql);
		$cust= mysqli_fetch_assoc($bills);

		// insert records with airWaybillNo into airwaybilldeliveryrecord
		$sql="INSERT INTO `airwaybilldeliveryrecord`(`airWaybillNo`, `deliveryStatusID`, `currentLocation`) VALUES ($cust[airWaybillNo], $status, '$loc')";
		$rs=mysqli_query($conn, $sql);

		if($rs){
			echo '<script type="text/javascript"> alert("Create Air waybill successful") </script>';
  
		} else {
			echo '<script type="text/javascript"> alert("Create Air waybill unsuccessful") </script>';
		}
	}
}

?>