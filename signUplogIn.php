<?php
	session_start();
	$_SESSION['temp'] = $email;
	$_SESSION['username_u'] = "";
	$_SESSION['password_p'] = "";
	$_SESSION['phone_n'] = "";

	require_once 'dbconnection.php';
	
	
	if(isset($_POST['submit']))
	{
		$firstname = $_POST['firstname'];
		$lastname = $_POST['surname'];
		$number = $_POST['number'];
		$email = $_POST['email'];
		$password = md5($_POST['password']);
		
		$stmt = $db->prepare("SELECT * FROM users WHERE email=:email_id");
		$stmt->execute(array(":email_id"=>$email));
		$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
		if($userRow>0)
		{
			header('location:reChoosEmail.php');
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
				header('location:regSuccessfull.php');	
			}
			
		}

	}
	else if(isset($_POST['login']))
	{
		$email = $_POST['email'];
		$password = $_POST['password'];
		$stmt = $db->prepare("SELECT * FROM users WHERE email=:email_id " );
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
			header('location:incorrectEmail&Password.php');
		}
	}	
?>  