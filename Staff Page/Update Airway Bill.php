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
</head>
<body>
	<header id="header1" class="bd-header py-3 d-flex align-items-stretch border-bottom border-dark">	
  	<div class="container-fluid d-flex align-items-center">
    	<h3 class="d-flex align-items-center fs-4 text-white mb-0">Edit Panel</h3>
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
              				<span data-feather="home"></span></a>Order Management<a class="nav-link" href="Confirm Orders.php">Confirm orders</a>
          				</li>

          				<li class="nav-item">
            				<a class="nav-link" href="Update Airway Bill.php">
              				<span data-feather="file"></span>Update Airway Bill</a>
          				</li>

          				<li class="nav-item">
            				<a class="nav-link" href="Update Delievry Status.php">
              				<span data-feather="shopping-cart"></span>Update Delivery Status</a>
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
        		<h1 class="h2">Update airway bill info</h1>
			</div>

			<br>

			<table class="table table-bordered">
				<tr><th>Air waybill No.</th>
					<th>Customer's Email</th>
					<th>LocationID</th>
					<th>date</th>
					<th>ReceiverName</th>
					<th>StaffID</th>
					<th>Weight (kg)</th>
					<th>totalPrice (HK$)</th>
				</tr>

            	<?php
				require_once("../connection/mysqli_conn.php");
				$sql="SELECT * FROM airwaybill";
				$rs=mysqli_query($conn, $sql);

				while($rc=mysqli_fetch_assoc($rs)){
					echo "<tr>
							<td>$rc[airWaybillNo]</td>
							<td>$rc[customerEmail]</td>
							<td>$rc[locationID]</td>
							<td>$rc[date]</td>
							<td>$rc[receiverName]</td>
							<td>$rc[staffID]</td>
							<td>$rc[weight]</td>
							<td>$rc[totalPrice]</td>
						  </tr>";
				}
				?>
			</table>
	        		

			<br>
		
			<h3>Update Record</h3>
			<div class="btn-toolbar mb-2 mb-md-0">
		  		<form class="form-inline" method="post">
					<p>
						<label>Airway Bill ID: &nbsp;</label>
						<input class="form-control mr-sm-2" type="text" aria-label="Search" name="billNo"><br>
					</p>
		    

					<p>
						<label>Location ID: &nbsp; </label>
						<select name="loc" id="loc" class="form-control">
							<option disabled selected value> -- select a status -- </option>
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
						</select>
					</p>

					<p>
						<label>Weight: &nbsp;</label>
						<input class="form-control mr-sm-2" type="text" aria-label="Search" name="weight">
					</p>

		  			<input type="submit" name="update" value="Update" class="btn btn-info">
				</form>
	  		</div>	
		</div>
		
		<br><br><br><br>
		
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
</body>	
</html>
<?php

if(isset($_POST['update'])){

	// acquire from session
	$staff = $_SESSION["stfID"];

	// acquire from form input
	$bill = $_POST['billNo'];
	$loc = $_POST['loc'];
	$weight = $_POST['weight'];
	$actualWeight = $weight;

	// TO ACQUIRE CUSTOMER JOIN DATE

	// based on the airway bill no selected
	// and then find the customerEmail (PK)
	$sql = "SELECT * FROM `airwaybill` WHERE airWaybillNo = '$bill'";
	$rs = mysqli_query($conn, $sql);
	$row = mysqli_fetch_array($rs);

	// fetch the customerEmail
	$cusEmail = $row['customerEmail'];

	// Commence another query on the customer table
	// find the join date
	$sql = "SELECT * FROM `customer` WHERE customerEmail = '$cusEmail'";
	$rs = mysqli_query($conn, $sql);
	$row = mysqli_fetch_array($rs);

	// fetch the customer Join Date
	$dateJoin = $row['accountCreationDate'];

	$weight = ceil($weight);

	// enstablish db conn
	require_once("../connection/mysqli_conn.php");
	
	// get charge from chargetable
	$sql="SELECT * FROM `chargetable` WHERE `locationID` = $loc AND `weight` = $weight";
	$price=mysqli_query($conn, $sql);
	$rate = mysqli_fetch_assoc($price);
	$cost = $rate['rate'];

	// take values from the flask server
	$ch = curl_init("http://127.0.0.1:5000/api/discountCalculator?regDate=".$dateJoin."&fee=".$cost);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
	$cost = curl_exec($ch);
	// close connection
	curl_close($ch);

	// update record
	$sql="UPDATE `airwaybill` SET `staffID`= '$staff' ,`weight`=$actualWeight,`totalPrice`= $cost WHERE airWaybillNo = $bill";
	$rs=mysqli_query($conn, $sql);

	if($rs){
		echo '<script type="text/javascript"> alert("Create Air waybill successful") </script>';
	} else {
		echo '<script type="text/javascript"> alert("Create Air waybill unsuccessful") </script>';
	}
}

?>