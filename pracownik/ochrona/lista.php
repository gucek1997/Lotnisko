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
		
		
		<div id="logowanie">
	
	<?php
				echo "<p>Witaj ".$_SESSION['user'].'! [ <a href="wyloguj.php">Wyloguj się!</a> ]</p>';
		?>
	
	<b> Po zakończonej pracy lub przy odejściu od komputera pamiętaj o wylogowaniu się z konta pracowniczego !! <br/> </b>
		<br/>
		
		
		<br/>
	<b>	Dane użytkowników: </b><br/>
		
	<?php
	


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test";


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT id, imie, nazwisko, dowod, paszport,kraj FROM uzytkownicy ORDER BY id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["id"]. " - Dane użykownicków: " . $row["imie"]. "   " . $row["nazwisko"]. "    " . $row["kraj"]."    " . $row["dowod"]."    " . $row["paszport"]."<br>";
    }
} else {
    echo "0 results";
}
$conn->close();


   
        




	?>
	
	
	
</div>
		
	
<?	
  require '../../end.html';
  ?>