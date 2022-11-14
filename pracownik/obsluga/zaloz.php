<?php

	session_start();
	
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
		$Nazwisko = $_POST['Nazwisko'];
			if ((strlen($Nazwisko)<3) || (strlen($Nazwisko)>20))
			{
			$wszystko_ok=false;
			$_SESSION['e_Nazwisko']="Błąd, nazwisko musi posiadać od 3 do 20 znaków!";
			}
		// kraj pochodzenia
		$kraj = $_POST['kraj'];
			if ((strlen($kraj)<3) || (strlen($kraj)>40))
			{
			$wszystko_ok=false;
			$_SESSION['e_kraj']="Błąd, kraj pochodzenia musi posiadać od 3 do 40 znaków!";
			}
		// paszport
		$paszport = $_POST['paszport'];
			if ((strlen($paszport)!= 15))
			{
			$wszystko_ok=false;
			$_SESSION['e_paszport']="Błąd, Numer paszportu ma 15 cyfr !";
			}
		
		// dowod
		$dowod = $_POST['dowod'];
			if ((strlen($dowod)!=9) )
			{
			$wszystko_ok=false;
			$_SESSION['e_dowod']="Błąd,numer dowodu ma 9 cyfr !";
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
		// e-mail
		$email=$_POST['email'];
			$emailok = filter_var($email,FILTER_SANITIZE_EMAIL);
			if ((filter_var($emailok,FILTER_VALIDATE_EMAIL)==false) ||($emailok!=$email))
			{
				$wszystko_ok=false;
				$_SESSION['e_email']= "Podaj poprawny adres e-mail!";
			}
		//hasło
		$haslo1 = $_POST['haslo1'];
	
		
		if ((strlen ($haslo1)<8) || (strlen ($haslo1)>20))
		{
			$wszystko_ok=false;
			$_SESSION['e_haslo']= "Hasło musi posiadać od 8 do 20 znaków !";
		}
		
	
		//haszowanie hasla
		
		$haslo_hash = password_hash($haslo1, PASSWORD_DEFAULT);
	
	
		
				
		//Zapamiętaj wprowadzone dane
		$_SESSION['fr_user'] = $user;
		$_SESSION['fr_imie'] = $imie;
		$_SESSION['fr_Nazwisko'] = $Nazwisko;
		$_SESSION['fr_kraj'] = $kraj;
		$_SESSION['fr_dowod'] = $dowod;
		$_SESSION['fr_paszport'] = $paszport;
		$_SESSION['fr_email'] = $email;
		$_SESSION['fr_haslo1'] = $haslo1;
	
		
		
		
		require_once "connect.php";
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
					$_SESSION['e_nick']="Istnieje już użytkownik o takim nicku! Wybierz inny.";
				}
				
				if ($wszystko_ok==true)
				{
					//dodawanie
					
					if ($polaczenie->query("INSERT INTO uzytkownicy VALUES (NULL, '$user', '$haslo_hash', '$email', '$kraj','$imie','$Nazwisko','$dowod','$paszport')"))
					{
						$_SESSION['udanarejestracja']=true;
						header('Location: przejdz.php');
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
			echo '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności i prosimy o rejestrację w innym terminie!</span>';
		//	echo '<br />Informacja developerska: '.$e;
		}
		
	}
	
	
?>
  <?php
  require 'header.html';
  
  
  ?>

 <div id="tekstrejestracja">  Aby założyć konto klientowi, musi on najpierw pokazać ważny paszport oraz dowód osobisty  </div>
  
<div id="rejestracja">
		<form method = "post">
	
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
	<label for="inputImie">Kraj pochodzenia: </label>
	<input type="text" name="kraj" value="<?php echo(isset($_SESSION['fr_kraj'])?$_SESSION['fr_kraj']:""); ?>" class="form-control" id="inputkraj" /> <br/>
	<?php
		if (isset($_SESSION['e_kraj']))
		{
		echo '<div class="error">'.$_SESSION['e_kraj'].'</div>';
		unset($_SESSION['e_kraj']);
		
		}
	?>
	<div class="form-group">	
	<label for="inputImie">Numer paszportu:  </label>
	<input type="text" name="paszport" value="<?php echo(isset($_SESSION['fr_paszport'])?$_SESSION['fr_paszport']:""); ?>" class="form-control" id="inputpaszport" /> <br/>
		<?php
		if (isset($_SESSION['e_paszport']))
		{
		echo '<div class="error">'.$_SESSION['e_paszport'].'</div>';
		unset($_SESSION['e_paszport']);
		
		}
	?>
	<div class="form-group">	
	<label for="inputImie">Numer dowodu osobistego:  </label>
	<input type="text" name="dowod" value="<?php echo(isset($_SESSION['fr_dowod'])?$_SESSION['fr_dowod']:""); ?>" class="form-control" id="inputdowod" /> <br/>
		<?php
		if (isset($_SESSION['e_dowod']))
		{
		echo '<div class="error">'.$_SESSION['e_dowod'].'</div>';
		unset($_SESSION['e_dowod']);
		
		}
	?>
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
	<label for="inputhaslo2">E-mail:  </label>
	<input type="email" name="email" value="<?php echo(isset($_SESSION['fr_email'])?$_SESSION['fr_email']:""); ?>" class="form-control" id="email" /> 
	
		<?php
		if (isset($_SESSION['e_email']))
		{
		echo '<div class="error">'.$_SESSION['e_email'].'</div>';
		unset($_SESSION['e_email']);
		
		}
	?>
	

	
	<br/>
	<br/ > 
	<input type = "submit" value="Załóż konto" class="btn btn-success .btn-lg" />
	</form>
	</div>
	


<?php
  require 'end.html';
  ?>
  
  
