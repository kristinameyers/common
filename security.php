<?php
	if(isset($_COOKIE['email']) && isset($_COOKIE['pwd']) && !isset($_SESSION['LOGINDATA']['ISLOGIN'])) {
	} else
	if (!isset($_SESSION['LOGINDATA']['ISLOGIN'])) {
		header('location:'.ru); exit;
	} 
	
?>