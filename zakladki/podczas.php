<?php

	session_start();
	
	if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true))
	{
		header('Location: index.php');
		exit();
	}

?>


<?php
  require 'header.html';
  ?>
		
		
	<div class="container">
  <div class="jumbotron">
    <h1>Podczas lotu</h1> 
    <p>
	
	Uprzyjemnij sobie czas na pokładzie samolotów. Dbamy, aby w ofercie rozrywki pokładowej znalazły się filmy inspirowane kulturą krajów, do których latamy. <br/> 
	<img src="23.jpg" alt="samolot" height="250" width="350"> </br>
	Podczas lotu będzie można dokupić dodatkowe posiłki. Znajdą w nich Państwo bogactwo smaków skomponowane tylko ze świeżych składników - a wszystko to w bardzo przystępnych cenach!</br>
	<img src="jedzenie.jpg" alt="samolot" height="250" width="350"> </br>
Ceny towarów są podawane w polskich złotych (PLN). Płatność można zrealizować gotówką w złotych polskich oraz w euro, dolarach amerykańskich (z wyłączeniem bilonu)  i dolarach kanadyjskich
 (z wyłączeniem bilonu) lub za pomocą kart kredytowych. Maksymalna wartość jednorazowych zakupów dla kart: Visa, MasterCard, DinersClub, JCB International, American Express i 
 PolCard jest ograniczona do 4000 PLN. Limit dla kart Maestro to 50 PLN, płatność tylko metodą zbliżeniową. </br> </br>
 	<img src="karty.jpg" alt="samolot" height="250" width="350"> </br>
 Asortyment zależy od trasy i długości rejsu. Przepraszamy za ewentualne ograniczenia w wyborze pozycji z menu. Alkohol sprzedajemy pasażerom powyżej 18. roku życia. Spożywanie własnego alkoholu jest zabronione. 
	
	
	</p> 
  </div>

</div>
	
	

<?php
  require '../end.html';
  ?>