<?php

	session_start();
	
	if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true))
	{
		header('Location: index.php');
		exit();
	}

?>


<?php
  require_once 'header.html';
  ?>
		
		
<div id="pracownik">
		
<a href="kierownik/l_kierownik.php" button type="button" class="btn btn-primary btn-lg btn-block">Kierownik</button></a> <br/>
<a href="pilot/l_pilot.php" button type="button" class="btn btn-primary  btn-lg btn-block">Pilot</button></a> <br/>
<a href="obsluga/l_obsluga.php" button type="button" class="btn btn-primary  btn-lg btn-block">Obsługa lotniska</button></a> <br/>
<a href="ochrona/l_ochrona.php" button type="button" class="btn btn-primary  btn-lg btn-block">Ochrona lotniska</button> </a> <br/>
<a href="cleaner/l_cleaner.php" button type="button" class="btn btn-primary  btn-lg btn-block">Osoby sprzątające</button> </a> <br/>

		
</div>
		
	
	

	
	



<?php
  require_once '../end.html';
  ?>