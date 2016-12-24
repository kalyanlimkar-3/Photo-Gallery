<?php
	require_once("../includes/functions.php");
	require_once("../includes/database.php");
	//require_once("../includes/user.php");
	
	//$user = new User();
	$user = User::find_by_id(1);
	echo $user->full_name();
	
	echo "<hr/>";
	
	$users = User::find_all();
	foreach($users as $user) {
		echo $user->username . "<br/>";
		echo $user->full_name() . "<br/><br/>";
	}
?>