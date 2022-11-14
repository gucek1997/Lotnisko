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

		<b> Po zakończonej pracy lub przy odejściu od komputera pamiętaj o wylogowaniu się z konta pracowniczego !! </b>
	
	<?php
	
	echo "<p>Witaj ".$_SESSION['user'].'! [ <a href="wyloguj.php">Wyloguj się!</a> ]</p>';
		
	?>

	<a href="czas.php" button type="button" class="btn btn-primary btn-lg btn-block ">Sprawdź czas pracy</button></a> <br/><br/>
		<a href="zaloz.php" button type="button" class="btn btn-primary btn-lg btn-block ">Załóż konto klientowi</button></a> <br/>
	
</div>
		
	
	
	
	

<?php
  require '../../end.html';
  ?>