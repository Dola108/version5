<?php
	session_start();
	include('connection.php');

	if(isset($_POST['edited'])) {
		$texts = $_POST['edited'];
		$id=$_POST['id'];
		mysqli_query($dbc, "UPDATE comment SET texts='$texts' WHERE id='".$id."'");
		echo "success";
		exit();
	}

	if(isset($_POST['delete'])) {
		$id=$_POST['delete'];

		function check_row($dbc, $lost_root) {
			$check = "SELECT * FROM comment WHERE c_id = '".$lost_root."'";
			$row=  mysqli_query($dbc, $check);
			$num_row = mysqli_num_rows($row);

		    while($num_row!=0) {
		    	$rw = mysqli_fetch_array($row, MYSQLI_BOTH);
		    	$del = "DELETE FROM comment WHERE id = '".$rw['id']."'";
		    	mysqli_query($dbc, "DELETE FROM likes WHERE c_id = '".$rw['id']."'");
		    	mysqli_query($dbc, $del);
		    	check_row($dbc, $rw['id']);
		    	$num_row--;
		    }
		}

		mysqli_query($dbc, "DELETE FROM comment WHERE id='".$id."'");
		mysqli_query($dbc, "DELETE FROM likes WHERE c_id='".$id."'");
		check_row($dbc, $id);

		//mysqli_query($dbc, "DELETE FROM comment WHERE c_id='".$id."'");
		//a 2 degree nested loop and for each cid it will check if id exists and if not delete and icr;
		//search for id,if not found delete - loop
		echo "success";
		exit();
	}

	if(isset($_POST['liked'])) {
		$id=$_POST['liked'];
		$uname=$_SESSION['uname'];
		$i=1;
		$status="liked";
		mysqli_query($dbc, "INSERT INTO likes (username, count, c_id, checked) VALUES ('$uname', '$i', '$id', '$status')") or die();
		mysqli_query($dbc, "UPDATE comment SET likes=likes+1 WHERE id='".$id."'");
		$likes = mysqli_query($dbc, "SELECT likes FROM comment WHERE id='".$id."'");
		while($row = mysqli_fetch_array($likes)) {
		    $nums = $row['likes'];
		}
		echo $nums;
		exit();
	}

	if(isset($_POST['disliked'])) {
		$id=$_POST['disliked'];
		$uname=$_SESSION['uname'];
		$status="disliked";
		$i=-1;
		mysqli_query($dbc, "INSERT INTO likes (username, count, c_id, checked) VALUES ('$uname', '$i', '$id', '$status')") or die();
		mysqli_query($dbc, "UPDATE comment SET likes=likes-1 WHERE id='".$id."'");
		$likes = mysqli_query($dbc, "SELECT likes FROM comment WHERE id='".$id."'");
		while($row = mysqli_fetch_array($likes)) {
		    $nums = $row['likes'];
		}
		echo $nums;
		exit();
	}

	if(isset($_POST['unliked'])) {
		$id=$_POST['unliked'];
		$uname=$_SESSION['uname'];
		mysqli_query($dbc, "DELETE FROM likes WHERE c_id='".$id."' AND username='".$uname."'") or die();
		mysqli_query($dbc, "UPDATE comment SET likes=likes-1 WHERE id='".$id."'");
		$likes = mysqli_query($dbc, "SELECT likes FROM comment WHERE id='".$id."'");
		while($row = mysqli_fetch_array($likes)) {
		    $nums = $row['likes'];
		}
		echo $nums;
		exit();
	}

	if(isset($_POST['undliked'])) {
		$id=$_POST['undliked'];
		$uname=$_SESSION['uname'];
		mysqli_query($dbc, "DELETE FROM likes WHERE c_id='".$id."' AND username='".$uname."'") or die();
		mysqli_query($dbc, "UPDATE comment SET likes=likes+1 WHERE id='".$id."'");
		$likes = mysqli_query($dbc, "SELECT likes FROM comment WHERE id='".$id."'");
		while($row = mysqli_fetch_array($likes)) {
		    $nums = $row['likes'];
		}
		echo $nums;
		exit();
	}
	//if(isset($_POST['id'])) {
	//	$id = $_POST['id'];
	//	$reply = $_POST['reply'];
	//	$uname = $_SESSION['uname'];
	//	mysqli_query($dbc, "INSERT INTO replies(username, texts, c_id) VALUES('$uname', '$reply', '$id')");
	//	$myQuery = "SELECT * FROM replies WHERE c_id='".$id."'";
	//	$ro=  mysqli_query($dbc, $myQuery);//or die($myQuery."<br/><br/>".mysql_error());
	//	$num_row = mysqli_num_rows($ro);
	//	echo $num_row;
	//	exit();
	//}

	//if(isset($_POST['reid'])) {
	//	$id=$_POST['reid'];
	//	$texts = $_POST['editreply'];
	//	mysqli_query($dbc, "UPDATE replies SET texts='$texts' WHERE id='".$id."'");
	//	echo "success";
	//	exit();
	//}

	//if(isset($_POST['deletereply'])) {
	//	$id=$_POST['deletereply'];
	//	mysqli_query($dbc, "DELETE FROM replies WHERE id='".$id."'");
	//	echo "success";
	//	exit();
	//}
?>