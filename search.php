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
		
		
		<div id="rejestracja">
		
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
	Wpisz nazwę lotniska do którego chcesz lecieć: <span style="color: Red; font-weight: bold; font-color: Black">*</span> <input type="post" name="fraza" style="width: 200px;" maxlength="'.$max_length.'"><br>
	<input type="submit" name="submit" value="Szukaj">
	</form><br>
	<span style="color: Red; font-weight: bold;">*</span> - znak gwiazdki (<b>*</b>) pokazuje wszystkie loty które realizujemy';
	
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
	$sql = "SELECT id,przylot,odlot,odlot_t,przylot_t,klasa_1,klasa_2,klasa_3 FROM przyloty/odloty WHERE przylot LIKE '".$search_words."'";
	$result = mysqli_query($con,"SELECT id,przylot,odlot,odlot_t,przylot_t,klasa_1,klasa_2,klasa_3 FROM `przyloty/odloty` WHERE przylot LIKE '".$search_words."'")
		or die('Błąd w wyszukiwaniu lotów! Wybierz lotnisko z listy podanej poniżej');
	$num = mysqli_num_rows($result);
	if ( $num == 0 )
	{
		echo "Nie znaleziono pasujących.";
		exit;
	}
	else
	{
$kup = '<a href="logowanie/logowanie.php" button type="button" class="btn btn-default">Aby kupić bilet, musisz najpierw się zalogować! </button></a>';
if ($result->num_rows > 0) {
    
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["id"]. " - Dostępne loty do : ". $row["przylot"]. "    " . $row["przylot_t"]." <br>  Z:  " . $row["odlot"]."    " . $row["odlot_t"]. "<br> Klasa 1 cena:  ". $row["klasa_1"]." <br>Klasa 2 cena:  ". $row["klasa_2"]."<br> Klasa 3 cena:  ". $row["klasa_3"]."<br> ". $kup."<br>";
   
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