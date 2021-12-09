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
    <title>EDE(Customer) - Profile</title>
		  
<style>
	html, body {
  		height: 100%;
  		margin: 0;
	}

	#header1{
		background-color: #ff4242;
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
		background-color:#ff8080;
	}	
</style>

</head>
	
<body>
	<header id="header1" class="bd-header py-3 d-flex align-items-stretch border-bottom border-dark">		
		<div class="container-fluid d-flex align-items-center">
			<h3 class="d-flex align-items-center fs-4 text-white mb-0">Customer View</h3>
			<small class="d-flex align-items-center fs-4 text-white mb-0">&nbsp;&nbsp;&nbsp;
				<?php echo "Welcome! " . $_SESSION["username"] . ".";?>
			</small>
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
              				<span data-feather="home"></span></a>Order Management<a class="nav-link" href="Fill Air Waybills.php">Fill Air Waybills</a>
         				</li>

          				<li class="nav-item">
            				<a class="nav-link" href="Update Profile.php">
              				<span data-feather="file"></span>Update Profile</a>
          				</li>

          				<li class="nav-item">
            				<a class="nav-link" href="View Parcel.php">
              				<span data-feather="shopping-cart"></span>
              				View Parcel</a>
          				</li>

          				<li class="nav-item">
            				<a class="nav-link" href="View Record.php">
            				<span data-feather="users"></span>View Record</a>      
						</li>
					</ul>
      			</div>
    		</nav>

    		<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
			<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        		<h1 class="h2">Air Waybills Delivery Record</h1>
		  
        		<div class="btn-toolbar mb-2 mb-md-0">
          			<form class="form-inline">
          			</form>
        		</div>
      		</div>

			<br>
      
			<table class="table table-bordered">
				<tr><th>Delivery Record ID</th>
					<th>Air Waybill’s Number</th>
					<th>Delivery Status ID</th>
					<th>Record Date Time</th>
					<th>Current Location</th>
				</tr>
				
				<!-- initialize table and records -->
            	<?php 
				// stablish db conn
				require_once("../connection/mysqli_conn.php");

				$custEmail = $_SESSION["email"];

				$sql="SELECT airWaybillDeliveryRecordID, airwaybilldeliveryrecord.airWaybillNo, deliveryStatusID, recordDateTime, currentLocation
				FROM airwaybilldeliveryrecord, airwaybill 
				
				WHERE airwaybilldeliveryrecord.airWaybillNo = airwaybill.airWaybillNo 
				and airwaybill.customerEmail = '$custEmail'";
				$rs=mysqli_query($conn, $sql);

				// print row
				if(mysqli_num_rows($rs)>0){
					// convert ID into humanly readable text
					while($rc=mysqli_fetch_assoc($rs)){
						switch($rc['deliveryStatusID']){
							case 1:
								$status = "Waiting for Confirmation";
								break;
							case 2:	
								$status = "Confirmed";
								break;
							case 3:
								$status = "In Transit";
								break;
							case 4:
								$status = "Delivering";
								break;
							case 5:
								$status = "Completed";
								break;
						}
						// print table 
						echo "<tr>
								<td>$rc[airWaybillDeliveryRecordID]</td>
								<td>$rc[airWaybillNo]</td>
								<td>$status</td>
								<td>$rc[recordDateTime]</td>
								<td>$rc[currentLocation]</td>
							  </tr>";
					}
				} else {
					// if there is no existing data
				echo "<h1>***No record***</h1>";
				}
				?>
			</table>
		</div>
	</div>
		
	<br><br><br><br><br>
		
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
   	</div>
	<br>
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
</div>		
</body>	
</html>