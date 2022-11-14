<?php
  require 'header.html';
  ?>
		
		
		<div id="logowanie">
	

		
		
	<b> Loty wakacyjne do Aten, aby kupić bilet zaloguj się na swoje konto i kup bilet. </b><br/>
		
	<?php
	


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test";


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT id,przylot,odlot,odlot_t,przylot_t,klasa_1,klasa_2,klasa_3 FROM `przyloty/odloty` WHERE Przylot LIKE 'ATH'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    
    while($row = $result->fetch_assoc()) {
           echo  $row["przylot"]. "    " . $row["odlot"]."    " . $row["przylot_t"]."    " . $row["odlot_t"]. " Klasa 1 cena:  ". $row["klasa_1"]." Klasa 2 cena:  ". $row["klasa_2"]." Klasa 3 cena:  ". $row["klasa_3"]."<br>";
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