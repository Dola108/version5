<?php  
	include('connection.php');
	session_start();

    if (empty($_SESSION['uname'])) {
    	header('Location: homepage.php');
      	exit();
    }
    
    $uname = $_SESSION['uname'];

	$myQuery = "SELECT * FROM registration WHERE username='".$uname."'";
	$r=  mysqli_query($dbc, $myQuery);// or die($myQuery."<br/><br/>".mysqli_error($dbc));
	if (!$r) {
		echo "Error: failure. ERROR: ".mysqli_error($dbc);
		echo "Debugging errno: ".mysqli_errno($dbc).PHP_EOL;
		echo "Debugging error : ".mysqli_error($dbc).PHP_EOL;
		exit;
	}

	$row = mysqli_fetch_array($r, MYSQLI_BOTH);
	$age = $row['age'];
	$email = $row['email'];
	$gender = $row['gender'];
	$_SESSION['uname'] = $uname;
?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo $uname; ?></title>
	<link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
	<link rel="stylesheet" type="text/css" href="dashboard.css">
	<style type="text/css">
		.avatar {
		    position: relative;
		    align-self: center;
		    margin-left: auto;
		    margin-right: auto;
		    object-fit: cover;
		    height: 130px;
		    max-width: 130px;
		    border-color: #4CAF50;
		    border-style: solid;
		    border-width: 5px;
		    border-radius: 50%;
		}
	</style>
</head>
<body style="background-image: url('5.jpg'); background-size: 220%; background-repeat: no-repeat;">
	<nav id="myHeader" style="margin-left: -9px; margin-right: -9px; margin-top: -8px; position: fixed; top: 8px; width: 100%;">
	    <ul class="ls">
	        <li class="ls"><a href="profile.php">Profile</a></li>
	        <li class="ls"><a href="Tagboard.php?val=Tags">Tags</a></li>
	        <li class="ls"><a href="Dashboard.php" id="searchbox">Dashboard</a></li>
	    </ul>
	<button type="button" id="logout" class="button3"  onclick="window.location.href = 'logout.php'" 
													   value="check" style="															        
													   	   margin-right: 5%;
		        										   padding: 6px 16px;
		        										   font-size: 14px;
		        										   margin-top: -3%;">Log out</button>
	</nav>

	<div class="dash">
		<h1>User Info</h1>
	</div>

	<div class="container">
		<p><br></p>
		<h2 style="text-align: center; margin-left:auto; margin-right:auto;">Info</h2>
		<div class="postbox">
			<br>
			<div>
				<?php
					if (empty($row['avatar'])) {
						echo "<img src='blankavatar.png' class='avatar'>";
					}
					else {
						echo "<img src='images/".$row['avatar']."' class='avatar'>";
					}
				?>
			</div>
			<label for="Username"><b style="font-family: Helvetica Neue; font-size: 18px; color: #acacac;">Username : </b></label>
				<?php echo "<b style='font-size: 18px; color:#eaeaea;'>".$uname."</b>"; ?><br>

			<label for="email"><b style="font-family: Helvetica Neue; font-size: 18px; color: #acacac;">Email : </b></label>
				<?php echo "<b style='font-size: 18px; color:#eaeaea;'>".$email."</b>"; ?><br>

			<label for="dtb"><b style="font-family: Helvetica Neue; font-size: 18px; color: #acacac;">Age : </b></label>
				<?php echo "<b style='font-size: 18px; color:#eaeaea;'>".$age."</b>"; ?><br>

			<label for="dtb"><b style="font-family: Helvetica Neue; font-size: 18px; color: #acacac;">Gender : </b></label>
				<?php echo "<b style='font-size: 18px; color:#eaeaea;'>".$gender."</b>"; ?><br>
		</div>
	</div>

	
	<footer>Copyright &copy; 1tag.com</footer>
</body>
</html>