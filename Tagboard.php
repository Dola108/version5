<!DOCTYPE html>
<html>
<head>
	<link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<?php
		session_start();
		include('connection.php');
		if (isset($_GET['val'])) {
			$val = $_GET["val"];
		}
		if (!empty($_SESSION['uname'])) {
			$uname = $_SESSION['uname'];
			$myQuery = "SELECT * FROM registration WHERE username='".$uname."'";
			$r=  mysqli_query($dbc, $myQuery);// or die($myQuery."<br/><br/>".mysql_error());
			$row = mysqli_fetch_array($r, MYSQLI_BOTH);
			$_SESSION['uname'] = $uname;
			$avatar = $row['avatar'];
		}
		else {
			//header('Location: homepage.php');
	      	// Immediately exit and send response to the client and do not go furthur in whatever script it is part of.
	      	if($_GET['val'] == 'Tags') {
	      		echo "<script> if (confirm('Browse as non-user?')) {
							} else {
							    window.location = 'homepage.php';
							} </script>";
			}
		}
	?>
	<link rel="stylesheet" type="text/css" href="dashboard.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>1Tag</title>
	<style type="text/css">
		.element, .outer-container {
		 	width: 750px;
			height: 1300px;
			margin-left: auto;
			margin-right: auto;
		}
		 
		.outer-container {
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
		li.lsa {
		    float: left;
		}

		li.lsa a {
		    display: block;
		    color: white;
		    text-align: center;
		    padding: 14px 30px;
		    text-decoration: none;
		    font-family: sans-serif;
		    font-size: 15.5px;
		}

		li.lsa a:hover {
		    color: #5DD35B;
		}
	</style>
</head>
<body style="background-image: url('jjj.jpg'); object-fit: cover;">
	<nav id="myHeader" style="margin-left: -9px; margin-right: -9px; margin-top: -8px; position: fixed; top: 8px; width: 100%;">
	    <ul class="ls">
	    	<?php
				if (!empty($row['avatar'])) {
					echo "<li class='ls'><img src='images/".$row['avatar']."' class='avatar' width='32px' onmouseover='focImg(this)' onmouseout='unfocImg(this)' style='margin-left: 15px; margin-top: 5px; border-width:2px; height:32px !important;'></li>";
				}
			?>
	    	
	    	<?php if (empty($uname)) {
		        	echo "<li class='lsa'><a href='homepage.php'>Homepage</a></li>";
		        } else {
		        	echo "<li class='lsa' id='pn'><a href='profile.php'>Profile</a></li>";
		        }
	        ?>
	        <li class="lsa"><a href="Dashboard.php">Dashboard</a></li>
	        <li class="lsa"><a href="" id="sr">Search</a></li>
	        <li class="lsa"><div id="div1" style="display: none; margin-top: 13px; margin-left: 5px; margin-right: 5px;"><form action="search.php" method="post"><input type="search" name="search" value="#" placeholder="Search Tags" pattern="#[A-Za-z0-9_]{2,50}"/><button type="submit">go</button></form></div></li>
	    <?php 
	    	include('formmodal.php');
	 		if (!empty($_SESSION['uname'])) {
	 			echo "<i class=\"fa fa-bell\" id=\"new\" style=\"float:right;margin-right:2%;margin-top: 12px;font-size:22px; color:#4caf50;cursor:pointer;\"></i>
					  <button type='button' id='logout' onclick='window.location=\"logout.php\"' class='button3' 
													   value='check' style='		
													   	   margin-right: 2%;
		        										   padding: 6px 16px;
		        										   font-size: 14px;
		        										   margin-top: 10px;'>Log out</button>";
		    	
	 		} else {
	 			echo "<button type='button' id='login' class='button3' 
													   value='check' style='		
													   	   margin-right: 5%;
		        										   padding: 6px 16px;
		        										   font-size: 14px;
		        										   margin-top: 10px;'>Log In</button>";
	 		}
	 	?>
	    </ul>
	</nav>
	<div style="position: absolute; float: left; margin-left: 5px; margin-top: 50px;">
		<?php 
			include('popular_tags.php');
		?>
	<p style="font-size: 14px;font-family: sans-serif;color: #eaeaea">@1Tag.com<br><br><a href="" style="color: dodgerblue;font-size: 12px;">Terms & conditions</a><br><a href="" style="color: dodgerblue;font-size: 12px;">RuleBook</a></p>
	</div>

	<div class="dash">
		<h1 style="font-family: Lucida Sans Typewriter;">Tagboard</h1>
	</div>
	<div class="shadow"></div>

	<div class="container">
		<p><br></p>
		<?php
				echo "<h3>".$val."</h3>";
		?><p id="demo"></p>
	</div>

	<div class="outer-container" style="margin-top: 150px;">
		<div class="inner-container">
			<div class="element">
				<?php include('tagposts.php');?>
				<br><br>
			</div>
		</div>
	</div>	
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
		    x.style.opacity = "0.7";
		}

		function unfocImg(x) {
		    x.style.opacity = "initial";
		}
	</script>

	<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

	<script type="text/javascript">
		var modal = document.getElementById('myModal');
		var modalreg = document.getElementById('myReg');
		var btn = document.getElementById("login");
		var span = document.getElementsByClassName("close")[0];
		var span1 = document.getElementsByClassName("close")[1];

		btn.onclick = function(event) {
			event.preventDefault();
		    modal.style.display = "block";
		}

		$('.message a').click(function(event){
			event.preventDefault();
			modal.style.display = "none";
			modalreg.style.display = "block";
		});

		span.onclick = function() {
		    modal.style.display = "none";
		}

		span1.onclick = function() {
		    modalreg.style.display = "none";
		}

		window.onclick = function(event) {
		    if (event.target.id == 'myModal') {
		        modal.style.display = "none";
		    }
		    if (event.target.id == 'myReg') {
		        modalreg.style.display = "none";
		    }
		}

		var check = function() {
		  if (document.getElementById('psw0').value ==
		    document.getElementById('pswcon').value) {
		    document.getElementById('message').style.color = 'green';
		    document.getElementById('message').innerHTML = '*matching';
		  } else {
		    document.getElementById('message').style.color = 'red';
		    document.getElementById('message').innerHTML = '*not matching';
		  }
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