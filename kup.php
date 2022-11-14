<?php

	session_start();
	
	if (!isset($_SESSION['zalogowany']))
		{
			header('Location: kup.php');
			exit();
		}

	
	// require 'header.html';
	require_once "connect.php";
		
	$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
	
	if ($polaczenie->connect_errno!=0)
		{
			echo "Error: ".$polaczenie->connect_errno;
		}
			
	$userid =  	$_SESSION['id'];
	$klasa = $_GET['klasa'];
	$lot = 	$_GET['nr_lotu'];
	
	$spr = sprintf("INSERT INTO bilety (id,user_id,klasa,lot) VALUES (Default,$userid,$klasa,$lot)");
	
	
	if ($rezultat = @$polaczenie->query($spr)) ;
	
	if(!isset($_SESSION['bilet_zakup']))
	{
		$_SESSION['bilet_lot'] = array();
		$_SESSION['bilet_klasa'] = array();
	}
	
	
	$_SESSION['bilet_zakup'] = true;
	$_SESSION['bilet_lot'][] = $lot;
	$_SESSION['bilet_klasa'][] = $klasa;
		
	
	
	header('Location: konto.php');
	
		
?>



		
		
		