<?php
	session_start();
	$_SESSION['temp'] = "";
	$_SESSION['username_u'] = "";
	$_SESSION['password_p'] = "";
	$_SESSION['phone_n'] = "";

	require_once 'dbconnection.php';
	$e = $_POST['email'];
	    $stmt1 = $db->prepare("SELECT * FROM users WHERE email=:email_id");
		$stmt1->execute(array(":email_id"=>$e));
		$userRow1=$stmt1->fetch(PDO::FETCH_ASSOC);
		if($userRow1>0)
		{
			echo "email already taken";
		}
		else
		{
			echo "";
		}



 if(isset($_POST['sign-up']))
 {
 	$firstname = $_POST['firstname'];
		$lastname = $_POST['surname'];
		$number = $_POST['number'];
		$email = $_POST['email'];
		$password = $_POST['password'];
	    $stmt1 = $db->prepare("SELECT * FROM users WHERE email=:email_id");
		$stmt1->execute(array(":email_id"=>$email));
		$userRow1=$stmt1->fetch(PDO::FETCH_ASSOC);
		if($userRow1>0)
		{
			echo "Email-Id Already exist! please signup with different one!";
		}
		else
		{

			$query = 'INSERT INTO users (username,surname,pnumber,email,password) VALUES(:username,:surname,:pnumber,:email,:password)';
			$query=$db->prepare($query);
			$query->execute([
				':username'=>$firstname,
				':surname'=>$lastname,			
				':pnumber'=>$number,
				':email'=>$email,
				':password'=>$password
				]);
			if($query){
				echo "registered succesfull";
			}

		}
 }

 if(isset($_POST['log-in']))
	{
		/*$email = $_POST['email'];
		$password = $_POST['password'];
		$stmt = $db->prepare("SELECT * FROM users WHERE email=:email_id");
		$stmt->execute(array(":email_id"=>$email));
		$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
		if(($userRow['email'] === $email)&&($userRow['password'] === $password))
		{
			$_SESSION['temp'] = $email;
			$_SESSION['user_id'] = $userRow['id'];
			$_SESSION['username'] = $userRow['username'];
			$_SESSION['password'] = $userRow['password'];
			$_SESSION['phone'] = $userRow['pnumber']; 
			header('location:todoHomeScreen.php');
		}
		else
		{
			echo "Enter your Email and password correctly";
		}*/
		echo "connected!";
	}	
?>  