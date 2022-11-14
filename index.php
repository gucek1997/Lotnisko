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
		
		
		<div id="topbar">
		
		

		
<b>Wyszukiwarka lotów </b> <br/> <br/>

<?php


$con= mysqli_connect ("localhost","root","","test");




$max_words = 1; 
$max_length = 20; 

// Konfiguracja 

if ( !isset($_POST['submit']) )
{
	$body = '
	<form action="search.php" method="post">
	<br/>
	<div class="form-group">
		<label for="usr">Wpisz nazwę lotniska do którego chcesz lecieć: </label>
		<input type="post" name="fraza" class="form-control" id="usr" style="width: 200px;" maxlength="'.$max_length.'">
	</div>
	<input type = "submit" name="submit" value="Szukaj" class="btn btn-success .btn-lg" />
	</form><br><br>
	<span style="color: Red; font-weight: bold;">*</span> - znak gwiazdki (<b>*</b>) pokazuje wszystkie loty które realizujemy </br></br>
		<b> Lotniska gdzie latamy: </b> </br>
		1) Kraków - <b>Balice</b> </br>
		2) Warszawa - <b>Okęcie</b> </br>
		3) Warszawa - <b>Modlin</b> </br>
		4) Katowice - <b>Pyrzowice</b> </br>
		5) Rzeczów - <b>Jasionka</b> </br>
		6) Wrocław - <b>Strachowice</b> <br/>
	
	
	
	
	';
	
	echo $body;
}
else
{
	$search_words = trim($_POST['fraza']);
	$search_words = mysqli_real_escape_string($con,$search_words);
	$count_words = substr_count($search_words, ' ');
	
	if ( ($count_words + 1) > ($max_words) )
	{
		echo "Użyłeś za wiele słów";
		exit;
	}
	
	$search_words = str_replace("*", "%", $search_words);
	
	//zapytanie
		
	$sql = "SELECT id,przylot,odlot,odlot_t,przylot_t FROM przyloty/odloty WHERE przylot LIKE '".$search_words."'";
	$result = mysqli_query($con,"SELECT id,przylot,odlot,odlot_t,przylot_t FROM `przyloty/odloty` WHERE przylot LIKE '".$search_words."'")
		or die('Błąd w wyszukiwaniu lotów! Wybierz lotnisko z listy podanej poniżej');
	$num = mysqli_num_rows($result);
	if ( $num == 0 )
	{
		echo "Nie znaleziono pasujących.";
		exit;
	}
	else
	{

if ($result->num_rows > 0) {
    
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["id"]. " - Loty: ". $row["przylot"]. "    " . $row["odlot"]."    " . $row["przylot_t"]."    " . $row["odlot_t"]."<br>";
    }
} else {
    echo "0 results";
}
	}
}

?>
		
	
	
	

<?php
  require 'end.html';
  ?>