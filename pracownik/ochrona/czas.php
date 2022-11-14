<?php

	session_start();
	
	if (!isset($_SESSION['zalogowany']))
		{
			header('Location: czas.php');
			exit();
		}


	?>


<?php
  require 'header.html';
  ?>
		
		
		<div id="topbar">
	
	<?php
				echo "<p>Witaj ".$_SESSION['user'].'! [ <a href="wyloguj.php">Wyloguj się!</a> ]</p>';
		?>
	
	<b> Po zakończonej pracy lub przy odejściu od komputera pamiętaj o wylogowaniu się z konta pracowniczego !! <br/> </b>
		Twój czas pracy od poniedziałku do piątku: <br/>
	<?php
	


	
	require_once "connect.php";

	$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
	
if ($polaczenie->connect_error) {
    die("Connection failed: " . $polaczenie->connect_error);
} 


$sql = "SELECT id FROM ochrona WHERE user='".$_SESSION['user']."'";
$result = $polaczenie->query($sql);

if ($result->num_rows > 0) {
   
    while($row = $result->fetch_assoc()) {
      
		$nr_usera = $row["id"];
    }
} else {
    echo "Brak terminarza";
}

$sql = <<<EOT
	select czas_pracy.Czas_rozpoczecia, czas_pracy.Czas_zakonczenia 
	from ochrona_has_czas_pracy 
	inner join czas_pracy 
	on ochrona_has_czas_pracy.Czas_Pracy_id = czas_pracy.id 
	where ochrona_has_czas_pracy.Ochrona_id =
EOT;
	
$sql = $sql . "$nr_usera";
	
$result = $polaczenie->query($sql);

if ($result->num_rows > 0) {
   
    while($row = $result->fetch_assoc()) {
        echo " Godziny: " . $row["Czas_rozpoczecia"]." :: ". $row["Czas_zakonczenia"]."<br>";
    }
} else {
    echo "Brak terminarza";
}



$polaczenie->close();


	?>
	
	
</div>
		
	
<?	
  require '../../end.html';
  ?>