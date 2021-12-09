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
	
		#report{
			display: inline-flex;
			flex-direction: row;
			align-items: flex-start;
			justify-content: flex-start;
			border: 1px solid black;
			flex-basis: content;
			padding: 80px;
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
	  		<div class="container"> 
	      		<main>
				<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        			<h1 class="h2">Generate Report</h1>

					<button type="button" class="btn btn-success" onclick="printPage()">Print</button>

      			</div>			  
				<div class="container"> 
	  				<div class="row">
    				<div class="col">

     					<div id="report">  
							<div class="container-fluid">
  								<div class="row">
    								<div class="col">
										<p class="text-center">
      									<b>EDE Generated Report</b><br>
										<br>
										Hong Kong, Wan Chai, 888 Hennessy Rd<br>
										<br>
										Date Generated: 
										<?php

										// get today's date
										echo date("Y-m-d");
										
										?><br>
										</p>
										<hr>
    								</div>
  								</div>
  								<div class="bd-example">
									<table class="table table-bordered">
										<tr>
										<th width="5%">AWB Number</th>
										<th width="20%">Customer’s Email</th>
										<th width="20%">Customer’s Name</th>
										
										<th width="13%">Staff’s ID</th>
										<th width="17%">Date</th>

										<th width="20%">Receiver Name</th>
										<th width="20%">Receiver Phone Number</th>
										<th width="20%">Receiver Address</th>
										<th width="10%">Weight</th>
										<th width="10%">Total Price</th>
										</tr>
										
										<!-- initialize the table as well as the records -->
										<?php

										require_once("../connection/mysqli_conn.php");

										$sql="SELECT * FROM airwaybill ORDER BY date DESC";
										$rs=mysqli_query($conn, $sql);
										
										// print out table of records
										while($rc=mysqli_fetch_assoc($rs)){

											$sql="SELECT customerName FROM customer WHERE customerEmail = '$rc[customerEmail]'";
											$cust=mysqli_query($conn, $sql);
											$custt= mysqli_fetch_assoc($cust);

											echo "<tr>
												<td>$rc[airWaybillNo]</td>
												<td>$rc[customerEmail]</td>
												<td>$custt[customerName]</td>

												<td>$rc[staffID]</td>
												<td>$rc[date]</td>

												<td>$rc[receiverName]</td>
												<td>$rc[receiverPhoneNumber]</td>
												<td>$rc[receiverAddress]</td>
												<td>$rc[weight]</td>
												<td>$rc[totalPrice]</td>";					
										}
										?>
									</table>
								</div>
							</div>
						</div>
    				</div>
  				</div>
		  		</main>
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
    	</div><br>
		<div class="footer-text">
			About us   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			Overview    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			News    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			FAQ    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			Collaborate With Us  <br/>
		</div><br>
		</footer>
	</div>
</body>	
</html>

<script>

// print function
// WARNING: THIS MAY NOT WORK PROPERLY IN GOOGLE CHROME

function printPage(){
	var prtContent = document.getElementById("report");
	var WinPrint = window.open('', '', 'left=0,top=0,width=800,height=900,toolbar=0,scrollbars=0,status=0');
	WinPrint.document.write(prtContent.innerHTML);
	WinPrint.document.close();
	WinPrint.focus();
	WinPrint.print();
	WinPrint.close();
}
</script>