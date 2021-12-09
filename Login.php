<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Using bootstrap 3.4.1 -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Login Page</title>	  	  
	<style>
		body {
			background-image: url('img/img102.jpg');
			background-repeat: no-repeat;
			background-attachment: fixed;  
			background-size: cover;
			overflow: hidden;
			
		}
		
		.form {
			width: 100%;
			max-width: 330px;
			padding: 15px;
			margin: auto;
		}
	</style>
</head>	
<body class="text-center">
  	<nav class="navbar navbar-dark" aria-label="Tenth navbar example">
      	<div class="collapse navbar-collapse justify-content-md-center" id="navbarsExample08">
        	<ul class="navbar-nav">
          		<li class="nav-item">
            		<a class="nav-link active font-weight-light" aria-current="page">EDE - Eastern Delivery Express</a>
          		</li>
        	</ul>
      	</div>
  	</nav>
	<main class="form">	


		<!-- the form -->
	    <form id="form1" class="p-md-5 border bg-light" method="post" onsubmit="return check()">
			<h2>Login</h2>
			<div class="form-group">
				<p class="text-left">User ID
				<input type="text" class="form-control" placeholder="Enter User ID" name="userID">
				<p class="text-left">Password
				<input type="password" class="form-control" placeholder="Enter Password" name="password">
				</p></p>
				<br>
				<button type="button" class="btn btn-danger p-2 bd-highlight" onclick="clearForm()">Clear</button>
				<br><br>
				<hr class="my-4">
				<div class="d-flex bd-highlight mb-3">

				<div class="col-xs-1 col-md-8 text-right font-weight-light"> Login as:</div>

					<button type="submit" name="Customer_Login" id="option" value="staff" onclick="onClick()" class="btn btn-primary p-2 bd-highlight"> Customer </button>
					<button type="submit" name="Staff_Login" id="option" value="staff" onclick="onClick()"  class="btn btn-primary mr-auto p-2 bd-highlight"> Staff </button>
	
				</div>
			</div>
		</form>   


		<?php
			// pop's up a messagebox
			function function_alert($message) {
				echo "<script>alert('$message');</script>";
			}

			//upon submission
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				require_once("connection/mysqli_conn.php");

				// acquire var from input fields
				$password = $_POST["password"];
				$userID = $_POST["userID"];
				
				// check for empty input
				if ($password=="" && $userID==""){
					function_alert ("Please Enter Login Information");

					// when the customer login btn is clicked
				} else {
					if (isset($_POST['Customer_Login'])) {

						// acquire sql query from inputted record
						$sql = "SELECT * FROM customer where customerEmail = '$userID' and customerPassword = '$password'";
						$rs = mysqli_query($conn, $sql);
						$row = mysqli_fetch_array($rs);
						
						// if enter correct
						if ($row['customerEmail']==$userID && $row['customerPassword']==$password){
			
							// create SESSION
							session_start();

							$userID = $row['customerName'];
							$email = $row['customerEmail'];
							
							$_SESSION["email"] = $email;
							$_SESSION["username"] = $userID;
							
							// redirect
							header("Location: Customer%20Page/Fill%20Air%20Waybills.php");
							exit();
						} else {
							// otherwise, the input is wrong
							function_alert ("Wrong Login!");
						}
						// when the staff btn is clicked
					}  else if (isset($_POST['Staff_Login'])) {

						// query for staff info
						$sql = "SELECT * FROM staff where staffID = '$userID' and staffPassword = '$password'";
						$rs = mysqli_query($conn, $sql);
						$row = mysqli_fetch_array($rs);

						// check if the input data matches waith database
						if ($row['staffID']==$userID && $row['staffPassword']==$password){

							// create SESSION
							session_start();

							$userID = $row['staffName'];
							$_SESSION["username"] = $userID;

							$stfID = $row['staffID'];
							$_SESSION["stfID"] = $stfID;
							
							// redirect
							header("Location: Staff%20Page/Confirm%20Orders.php");
							exit();
						} else {
							function_alert ("Wrong Login!");
						}
					}			
				} 
			}
		?>
	</main>	 

	<script>
		src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"; integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd"; crossorigin="anonymous">
	</script>
	
	<script>
 		$('#option').on('click', onClick() {
    		$(this).button('toggle')
  		})
	</script>
	
	<script>
		// reset input
		function clearForm() { document.getElementById("form1").reset();}
	</script>

</body>
</html>