<?php	
session_start();
	if(isset($_POST['Login'])){
		$db = mysqli_connect('mars.cs.qc.cuny.edu', 'supr1424', '23371424', 'supr1424') or die("Cannot connect to server!");

		$email = $_POST['email'];
		$password = $_POST['password'];
		$password = md5($password);
		
		$qry = "SELECT * FROM appuser WHERE email='$email' AND pwd='$password'";
		$result = mysqli_query($db, $qry);
		
		if($result->num_rows > 0){
			$user = mysqli_fetch_assoc($result);
			if($user['user_type'] === "P"){
				//$id = $user['user_id'];
				$_SESSION['user_id'] = $user['user_id'];
				$_SESSION['uname'] = $user['login'];
				$_SESSION['email'] = $email;
				$_SESSION['success'] = "Logged in Successfully";
				header('location: professor.php'.$id);
			}else if($user['user_type'] === "S"){
				$id = $user['user_id'];
				$_SESSION['uname'] = $user['login'];
				$_SESSION['email'] = $email;
				$_SESSION['success'] = "Logged in Successfully";
				header('location: student.php?id='.$id);
			}
			
			
		}else{
			echo("Wrong email/Password combination. Please <a href='login.html'>try again </a>");
		}
		mysqli_close($db);
	}else if(isset($_POST['Signup'])){
		$db = mysqli_connect('mars.cs.qc.cuny.edu', 'supr1424', '23371424', 'supr1424') or die("Cannot connect to server!");
		
		$email = $_POST['email'];
		$error = array();
		$checkqry = "SELECT * FROM appuser WHERE email='$email' LIMIT 1";
		$result = mysqli_query($db, $checkqry);
		$user = mysqli_fetch_assoc($result);
		
		if($user){
			if($user['email']  === $email){
				echo("E-mail already exists. Please <a href='login.html'>try Logging in. </a>");
				array_push($error, "Email already exists");
			}
		}
		
		if(count($error == 0)){
				$fname = $_POST['fname'];
				$lname = $_POST['lname'];
				$uname = $_POST['uname'];
				$password = $_POST['password'];
				$usertype = $_POST['accounttype'];
				
				$password = md5($password);

				date_default_timezone_set("America/New_York");
				$date = date('Y-m-d h:i:s', time());
				echo($date." ".$usertype);
				$qry = "INSERT INTO appuser(login, pwd, first_name, last_name, email, user_type, date_enrolled) values('$uname', '$password', '$fname', '$lname', '$email', '$usertype', '$date');";
				mysqli_query($db, $qry) or die("Error registering.");
				header('location: login.html');
			
		}
		mysqli_close($db);
	}
?>