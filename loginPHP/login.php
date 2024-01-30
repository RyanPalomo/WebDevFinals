<?php
	session_start();
	
	include 'connect.php';
  	if(empty($_SESSION['username']))
	{
		$_SESSION['username']="";
	}
	
	if(empty($_SESSION['logged']))
	{
		$_SESSION['logged']="";
	}
	
	if($_SESSION['logged'] != "logged")
	{
		$_SESSION['logged']="";
	}
	else
	{
		header('Location: index.php'); 
		// babalikan kapag mali yung input
		//index.php dapat to hehe
	}

	$_SESSION['varerror'] = " ";

  	if(isset($_POST['signupbutton']))
	{
		$sFname = $_POST['FName'];
		$sLname = $_POST['LName'];
		$sUname = $_POST['Username'];
		$sEmail = $_POST['Email'];
		$sPass = $_POST['Password'];
		$sConfPass = $_POST['CPassword'];
		$sPhone = $_POST['Phone'];
		$sYear = $_POST['Year'];

		// Check if the username contains symbols
		// if (preg_match('/[^A-Za-z0-9]/', $sUname)) {

		// 	echo "Symbols are not allowed in the input field.";
		// }

		
		
		$sDate = date("M d, Y");
		
		$checkQuery = "SELECT * FROM `users` WHERE username='".$sUname."'";
		$checkresult = mysqli_query($conn, $checkQuery);
		$checkcount = mysqli_num_rows($checkresult);
		
		if($checkcount > 0)
		{
			header('Location: login.php?invalid=1');
		}
		else if($sPass!=$sConfPass)
		{
			header('Location: login.php?invalid=2');
		}
		else
		{
			$saveSql = "INSERT INTO `users`(`username`,`fname`,`lname`,`year`,`email`,`password`,`date`,`phone`) VALUES('$sUname','$sFname','$sLname','$sYear','$sEmail','$sPass','$sDate','$sPhone')";
			$saveQuery = mysqli_query($conn,$saveSql);
			
			// $rewardssql = "INSERT INTO `rewards`(`username`,`rewards`,`date`) VALUES('$sUname','0','$sDate')";
			// $rewardssqlquery = mysqli_query($conn,$rewardssql);
			
			$_SESSION['username'] = $sUname;
			$_SESSION['logged'] = "logged";
			header('Location: index.php?created=1?');
			//index.php dapat to hehe
		}
	}

  if(isset($_GET['invalid']))
	{
		if($_GET['invalid']==1)
		 {
			echo
			'
			<div class="omodal">
				<div class="modal-content">
					<div class="modal-body" align="center">
						<strong style="color:green">"Username already taken"</strong><br><br>
						<strong><a href="login.php">Ok</a></strong>
					</div>
				</div>
			</div>
			';
		}
		if($_GET['invalid']==2)
		 {
			echo
			'
			<div class="omodal">
				<div class="modal-content">
					<div class="modal-body" align="center">
						<strong style="color:green">"Password does not match"</strong><br><br>
						<strong><a href="login.php">Ok</a></strong>
					</div>
				</div>
			</div>
			';
		}
		if($_GET['invalid']==3)

		 {
			echo
			'
			<div class="omodal">
				<div class="modal-content">
					<div class="modal-body" align="center">
						<strong style="color:green">"Invalid Password"</strong><br><br>
						<strong><a href="login.php">Ok</a></strong>
					</div>
				</div>
			</div>
			';
		 }
	}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <!-- CSS -->
  <link href="CSS/style.css" rel="stylesheet" type="text/css" media="all" />
  <!-- BOOSTRAP CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>
  <!-- Font Awesome CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
    integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8sh+WyWyFRRU5NFOGRiBveM1Tkky1uSIlOgjvK" crossorigin="anonymous">

</head>

<body>

  <!-- Start Banner Area -->
  <section class="registration">
    <div class="container-fluid ">
      <div class="row position-relative">
        <div class="col-md-6 p-0">
          <div class="background-wrapper">
          </div>
        </div>
        <div class="content-wrapper col-md-6">
          <div class="content justify-content-center text-center position-relative">
            <h1>Welcome</h1>
            <p class="">Welcome to ReservEase <br> Reservation is Made Effortlessly!</p>
            <form method="post">
              <div class=" mt-5">
                <input type="text" class="form-control" name="Fname" id="first-name" placeholder="First Name" required=" ">
              </div>
              <div class=" mt-3">
                <input type="text" class="form-control" name="Lname" id="last-name" placeholder="Last Name" required=" ">
              </div>
			  <div class=" mt-3">
                <input type="text" class="form-control" name="Username" id="username" placeholder="Username" pattern="[A-Za-z0-9]+" title="Doest not meet standards" required=" ">
              </div>
              <div class=" mt-3">
                <input type="text" class="form-control" name="Year" id="year-section" placeholder="Year-Section" required=" ">
              </div>
              <div class=" mt-3">
                <input type="email" class="form-control" name="Email" id="email" placeholder="Email" required=" ">
              </div>
			  <div class=" mt-3">
                <input type="text" class="form-control" name="Phone" id="phone" placeholder="Phone Number" pattern="[0-9]{11}" title="11 digit phone number" required=" ">
              </div>
              <div class=" mt-3">
                <input type="password" class="form-control" name="Password" id="password" placeholder="Password" required=" ">
              </div>
              <div class=" mt-3">
                <input type="password" class="form-control" name="CPassword" id="confirm-password" placeholder="Confirm Password" required=" ">
              </div>
              <div class="mt-4">
                <button type="submit" name="signupbutton" value="Register" class="btn btn-primary">Sign up</button>
              </div>
            </form>
          </div>
		  <?php
					echo $_SESSION['varerror'];
				?>
				</div>
        </div>
      </div>
    </div>
  </section>
  <!-- End Banner Area -->
</body>

</html>