<?php

	session_start();
	
	if (!isset($_SESSION['zalogowany']))
		{
			header('Location: index.php');
			exit();
		}
?>


<?php
  require 'header.html';
  
  ?>
		
		<div id="rejestracja">
		
		
		
		
		
		<a href="historia.php" button type="button" class="btn btn-primary  ">Historia kupionych biletów</button></a>  <br> <br>


<?php
		$con= mysqli_connect ("localhost","root","","test");
		
		echo "<p>Witaj ".$_SESSION['user'].'! [ <a href="wyloguj.php">Wyloguj się!</a> ]</p>';
		
		if (isset ( $_SESSION['bilet_zakup']))
		{
			$bilet_zakup = $_SESSION['bilet_zakup'] ;
			$bilet_lot = $_SESSION['bilet_lot'] ;
			$bilet_klasa = $_SESSION['bilet_klasa'] ;
			
			$przylot = array();
			$odlot = array();
			$odlot_t = array();
			$przylot_t = array();
			$cena = array();
		
			for($i=0; $i<count($bilet_lot); $i++) 
			{	
				$sql = "SELECT id,przylot,odlot,odlot_t,przylot_t,klasa_1,klasa_2,klasa_3 FROM `przyloty/odloty` WHERE id=$bilet_lot[$i]";
				$result = mysqli_query($con,$sql)
					or die('Błąd w wyszukiwaniu lotów! Wybierz lotnisko z listy podanej poniżej');
				$num = mysqli_num_rows($result);
				if ( $num == 0 )
				{
					echo "Nie znaleziono pasujących.";
					exit;
				}
				if ($result->num_rows > 0) 
				{
					
					
					$numer = 0;
					while($row = $result->fetch_assoc())
					{
			
						$przylot[] = $row["przylot"];
						$odlot[] = $row["odlot"];
						$przylot_t[] = $row["przylot_t"];
						$odlot_t[] = $row["odlot_t"];
					
						$var = "klasa_" . $bilet_klasa[$numer++];
						$cena[] = $row[$var];		
		
					}
				}
		
			}
		for($i=0; $i<count($bilet_lot); $i++)
			echo "<br>Kupiłeś bilet do ". $przylot[$i] . " " . $przylot_t[$i] . " w klasa " . $bilet_klasa[$i] . " Z ". $odlot[$i] . " " . $odlot_t[$i]. " za " . $cena[$i] . " zł " ;
		
		
		};
		
		
		
	
		



	


$max_words = 1; 
$max_length = 20; 

// Konfiguracja 

if ( !isset($_POST['submit']) )
{
	$body = '
	<form action="konto.php" method="post">
	Wpisz nazwę lotniska do którego chcesz lecieć: <span style="color: Red; font-weight: bold; font-color: Black">*</span>
	<input type="post" name="fraza" class="form-control" style="width: 200px;" maxlength="'.$max_length.'"><br>
	<input type = "submit" name="submit" value="Szukaj" class="btn btn-success .btn-lg" />
	</form><br><br>
	<span style="color: Red; font-weight: bold;">*</span> - znak gwiazdki (<b>*</b>) pokazuje wszystkie loty które realizujemy </br></br>
		<b> Lotniska gdzie latamy: </b> </br>
		1) Kraków - <b>Balice</b> </br>
		2) Warszawa - <b>Okęcie</b> </br>
		3) Warszawa - <b>Modlin</b> </br>
		4) Katowice - <b>Pyrzowice</b> </br>
		5) Rzeszów - <b>Jasionka</b> </br>
		6) Wrocław - <b>Strachowice</b> <br/> ';
	
	
	
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


$kup1 = '<a href="kup.php?nr_lotu=';
$kup2a= '" type="submit" class="btn btn-primary"> Zarezerwuj bilet klasa 1 </a>';
$kup2b= '" type="submit" class="btn btn-success"> Zarezerwuj bilet klasa 2 </a>';
$kup2c= '" type="submit" class="btn btn-danger"> Zarezerwuj bilet klasa 3 </a>';

if ($result->num_rows > 0) {
    
    while($row = $result->fetch_assoc()) {
		
        echo "id: " . $row["id"]. " - Loty: <br> Do: ". $row["przylot"]. "    " . $row["przylot_t"]."  <br>  Z: "  . $row["odlot"]."   " . $row["odlot_t"]. 
		"<br> Klasa 1 cena:  ". $row["klasa_1"]." <br>Klasa 2 cena:  ". $row["klasa_2"]." <br> Klasa 3 cena:  ". $row["klasa_3"]." <br> ". 
		$kup1 . $row['id'] . '&klasa=1' . $kup2a. " " .
		$kup1 . $row['id'] . '&klasa=2' . $kup2b. " " .
		$kup1 . $row['id'] . '&klasa=3' . $kup2c . '<br>';
   
   }
} else {
    echo "0 results";
}




	}
}


  require 'end.html';
  ?>