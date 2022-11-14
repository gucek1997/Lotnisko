<?php

	session_start();
	
	if ((!isset($_SESSION['zalogowany'])) && ($_SESSION['udanarejestracja']))
	{
		header('Location: index.php');
		exit();
	}
	else
	{
		unset ($_SESSION['udanarejestracja']);
	}
?>


<!DOCTYPE html>
<html lang="pl">
<head>
<meta charset="utf-8"/>
<meta http-equiv="X-UA-Compatible" content="IE=edge	 	"/>
<title> Lotnisko </title>
</head>

<body>

   Dziękujemy za rejestrację w serwisie ! <br/> <br/>

	<a href="index.php"> Zaloguj się na swoje konto </a>
	<br/> <br/>
	
<form action="zaloguj.php" method="post">
	Login:<br/> <input type="text" name="login"> <br/>
	Hasło:<br/> <input type="password" name="haslo"> <br/><br/>
	<input type="submit" value= "Zaloguj" />
</form>


<?php
	if(isset($_SESSION['blad']))
		echo $_SESSION['blad'];
	

?>

</body>
</html>