<?php
	session_start();
	include('connection.php');

	//if(isset($_POST['edited'])) {
	//	$texts = $_POST['edited'];
	//	//$tag = $_POST['tag'];
	//	$id=$_POST['id'];
	//	mysqli_query($dbc, "UPDATE post SET post='$texts' WHERE id='".$id."'");
	//	echo "success";
	//	exit();
	//}

	if(isset($_POST['delete'])) {
		$id=$_POST['delete'];
		mysqli_query($dbc, "DELETE FROM post WHERE id='".$id."'");

		function check_row($dbc, $lost_root) {
			$check = "SELECT * FROM comment WHERE c_id = '".$lost_root."'";
			$row=  mysqli_query($dbc, $check);
			$num_row = mysqli_num_rows($row);

		    while($num_row!=0) {
		    	$rw = mysqli_fetch_array($row, MYSQLI_BOTH);
		    	$del = "DELETE FROM comment WHERE id = '".$rw['id']."'";
		    	mysqli_query($dbc, $del);
		    	mysqli_query($dbc, "DELETE FROM likes WHERE c_id = '".$rw['id']."'");
		    	check_row($dbc, $rw['id']);
		    	$num_row--;
		    }
		}

		mysqli_query($dbc, "DELETE FROM comment WHERE id='".$id."'");
		mysqli_query($dbc, "DELETE FROM likes WHERE c_id='".$id."'");
		mysqli_query($dbc, "DELETE FROM flags WHERE c_id='".$id."'");
		check_row($dbc, $id);
		echo "success";
		exit();
	}

	if(isset($_POST['liked'])) {
		$id=$_POST['liked'];
		$uname=$_SESSION['uname'];
		$i=1;
		$status="liked";
		mysqli_query($dbc, "INSERT INTO likes (username, count, c_id, checked) VALUES ('$uname', '$i', '$id', '$status')") or die();
		mysqli_query($dbc, "UPDATE post SET likes=likes+1 WHERE id='".$id."'");
		$q = "INSERT INTO `notifications` (receiver, title, c_id, sender) VALUES ((SELECT username FROM `registration` WHERE username=(SELECT username FROM `post` WHERE id='$id')), 'liked', '$id', '$uname')";
		mysqli_query($dbc, $q);
		$likes = mysqli_query($dbc, "SELECT likes FROM post WHERE id='".$id."'");
		while($row = mysqli_fetch_array($likes)) {
		    $nums = $row['likes'];
		}
		echo $nums;
		exit();
	}

	if(isset($_POST['disliked'])) {
		$id=$_POST['disliked'];
		$uname=$_SESSION['uname'];
		$i=-1;
		$status="disliked";
		mysqli_query($dbc, "INSERT INTO likes (username, count, c_id, checked) VALUES ('$uname', '$i', '$id', '$status')") or die();
		mysqli_query($dbc, "UPDATE post SET likes=likes-1 WHERE id='".$id."'");
		$q = "INSERT INTO `notifications` (receiver, title, c_id, sender) VALUES ((SELECT username FROM `registration` WHERE username=(SELECT username FROM `post` WHERE id='$id')), 'disliked', '$id', '$uname')";
		mysqli_query($dbc, $q);
		$likes = mysqli_query($dbc, "SELECT likes FROM post WHERE id='".$id."'");
		while($row = mysqli_fetch_array($likes)) {
		    $nums = $row['likes'];
		}
		echo $nums;
		exit();
	}

	if(isset($_POST['unliked'])) {
		$id=$_POST['unliked'];
		$uname=$_SESSION['uname'];
		$title="liked";
		mysqli_query($dbc, "DELETE FROM likes WHERE c_id='".$id."' AND username='".$uname."'") or die();
		mysqli_query($dbc, "UPDATE post SET likes=likes-1 WHERE id='".$id."'");
		$q = "DELETE FROM `notifications` WHERE c_id='".$id."' AND sender='".$uname."' AND title='".$title."'" or die();
		mysqli_query($dbc, $q);
		$likes = mysqli_query($dbc, "SELECT likes FROM post WHERE id='".$id."'");
		while($row = mysqli_fetch_array($likes)) {
		    $nums = $row['likes'];
		}
		echo $nums;
		exit();
	}

	if(isset($_POST['undliked'])) {
		$id=$_POST['undliked'];
		$uname=$_SESSION['uname'];
		$title="disliked";
		mysqli_query($dbc, "DELETE FROM likes WHERE c_id='".$id."' AND username='".$uname."'") or die();
		mysqli_query($dbc, "UPDATE post SET likes=likes+1 WHERE id='".$id."'");
		$q = "DELETE FROM `notifications` WHERE c_id='".$id."' AND sender='".$uname."' AND title='".$title."'" or die();
		mysqli_query($dbc, $q);
		$likes = mysqli_query($dbc, "SELECT likes FROM post WHERE id='".$id."'");
		while($row = mysqli_fetch_array($likes)) {
		    $nums = $row['likes'];
		}
		echo $nums;
		exit();
	}

	if(isset($_POST['flag'])) {
		$id=$_POST['flag'];
		$uname=$_SESSION['uname'];
		$title=$_POST['title'];
		$nums=0;
		mysqli_query($dbc, "INSERT INTO flags (username, c_id, title) VALUES ('$uname', '$id', '$title')") or die();
		$flags = mysqli_query($dbc, "SELECT * FROM flags WHERE c_id='".$id."'");
		while($row = mysqli_fetch_array($flags)) {
		    $nums++;
		}
		echo $nums;
		exit();
	}
	if(isset($_POST['flagdel'])) {
		$id=$_POST['flagdel'];
		mysqli_query($dbc, "DELETE FROM flags WHERE id='".$id."'");
		echo "success";
		exit();
	}

	if (isset($_POST['uid'])) {
		$id=$_POST['uid'];
		$title=$_POST['title'];
		$uname=$_SESSION['uname'];
		$nums=0;
		$query = "INSERT INTO reqs (username, parent_id, title) VALUES ('$uname', '$id', '$title')";
		mysqli_query($dbc, $query) or die($query.mysqli_error($dbc));
		echo "success";
		exit();
	}

?>