<?php

	session_start();
	
	if (!isset($_SESSION['zalogowany']))
		{
			header('Location: kierownik.php');
			exit();
		}

	
	
	if (isset($_POST['email']))
	{
		
		$wszystko_ok=true;
		
		//imie
		$imie = $_POST['imie'];
		
			if ((strlen($imie)<2) || (strlen($imie)>15))
			{
			$wszystko_ok=false;
			$_SESSION['e_imie']="Błąd, imię musi posiadać od 3 do 15 znaków!";
			}
		
		//nazwisko
		$nazwisko = $_POST['Nazwisko'];
			if ((strlen($Nazwisko)<3) || (strlen($Nazwisko)>20))
			{
			$wszystko_ok=false;
			$_SESSION['e_Nazwisko']="Błąd, nazwisko musi posiadać od 3 do 20 znaków!";
			}
				
		// PESEL
		$pesel = $_POST['pesel'];
			if ((strlen($pesel)!=9) )
			{
			$wszystko_ok=false;
			$_SESSION['e_pesel']="Błąd,numer dowodu ma 9 cyfr !";
			}
		
		// login
		$user = $_POST['user'];
			if ((strlen($user)<3) || (strlen($user)>20))
			{
			$wszystko_ok=false;
			$_SESSION['e_login']="Błąd, nazwisko musi posiadać od 3 do 20 znaków!";
			}
		
				if (ctype_alnum($user)==false)
				{
				$wszystko_ok=false;
				$_SESSION['e_login']= "Login może składać się tylko z liter i cyfr(bez polskich znaków)";
				}
	
		//hasło
		$haslo1 = $_POST['haslo1'];
		$haslo2 = $_POST['haslo2'];
		
		if ((strlen ($haslo1)<8) || (strlen ($haslo1)>20))
		{
			$wszystko_ok=false;
			$_SESSION['e_haslo']= "Hasło musi posiadać od 8 do 20 znaków !";
		}
		
		if ($haslo1 != $haslo2)
			{
			$wszystko_ok=false;
			$_SESSION['e_haslo']= "Podane hasła muszą być identyczne !";
		}
		//haszowanie hasla
		
		$haslo_hash = password_hash($haslo1, PASSWORD_DEFAULT);
	
		// podwierdzenie
		if (!isset($_POST['potwierdzenie']))
		{
			$wszystko_ok=false;
			$_SESSION['e_regulamin']= "Potwierdź że chcesz dodać pracownika!";
			
		}
		
	
		//Zapamiętaj wprowadzone dane
		$_SESSION['fr_user'] = $user;
		$_SESSION['fr_imie'] = $imie;
		$_SESSION['fr_Nazwisko'] = $nazwisko;
		$_SESSION['fr_pesel'] = $pesel;
		$_SESSION['fr_kierownicy'] = $kierownicy;
		$_SESSION['fr_haslo1'] = $haslo1;
		$_SESSION['fr_haslo2'] = $haslo2;
		if (isset($_POST['regulamin'])) $_SESSION['fr_regulamin'] = true;
		
		
		
		require_once "logowanie/connect.php";
		mysqli_report(MYSQLI_REPORT_STRICT);
		
			
		try 
		{
			$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
			if ($polaczenie->connect_errno!=0)
			{
				throw new Exception(mysqli_connect_errno());
			}
			else
			{
				//Czy email już istnieje?
				$rezultat = $polaczenie->query("SELECT id FROM uzytkownicy WHERE email='$email'");
				
				if (!$rezultat) throw new Exception($polaczenie->error);
				
				$ile_takich_maili = $rezultat->num_rows;
				if($ile_takich_maili>0)
				{
					$wszystko_ok=false;
					$_SESSION['e_email']="Istnieje już konto przypisane do tego adresu e-mail!";
				}		

				
				//Czy login jest już zarezerwowany?
				$rezultat = $polaczenie->query("SELECT id FROM uzytkownicy WHERE user='$user'");
				
				if (!$rezultat) throw new Exception($polaczenie->error);
				
				$ile_takich_nickow = $rezultat->num_rows;
				if($ile_takich_nickow>0)
				{
					$wszystko_ok=false;
					$_SESSION['e_nick']="Istnieje już taki użytkownik.";
				}
				
				if ($wszystko_ok==true)
				{
					//dodawanie
					
					
					
					if ($polaczenie->query("INSERT INTO ". $_POST['optradio'] . "(id,imie,nazwisko,PESEL,Data_ur,Kierownicy_id,user,haslo_hash) VALUES (NULL, '$imie','$nazwisko','$pesel','$data','$Kierownicy_id','$user','$haslo_hash')"))
					{
						$_SESSION['udanarejestracja']=true;
						header('Location: witamy.php');
					}
					else
					{
						throw new Exception($polaczenie->error);
					}
					
				}
				
				$polaczenie->close();
			}
			
		}
		catch(Exception $e)
		{
			echo '<span style="color:red;">Błąd serwera! </span>';
		
		}
		
	}
	


  require 'header.html';
  ?>
		
		
	
		
	
 <div id="tekstrejestracja">  Dodaj pracownika: </div>
  
  
	<br/>
  
