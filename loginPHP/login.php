<?php
	session_start();
	
	include 'db.php';
	
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
	}
	
	$_SESSION['varerror'] = " ";
	
	if(isset($_POST['loginbutton']))
	{
		$logEmail = $_POST['lusername'];
		$logPass = $_POST['lpassword'];
		
		$logQuery = "SELECT * FROM `users` WHERE username='".$logEmail."' AND password='".$logPass."'";
		
		$result = mysqli_query($conn ,$logQuery);
		
		$count = mysqli_num_rows($result);
		
		if($count == 1)
		{
			$_SESSION['username'] = $logEmail;
			$_SESSION['logged'] = "logged";
			header('Location: index.php');
		}
		else
		{
			header('Location: login.php?invalid=3');
		}
	}
	
	if(isset($_POST['signupbutton']))
	{
		$sFname = $_POST['FName'];
		$sLname = $_POST['LName'];
		$sUname = $_POST['Username'];
		$sEmail = $_POST['Email'];
		$sPass = $_POST['Password'];
		$sConfPass = $_POST['CPassword'];
		$sPhone = $_POST['Phone'];
		$sCom = $_POST['Company'];

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
			$saveSql = "INSERT INTO `users`(`username`,`fname`,`lname`,`company`,`email`,`password`,`date`,`phone`) VALUES('$sUname','$sFname','$sLname','$sCom','$sEmail','$sPass','$sDate','$sPhone')";
			$saveQuery = mysqli_query($conn,$saveSql);
			
			// $rewardssql = "INSERT INTO `rewards`(`username`,`rewards`,`date`) VALUES('$sUname','0','$sDate')";
			// $rewardssqlquery = mysqli_query($conn,$rewardssql);
			
			$_SESSION['username'] = $sUname;
			$_SESSION['logged'] = "logged";
			header('Location: index.php?created=1?');
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
<html>
<head>
<title>ComShop</title>
<link rel="shortcut icon" href="images/icons/shoplogo.png"/>
<!-- for-mobile-apps -->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Grocery Store Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
		function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- //for-mobile-apps -->
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<!-- font-awesome icons -->
<link href="css/font-awesome.css" rel="stylesheet" type="text/css" media="all" /> 
<!-- //font-awesome icons -->
<!-- js -->
<script src="js/jquery-1.11.1.min.js"></script>
<!-- //js -->
<link href='//fonts.googleapis.com/css?family=Ubuntu:400,300,300italic,400italic,500,500italic,700,700italic' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
<!-- start-smoth-scrolling -->
<script type="text/javascript" src="js/move-top.js"></script>
<script type="text/javascript" src="js/easing.js"></script>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		$(".scroll").click(function(event){		
			event.preventDefault();
			$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
		});
	});
</script>
<!-- start-smoth-scrolling -->
</head>
	
<body>
<!-- header -->
	<?php include 'topnav.php';?>
<!-- //header -->
<!-- products-breadcrumb -->
	<div class="products-breadcrumb">
		<div class="container">
			<ul>
				<li><i class="fa fa-home" aria-hidden="true"></i><a href="index.php">Home</a><span>|</span></li>
				<li>Sign In & Sign Up</li>
			</ul>
		</div>
	</div>
<!-- //products-breadcrumb -->
<!-- banner -->
	<div class="banner">
		
		<?php include 'sidenav.php';?>
		
		<div class="w3l_banner_nav_right">
<!-- login -->
		<div class="w3_login">
			<h3>Sign In & Sign Up</h3>
			<div class="w3_login_module">
				<div class="module form-module">
				  <div class="toggle"><i class="fa fa-times fa-pencil"></i>
					<div class="tooltip">Sign Up</div>
				  </div>
				  <div class="form">
					<h2>Login to your account</h2>
					<form method="post">
					  <input type="text" name="lusername" placeholder="Username" required=" ">
					  <input type="password" name="lpassword" placeholder="Password" required=" ">
					  <input type="submit" name="loginbutton" value="Login">
					</form>
				  </div>
				  <div class="form">
					<h2>Create an account</h2>
					<form method="post">
					  <input type="text" name="FName" placeholder="First Name" required=" ">
					  <input type="text" name="LName" placeholder="Last Name" required=" ">
					  <input type="text" name="Username" placeholder="Username" pattern="[A-Za-z0-9]+" title="Doest not meet standards" required=" ">
					  <input type="password" name="Password" placeholder="Password" required=" ">
					  <input type="password" name="CPassword" placeholder="Confirm Password" required=" ">
					  <input type="email" name="Email" placeholder="Email Address" required=" ">
					  <input type="text" name="Phone" placeholder="Phone Number" pattern="[0-9]{11}" title="11 digit phone number" required=" ">
					  <input type="text" name="Company" placeholder="Company/Business" required>
					  <input type="submit" name="signupbutton" value="Register">
					</form>
				  </div>
				<?php
					echo $_SESSION['varerror'];
				?>
				</div>
			</div>
			<script>
				$('.toggle').click(function(){
				  // Switches the Icon
				  $(this).children('i').toggleClass('fa-pencil');
				  // Switches the forms  
				  $('.form').animate({
					height: "toggle",
					'padding-top': 'toggle',
					'padding-bottom': 'toggle',
					opacity: "toggle"
				  }, "slow");
				});
			</script>
		</div>
<!-- //login -->
		</div>
		<div class="clearfix"></div>
	</div>
<!-- newsletter-top-serv-btm -->
	<div class="newsletter-top-serv-btm">
		<div class="container">
			<div class="col-md-4 wthree_news_top_serv_btm_grid">
				<div class="wthree_news_top_serv_btm_grid_icon">
					<i class="fa fa-shopping-cart" aria-hidden="true"></i>
				</div>
				<h3>Nam libero tempore</h3>
				<p>Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus 
					saepe eveniet ut et voluptates repudiandae sint et.</p>
			</div>
			<div class="col-md-4 wthree_news_top_serv_btm_grid">
				<div class="wthree_news_top_serv_btm_grid_icon">
					<i class="fa fa-bar-chart" aria-hidden="true"></i>
				</div>
				<h3>officiis debitis aut rerum</h3>
				<p>Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus 
					saepe eveniet ut et voluptates repudiandae sint et.</p>
			</div>
			<div class="col-md-4 wthree_news_top_serv_btm_grid">
				<div class="wthree_news_top_serv_btm_grid_icon">
					<i class="fa fa-truck" aria-hidden="true"></i>
				</div>
				<h3>eveniet ut et voluptates</h3>
				<p>Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus 
					saepe eveniet ut et voluptates repudiandae sint et.</p>
			</div>
			<div class="clearfix"> </div>
		</div>
	</div>
<!-- //newsletter-top-serv-btm -->
<!-- footer -->
	<?php include 'footer.php';?>
<!-- //footer -->
<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>
<script>
$(document).ready(function(){
    $(".dropdown").hover(            
        function() {
            $('.dropdown-menu', this).stop( true, true ).slideDown("fast");
            $(this).toggleClass('open');        
        },
        function() {
            $('.dropdown-menu', this).stop( true, true ).slideUp("fast");
            $(this).toggleClass('open');       
        }
    );
});
</script>
<!-- here stars scrolling icon -->
	<script type="text/javascript">
		$(document).ready(function() {				
			$().UItoTop({ easingType: 'easeOutQuart' });
								
			});
	</script>
	<script src="js/modal.js"></script>
<!-- //here ends scrolling icon -->
</body>
</html>