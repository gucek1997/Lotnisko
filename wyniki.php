<? 

if (!$podstawaszukania || !$haslo)
{
	print "Nie zostało wpisane żadne hasło do wyszukiwarki";
	exit;
}
$podstawaszukania = addslashes($podstawaszukania);
$haslo = addslashes($haslo);
@ $db = mysql_pconnect("localhost", "root", "");
if (!db)
	{
		print "Wystąpił błąd w połączeniu";
		exit 
	}
mysql_select_db("lotnisko");
$query="Select odlot From przyloty/odloty Where nazwa Like '%{$_POST['podstawaszukania']}%' Or opis Like '%{$_POST['podstawaszukania']}%'";
$result = mysql_query($query);
$num_results = mysql_num_rows($result);

print "<p> Ilość dostępnych lotów: ".$num_results."</p>";
for ($i=0; $i <$num_results;i++)
{
	$row = mysql_fetch_array($result);
	print "aaa";
	
}





?>