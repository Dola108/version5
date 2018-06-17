<?php  
	include('connection.php');
	session_start();

    /*if (empty($_SESSION['uname'])) {
    	$_SESSION['uname'] = null;
    	echo ("{$_GET['uname']}"."<br/>"."{$_SESSION['uname']}");
    }*/
    if (isset($_GET['un']) && $_GET['un']!=$_SESSION['uname']) {
    	$uname = $_SESSION['uname'];
    	header('Location: otherusers.php?un='.$_GET['un']);
    }
    //if(empty($_COOKIE[$cookie_name])) {
	//    echo "<script> alert('Session Expired!!'); window.location = 'homepage.php'; </script>";
	//}
	
    else if (empty($_SESSION['uname'])) {
    	header('Location: homepage.php');
      	// Immediately exit and send response to the client and do not go furthur in whatever script it is part of.
      	exit();
    } else {
    	$uname = $_SESSION['uname'];

		/*if (empty($_SESSION['uname']) && empty($_GET['uname'])) {
	        header('Location: homepage.php');
	      	// Immediately exit and send response to the client and do not go furthur in whatever script it is part of.
	      	exit();
	    }*/


		//$uname=$_GET['uname'];
		$myQuery = "SELECT * FROM registration WHERE username='".$uname."'";
		$r=  mysqli_query($dbc, $myQuery);// or die($myQuery."<br/><br/>".mysqli_error($dbc));
		if (!$r) {
			echo "Error: failure. ERROR: ".mysqli_error($dbc);
			echo "Debugging errno: ".mysqli_errno($dbc).PHP_EOL;
			echo "Debugging error : ".mysqli_error($dbc).PHP_EOL;
			exit;
		}

		$row = mysqli_fetch_array($r, MYSQLI_BOTH);

		//echo $row['id'].PHP_EOL;
	//	echo $row['username'].PHP_EOL;
		//echo $row['avatar'].PHP_EOL;
		
		$_SESSION['uname'] = $uname;
		
		$mQuery = "SELECT * FROM post WHERE username='".$uname."'";
		$r2=  mysqli_query($dbc, $mQuery);//or die($myQuery."<br/><br/>".mysql_error());
		$row2 = mysqli_fetch_array($r2, MYSQLI_BOTH);
		$id = $row2['id'];
		$_SESSION['id'] = $id;
    }
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="theme.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>1Tag</title>
	<link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
	<style type="text/css">
		.element, .outer-container {
		 	width: 750px;
			height: 750px;
			margin-left: auto;
			margin-right: auto;
		}
		 
		.outer-container {
			margin-top: 120px;
			border: 5px transparent;
			position: relative;
			overflow: hidden;
			border-radius: 8px;
			background-color: rgba(0,0,0,0.4);
		}
		 
		.inner-container {
		 position: absolute;
		 left: 0;
		 overflow-x: hidden;
		 overflow-y: scroll;
		}
		 
		.inner-container::-webkit-scrollbar {
		 display: none;
		}
	</style>
</head>
<body style="min-width: 100%;background-color: #414141;">
	<nav id="myHeader">
	    <ul class="ls">
	        <li class="ls"><a href = "Dashboard.php" style="font-size: 15px !important;">Dashboard</a></li>
	        <li class="ls"><a href = "Tagboard.php?val=Tags" style="font-size: 15px !important;">Tags</a></li>
	        <li class="ls"><a href="" id="sr" ondblclick="document.getElementById('div1').style.display='none'" style="font-size: 15px !important;">Search</a></li>
	        <li class="ls"><div id="div1" style="display: none; margin-top: 13px; margin-left: 5px; margin-right: 5px;"><form action="search.php" method="post"><input type="search" name="users" value="@" placeholder="Search Others" pattern="@[A-Za-z0-9 _]{2,50}"/><button type="submit">go</button></form></div></li>
	        <li class="ls"><a href = "info.php" style="font-size: 15px !important;">Info</a></li>
			<i class="fa fa-bell" id="new" style="float:right;margin-right:2%;margin-top: 12px;font-size:22px; color:#4caf50;cursor:pointer;"></i>
	        <button type="button" id="logout" class="button3"  onclick="window.location.href = 'logout.php?val=1'" value="check" style="margin-right: 2%;
		padding: 6px 16px;
		font-size: 14px;margin-top: 10px;">Log out</button>
	    </ul>
	
	</nav>
	<div class="container-fluid">
		<div class="profile_container">
			<?php
				if (empty($row['avatar'])) {
					echo "<img src='blankavatar.png' class='avatar' onmouseover='focImg(this)' onmouseout='unfocImg(this)' >";
				}
				else {
					echo "<img src='images/".$row['avatar']."' class='avatar' onmouseover='focImg(this)' onmouseout='unfocImg(this)' >";
				}
			?>
			<?php
				echo "<h3 style=' width: 300px; word-wrap: break-word;'>". $uname."</h3>";
			?>
			<nav>
				<ul class="ls" style="background-color: rgba(0,0,0,0.4);">
			        <li class="ls" style="width: 100%; padding-bottom: 5px;"><a href="Dashboard.php">Write Post</a></li>
				</ul>
				<ul class="ls" style="background-color: rgba(0,0,0,0.4);">
					<li class="ls" style="width: 100%; padding-bottom: 5px;"><a href="#">Likes</a></li>
				</ul>
				<?php
					echo "<ul class=\"ls\" style=\"background-color: rgba(0,0,0,0.4);\">
						<li class=\"ls\" style=\"width: 100%; padding-bottom: 5px;\"><a href=\"Photos.php?un=".$uname."\">Photos</a></li>
					</ul>";
				?>
				<ul class="ls" style="background-color: rgba(0,0,0,0.4);">
			        <li class="ls" style="width: 100%; padding-bottom: 151%;"><a href="account.php">Account Settings</a></li>
				</ul>
			</nav>
		</div>
			
		<div class="post_container">
		<div class="outer-container">
			<div class="inner-container">
				<div class="element">
					<?php include('ownpost.php');?>
					<br><br><br><br><br>
				</div>
			</div>
		</div>	
		</div>
		<footer style="position: flex; margin-top: 68%; width: 98.9%;">1tag.com</footer>
	</div>
	<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
	<script type="text/javascript">
		var search = document.getElementById('sr');
		var click_count = 1;

		search.onclick = function(event) {
			event.preventDefault();
			click_count++;
			if (click_count%2==0) {
				document.getElementById('div1').style.display = "block";
			} else {
				document.getElementById('div1').style.display = "none";
			}
		}

		function focImg(x) {
		    x.style.opacity = "0.9";
		}

		function unfocImg(x) {
		    x.style.opacity = "initial";
		}

	</script>
	<script>
		$("#new").click(function(e) {
			e.preventDefault();
		    $(this).removeClass( "fa-bell");
		    $(this).addClass( "fa-bell-o");
		    $(this).css({"color":"#eaeaea"});
		});
	</script>
</body>
</html>