<div id="rejestracja">
		<form method = "post">
		<b> Po zakończonej pracy lub przy odejściu od komputera pamiętaj o wylogowaniu się z konta pracowniczego !! </b>
	<?php
	
	echo "<p>Witaj ".$_SESSION['user'].'! [ <a href="wyloguj.php">Wyloguj się!</a> ]</p>';
	?>
	
	<div class="form-group">	
	<label for="inputImie">Imię: </label>
	<input type="text" name="imie" value="<?php echo(isset($_SESSION['fr_imie'])?$_SESSION['fr_imie']:""); ?>" class="form-control" id="inputImie" /> <br/>
	<?php
		if (isset($_SESSION['e_imie']))
		{
		echo '<div class="error">'.$_SESSION['e_imie'].'</div>';
		unset($_SESSION['e_imie']);
		
		}
		?>
	</div>
	
	
	<div class="form-group">	
	<label for="inputImie">Nazwisko: </label>
	<input type="text" name="Nazwisko" value="<?php echo(isset($_SESSION['fr_Nazwisko'])?$_SESSION['fr_Nazwisko']:""); ?>" class="form-control" id="inputNazwisko" /> <br/>
	<?php
		if (isset($_SESSION['e_Nazwisko']))
		{
		echo '<div class="error">'.$_SESSION['e_Nazwisko'].'</div>';
		unset($_SESSION['e_Nazwisko']);
		
		}
		?>
	

	<div class="form-group">	
	<label for="inputImie">PESEL:  </label>
	<input type="text" name="pesel" value="<?php echo(isset($_SESSION['fr_pesel'])?$_SESSION['fr_pesel']:""); ?>" class="form-control" id="inputpesel" /> <br/>
		<?php
		if (isset($_SESSION['e_pesel']))
		{
		echo '<div class="error">'.$_SESSION['e_pesel'].'</div>';
		unset($_SESSION['e_pesel']);
		
		}
	?>
	<div class="form-group">	
	<label for="inputImie">Data urodzenia: (XXXX-XX-XX) </label>
	<input type="text" name="dowod" value="<?php echo(isset($_SESSION['fr_data'])?$_SESSION['fr_data']:""); ?>" class="form-control" id="input" /> <br/>
		<?php
		if (isset($_SESSION['e_dowod']))
		{
		echo '<div class="error">'.$_SESSION['e_dowod'].'</div>';
		unset($_SESSION['e_dowod']);
		
		}
	?>
	
	
	<div class="form-group">	
	<label for="inputImie">Kierownicy id: </label>
	<input type="text" name="kraj" value="<?php echo(isset($_SESSION['fr_kierownicy'])?$_SESSION['fr_kierownicy']:""); ?>" class="form-control" id="inputkierownicy" /> <br/>
	
	
	
	
	
	<div class="form-group">	
	<label for="inputImie">Login:  </label>
	<input type="text" name="user" value="<?php echo(isset($_SESSION['fr_user'])?$_SESSION['fr_user']:""); ?>" class="form-control" id="inputuser" /> <br/>
		<?php
		if (isset($_SESSION['e_user']))
		{
		echo '<div class="error">'.$_SESSION['e_user'].'</div>';
		unset($_SESSION['e_user']);
		
		}
	?>
	
	<div class="form-group">	
	<label for="inputhaslo1">Hasło:  </label>
	<input type="password" name="haslo1" value="<?php echo(isset($_SESSION['fr_haslo1'])?$_SESSION['fr_haslo1']:""); ?>" class="form-control" id="inputhaslo1" /> <br/> 
		<?php
		if (isset($_SESSION['e_haslo']))
		{
		echo '<div class="error">'.$_SESSION['e_haslo'].'</div>';
		unset($_SESSION['e_haslo']);
		
		}
	?>
	<div class="form-group">	
	<label for="inputhaslo2">Powtórz Hasło:  </label>
	<input type="password" name="haslo2" value="<?php echo(isset($_SESSION['fr_haslo2'])?$_SESSION['fr_haslo2']:""); ?>" class="form-control" id="inputhaslo2" /> <br/>
	


	
	<br/> 
	<br/> 

	</br>
		
	<div class="checkbox">
		<label><input type="checkbox" value="" name="regulamin"><b>Chcę dodać pracownika</b></label>
	</div>
	
	
	<?php
		if (isset($_SESSION['e_potwierdzenie']))
		{
		echo '<div class="error">'.$_SESSION['e_potwierdzenie'].'</div>';
		unset($_SESSION['e_potwierdzenie']);
		
		}
	?>
	<br/> <br/>
	
	<b> Wybierz grupę do której chcesz przypisać pracownika: <b/>
	<div class="radio">
  <label><input type="radio" name="optradio" value="kierownicy">Kierownik</label>
</div>

<div class="radio">
  <label><input type="radio" name="optradio"  value="ochrona">Ochrona lotniska</label>
</div>

	<div class="radio">
  <label><input type="radio" name="optradio" value="obsluga">Obsługa lotniska</label>
</div>

<div class="radio">
  <label><input type="radio" name="optradio" value="piloci">Pilot</label>
</div>

	<div class="radio">
  <label><input type="radio" name="optradio" value="cleaner">Obsługa sprzątająca</label>
</div
	
	<br/>
	<br/ > 
	<input type = "submit" value="Dodaj pracownika" class="btn btn-success .btn-lg" />
	</form>
	</div>
	


		


	

<?php
  require '../../end.html';
  ?>