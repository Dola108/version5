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
	$id = $row['id'];
	$gender = $row['gender'];
	$_SESSION['uname'] = $uname;
?>
<!DOCTYPE html>
<html>
<head>
	<title>Settings</title>
	<link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
	<link rel="stylesheet" type="text/css" href="dashboard.css">
	<link rel="stylesheet" type="text/css" href="theme.css">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<style type="text/css">
		.field {
			position: absolute;
			vertical-align: middle;
			margin-left: 20%;
			margin-right: auto;
		    width: 60%; /* Full width */
		    height: 70%; /* Full height *//* Enable scroll if needed */
		    background-color: rgb(0,0,0); /* Fallback color */
		    background-color: rgba(0,0,0,0.7); /* Black w/ opacity */
		}
		label.del a {
			text-decoration: none;
			font-size: 18px;
			position: absolute;
			font-family: Helvetica Neue;
			color: #acacac;
		}
		label.del a:hover {
			color: white;
		}
	</style>
</head>
<body style="background-image: url('jjj.jpg');">
	<nav id="myHeader" style="margin-left: -9px; margin-right: -9px; margin-top: -8px; position: fixed; top: 8px; width: 100%;">
	    <ul class="ls">
	        <li class="ls"><a href="profile.php" style="font-size: 15px;">Profile</a></li>
	        <li class="ls"><a href="Tagboard.php?val=Tags" style="font-size: 15px;">Tags</a></li>
	        <li class="ls"><a href="#" id="searchbox" style="font-size: 15px;">Search</a></li>
	        <li class="ls"><a href="#" style="font-size: 15px;">Others</a></li>
	    </ul>
	<button type="button" id="logout" class="button3"  onclick="window.location.href = 'logout.php'" 
													   value="check" style="															        
													   	   margin-right: 5%;
		        										   padding: 6px 16px;
		        										   font-size: 14px;
		        										   margin-top: -3%;">Log out</button>
	</nav>

	<div class="dash">
		<h1  style="font-size: 44px;"><?php echo $uname; ?></h1>
	</div>

	<div class="container" style="height: 140%;">
		<p><br></p>
		<h2 style="text-align: center; margin-left:auto; margin-right:auto;">Change Profile Info</h2>
			<div class="field">
				<form class="modal-content" style="background-color: transparent;" action="edit.php" enctype="multipart/form-data" method="post">
				    <div style="background-color: transparent; margin-left: 50px; margin-top: -10px; margin-right: 0; margin-bottom: 0; width: 400px;">
				      <p style="font-family: Helvetica Neue; font-size: 30px; color: #acacac;">Edit Info.</p>
				      <hr>
				      <label for="avatar"><b style="font-family: Helvetica Neue; color: #acacac;">Change Avatar : </b></label><br>
				      <input type="file" name="avatar" id="avatar" accept="image/*" style="margin-top: 12px; margin-bottom: 18px; color: #eaeaea;">
				      <br><label style="color: red; font-size: 14px;">Not submitting any photo will change to default avatar!</label><br>

			    	<div class="clearfix" style="margin-top: 10px;">
			    	  <button type="button" id="cancel"  onclick="window.location.href = 'profile.php'" class="button3" style="margin-right: 5%; 
					    background-color: #333;
					    padding: 6px 16px;
					    font-size: 14px;">Cancel</button>
			    	  <button type="submit" class="button2" id="ch" style=" padding:6px 16px; font-size: 14px;" name="edit" value="submit">Save Changes</button>
			    	</div> 
		        </form>
		    	<br><label for="delt" class="del"><a href="" id="del" style="font-size: 20px;">Delete Account</a></label><br><br>
	    	<label class="qe" style="display: none;"><b style="font-family: Helvetica Neue; color: #acacac;font-size: 18px;font-family: sans-serif;">Tell us why? </b>
    		<div style="background-color: #333;padding: 5px 5px;border-radius: 5px;margin-top: 10px;">
    			<br>
			  <div class="radio">
<label style="font-size: 16px;font-family: sans-serif;color: #eaeaea;"><input type="radio" name="optradio" class="msg" value="1" />I don't want to use</label><br><br>
<label style="font-size: 16px;font-family: sans-serif;color: #eaeaea;"><input type="radio" name="optradio" class="msg" value="2" />I don't feel safe</label><br><br>
<label style="font-size: 16px;font-family: sans-serif;color: #eaeaea;"><input type="radio" name="optradio" class="msg" value="3" />I don't like this website</label><br><br>
<label style="font-size: 16px;font-family: sans-serif;color: #eaeaea;"><input type="radio" name="optradio" class="msg" value="4" />I spend too much time here</label><br><br>
<label style="font-size: 16px;font-family: sans-serif;color: #eaeaea;"><input type="radio" name="optradio" class="msg" value="5" />I want to change the account</label><br><br>
			  </div><button class="button2" id="radiob" style="background-color: #e1e1e1; color: black; padding:6px 16px; font-size: 14px;margin-top: -30px;">Confirm</button>
    		</div>
	  		</label>
		</div>
		</div>
	</div>
	<footer style="margin-top:62%;">Copyright &copy; 1tag.com</footer>
	<script type="text/javascript">
		var del = document.getElementById('del');
		var userid = <?php echo $id;?>;
		$(".del").click(function(event) {
			event.preventDefault();
			if (confirm('Delete Account?')==true) {
				$(".qe").show();
		    	$("#radiob").click(function(e) {
			    	e.preventDefault();
			    	var title;
					var n = $('input[name=optradio]:checked').val(); 
					if (n==1) {
						title = "I do not want to use";
					} else if(n==2) {
						title = "I do not feel safe";
					} else if(n==3) {
						title = "I do not like this website";
					} else if(n==4) {
						title = "I spend too much time here";
					} else if(n==5) {
						title = "I want to change the account";
					}

					$.ajax ({
			    	  type:'post',
			    	  url:'editpost.php',
			    	  data:{
			    	      uid: userid,
			    	      title: title
			    	  },
					  success:function(data)
					  {
					   $(".del").html("<a href='#' id='del' style='color:red;'>Delete Request Sent.</a><p>You will shortly recieve a mail.</p>");
					   $(".qe").hide();
					   setTimeout(function(){window.location.href = 'logout.php'},30000);
					  }
		    		});
		    	});
		    } else {
		      event.preventDefault();
		    }
		});
	</script>
</body>
</html>