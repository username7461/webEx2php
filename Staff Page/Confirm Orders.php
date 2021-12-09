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
      <main class="col-md-9 ms-md-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">List of Orders Waiting to confirm</h1>
      </div>

		  <br>
      <h4>Confrim order</h4>
			<div class="btn-toolbar mb-2 mb-md-0">
		  		<form class="form-inline" method="post">
		     		<p> 
	        			<input class="form-control mr-sm-4" type="text" aria-label="Search" name="awb" placeholder="Air waybill no."></textarea>
						<p> <input type="submit" name="update" value="Update" class="btn btn-info">	
                <input type="submit" name="delete" value="Delete" class="btn btn-danger">	
	      		</form>
	  	</div><br>
		
      <div class="bd-example">
          <table class="table table-bordered">
            <tr>
              <th>AWB_No#</th>
              <th>Customer's Email</th>
              <th>LocationID</th>
              <th>date</th>
              <th>ReceiverName</th>
              <th>ReceiverPhoneNumber</th>
              <th>receiverAddress</th>
              <th>Status</th>
            </tr>
            <!-- initialize data when the web is loaded -->
            <?php
            // enstablish db conn
            require_once("../connection/mysqli_conn.php");

            // only show records which is "Waiting for Confirmation" ONLY
            $status = "Waiting for Confirmation";

            // inner sql: search for unique airwaybillno with latest dateTime
            // outer sql: search for deliveryStatusID which is = 1
            $sql="SELECT * from
              ( 
                SELECT *
                FROM airwaybilldeliveryrecord
                WHERE (airWaybillNo,recordDateTime) IN (
                  SELECT airWaybillNo, MAX(recordDateTime)
                  FROM airwaybilldeliveryrecord
                  GROUP BY airWaybillNo
                )) AS SUBQUERY
                where SUBQUERY.deliveryStatusID = 1";
            
            // exec query
            $rs=mysqli_query($conn, $sql);

            // generate table of airwaybilldelivery records
            if(mysqli_num_rows($rs)>0){
              while($rc=mysqli_fetch_assoc($rs)){
      
                $sql="SELECT * FROM airwaybill WHERE airWaybillNo = '$rc[airWaybillNo]'";
                $records=mysqli_query($conn, $sql);
                $record=mysqli_fetch_assoc($records);

                echo "<tr>
                      <td>$record[airWaybillNo]</td>
                      <td>$record[customerEmail]</td>
                      <td>$record[locationID]</td>
                      <td>$record[date]</td>
                      <td>$record[receiverName]</td>
                      <td>$record[receiverPhoneNumber]</td>
                      <td>$record[receiverAddress]</td>
                      <td>$status</td>
                      </tr>";
                }
              } else {
                
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
    </div><br>
	  <div class="footer-text">
      About us   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      Overview    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      News    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      FAQ    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      Collaborate With Us  <br/>
	  </div><br>
		</footer>
    </main>
  </div>
</body>
</html>

<?php

// btn onclick: update btn is clicked, update awb delivery record
// this means the orders is accepted
if(isset($_POST['update'])){
  if(!empty($_POST['awb'])){
    $awb = $_POST['awb'];

    require_once("../connection/mysqli_conn.php");

    $sql="INSERT INTO `airwaybilldeliveryrecord`(`airWaybillNo`, `deliveryStatusID`) VALUES ($awb,2)";
	  $exc=mysqli_query($conn, $sql);

    if($exc){
      echo '<script type="text/javascript"> alert("Create Air waybill successful") </script>';
  
    } else {
      echo '<script type="text/javascript"> alert("Create Air waybill unsuccessful") </script>';
    }
  }
}
?>

<?php
// btn onclick: delete btn is clicked delete orders
// this means the orders is rejected
if(isset($_POST['delete'])){
  if(!empty($_POST['awb'])){
    $awb = $_POST['awb'];

    require_once("../connection/mysqli_conn.php");
    $sql="DELETE FROM `airwaybilldeliveryrecord` WHERE `airWaybillNo` = $awb";
	  $exc=mysqli_query($conn, $sql);
    
    $sql="DELETE FROM `airwaybill` WHERE `airWaybillNo` = $awb";
	  $exc=mysqli_query($conn, $sql);

    if($exc){
      // successful
      echo '<script type="text/javascript"> alert("Delete Air waybill successful") </script>';
    } else {
      // unsuccessful
      echo '<script type="text/javascript"> alert("Delete Air waybill unsuccessful") </script>';
    }
  }
}

?>