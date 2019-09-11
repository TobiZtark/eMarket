<?php
	session_start();
	require_once('class.user.php');
	$user_logout = new USER();
	
	setcookie("pounds", "", time() - 3600);
	
	if($user_logout->is_loggedin()!="")
	{
		$user_logout->redirect('index.php');
	}
	if(isset($_GET['logout']) && $_GET['logout']=="logout")
	{
		$user_logout->doLogout();
		$user_logout->redirect('index.php');
	}
	
	?>