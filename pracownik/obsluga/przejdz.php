<?php

	session_start();
	
	if (!isset($_SESSION['zalogowany']))
		{
			header('Location: obsluga.php');
			exit();
		}
?>

<?php
  require 'header.html';
  ?>
		
		
		<div id="topbar">
		


		<b> Aby kupić bilet klietowi przejdz do strony głównej i zaloguj się na konto klienta. </b>
	


	<a href="wyloguj.php" button type="button" class="btn btn-primary btn-lg btn-block ">Przejdz do strony głównej</button></a> <br/><br/>
	
	
</div>
		
		

<?php
  require '../../end.html';
  ?>