<?php

	session_start();
	
	if (!isset($_SESSION['zalogowany']))
		{
			header('Location: historia.php');
			exit();
		}


	?>


<?php
  require 'header.html';
  ?>
		
		
		<div id="topbar">
	
	<a href="konto.php" button type="button" class="btn btn-primary  ">Wróć do profilu</button></a>  <br> <br>
	
	
	
	<?php
				echo "<p>Witaj ".$_SESSION['user'].'! [ <a href="wyloguj.php">Wyloguj się!</a> ]</p>';
	
	$napis = '<b>Twoja historia lotów: </b> <br>';
	Echo $napis ; 
		
	require_once "connect.php";



$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test";


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
$os = $_SESSION['id'];

$sql = <<<EOT
	select `przyloty/odloty`.przylot, `przyloty/odloty`.odlot,
	`przyloty/odloty`.odlot_t, `przyloty/odloty`.przylot_t, bilety.id
	from bilety
	inner join `przyloty/odloty` 
	on bilety.lot = `przyloty/odloty`.id 
	where bilety.user_id =
EOT;
 $sql = $sql . $os ;

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    
    while($row = $result->fetch_assoc()) {
        echo " Kupione bilety: ". $row["id"]. "   " . $row["przylot"]. "   " . $row["odlot"]. "    " . $row["przylot_t"]."    " . $row["odlot_t"]."<br>";
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