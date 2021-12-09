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
</style>

<script>
  // clear all inputs
  function clearForm() { document.getElementById("form1").reset(); }

  // enable textbox
  function editData() { 
    document.getElementById("custName").disabled = false;
    document.getElementById("custPswd").disabled = false;
    document.getElementById("custPhone").disabled = false;
    document.getElementById("custAddress").disabled = false;
    document.getElementById("editBtn").disabled = true;
    document.getElementById("update").disabled = false;
  }

  //  onload, generate user information
  window.onload = function(){
    <?php
      $email = $_SESSION["email"];
      require_once("../connection/mysqli_conn.php");
      $sql="SELECT * FROM customer WHERE customerEmail = '$email'";
      $rs=mysqli_query($conn, $sql);
      $rc=mysqli_fetch_assoc($rs);
        
      $name = $rc['customerName'];
      $pswd = $rc['customerPassword'];
      $phone = $rc['phoneNumber'];
      $address = $rc['address'];
    ?>

    // insert data in text box
    document.getElementById("custName").value = "<?php echo $name; ?>";
    document.getElementById("custPswd").value = "<?php echo $pswd; ?>";
    document.getElementById("custPhone").value = "<?php echo $phone; ?>";
    document.getElementById("custAddress").value = "<?php echo $address; ?>";
    document.getElementById("update").disabled = true;
}
</script>	  

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
        <h1 class="h2">Customer's Profile</h1> 
        <div class="btn-toolbar mb-2 mb-md-0">
          <form method="post">
            <input type="submit" name="delete" value="Delete Account" id="delete" class="btn btn-primary" >
          </form>
        </div>
      </div>

    <br><br><br><br><br>
      
    <form class="form-horizontal" id="form1" action="Update Profile.php" method="post">
      <div class="form-group">
      <label for="inputEmail3" class="col-sm-2 control-label">Name:</label>
        <div class="col-sm-5">
          <input type="text" class="form-control" id="custName" disabled="true" name="name" value="">
        </div>
      </div>

      <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Password:</label>
        <div class="col-sm-5">
          <input type="text" class="form-control" id="custPswd" disabled="true" name="password" value="">
        </div>
      </div>

      <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Phone Number:</label>
        <div class="col-sm-5">
          <input type="text" class="form-control" id="custPhone" disabled="true" name="phone" value="">
        </div>
      </div>

      <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Address:</label>
        <div class="col-sm-5">
          <input type="text" class="form-control" id="custAddress" disabled="true" name="address" value="">
        </div>
      </div>

      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <input type="submit" name="update" value="Submit" id="update" class="btn btn-success">
          <button type="button" id = "editBtn" onclick="editData()" class="btn btn-warning">Edit</button>
        </div>
      </div>
    </form>		

  </div></div>
		
  <br><br><br><br><br>
		
	<footer class="footer bg-light" id="wrapper">
  <img src="img/footer.png" width = "100%" height = "1">
  <div class="footer-img">
		<table>
		  <tr>
			  <th><img src="../img/footer-Address@2x.png" width = "30" height = "30"></img></th>
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
	  Overview   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	  News       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	  FAQ        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	  Collaborate With Us  <br/>
  </div>

	<br>
	</footer>	
  </main>
  </div>
  </div>
  </body>
</html>

<?php

// on POST
if(isset($_POST['update'])){

    // check if empty
    if(!empty($_POST['name']) && !empty($_POST['password']) && !empty($_POST['phone']) && !empty($_POST['address'])){
        // get data from input
        $email = $_SESSION["email"];
        $custName = $_POST['name'];
        $custPassword = $_POST['password'];
        $custPhone = $_POST['phone'];
        $custAddress = $_POST['address'];

        // enstablish connection
        require_once("../connection/mysqli_conn.php");

        // sql query
        $sql = "UPDATE Customer SET customerName = '$custName',
                                    customerPassword = '$custPassword',
                                    phoneNumber = '$custPhone', 
                                    address = '$custAddress' 
                                    WHERE customerEmail = '$email'";

        // exec sql
        $query_run = mysqli_query($conn, $sql);
        
        // check if the query is successful
        if($query_run){
            echo '<script type="text/javascript"> alert("Data update successful") </script>';
            $_SESSION["username"] = $custName;
        } else {
            echo '<script type="text/javascript"> alert("Data update unsuccessful") </script>';
        }
    } else {
        echo '<script type="text/javascript"> alert("Each column can not be null") </script>';
    }
}
?>

<?php
// delete record, if the btn is being pressed
if(isset($_POST['delete'])){
    
    // acquire user information from session
    $email = $_SESSION["email"];

    // enstablish conn
    require_once("../connection/mysqli_conn.php");

    $sql = "SELECT * FROM customer WHERE customerEmail = '$email'";
    $exc = mysqli_query($conn, $sql);
    $cust = mysqli_fetch_assoc($exc);

    $sql = "SELECT * FROM airwaybill WHERE customerEmail = '$cust[customerEmail]'";
    $exc = mysqli_query($conn, $sql);

    // check every existing delivery records and delete it
    if(mysqli_num_rows($exc)>0){
      while($rc=mysqli_fetch_assoc($exc)){
          $del = "DELETE FROM `airwaybilldeliveryrecord` WHERE `airWaybillNo` = $rc[airWaybillNo]";
          $rec = mysqli_query($conn, $del);
      }
    }

    $sql = "SELECT * FROM airwaybill WHERE customerEmail = '$cust[customerEmail]'";
    $exc = mysqli_query($conn, $sql);

    // check every existing airwaybill records and delete it
    if(mysqli_num_rows($exc)>0){
      while($rc=mysqli_fetch_assoc($exc)){
          $del = "DELETE FROM `airwaybill` WHERE `customerEmail` = '$cust[customerEmail]'";
          $rec = mysqli_query($conn, $del);
      }
    }
    
    // delete customer account information
    $del = "DELETE FROM `customer` WHERE `customerEmail` = '$cust[customerEmail]'";
    $rec = mysqli_query($conn, $del);

    // aleret message 
    if($rec){
      echo '<script type="text/javascript"> alert("Thanks for using EDE, We are always ready to service you!") </script>';
      echo '<script type="text/javascript">window.location = "../Login.php"; </script>';
    }
}
?>