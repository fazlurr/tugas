<?php
	session_start();
	if(!isset($_SESSION['user_id'])){
		//User belum login
		header('Location: index.php');		
	}
?>