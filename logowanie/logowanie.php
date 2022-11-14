<?php

	session_start();
	
	if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true))
	{
		header('Location: logowanie.php');
		exit();
	}

?>


<?php
  require 'header.html';
  ?>
		
		
		
	
	<br/> <br/>


<div id="logowanie">

<form action="zaloguj.php" method="post">
<div class="form-group">	
	<label for="inputImie">Login:  </label>
	<input type="text" name="login" class="form-control" /> <br/>

	<div class="form-group">	
	<label for="inputImie">Hasło:  </label>
	<input type="password" name="haslo" class="form-control" /> <br/>

<button type="submit" class="btn btn-primary active">Zaloguj się</button>
</form>



<?php
	if(isset($_SESSION['blad']))
		echo $_SESSION['blad'];
	

?>

		
		</div>

		</br></br></br></br></br></br></br></br></br>
		
		
		
<?php
  require_once '../end.html';
  ?>