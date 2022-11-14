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
		
		<div class="container">
  <div class="jumbotron">
    <h1>Przed podróżą</h1> 
    <p>

<body data-spy="scroll" data-target="#myScrollspy" data-offset="20">

<div class="container">
  <div class="row">
    <nav class="col-sm-3" id="myScrollspy">
      <ul class="nav nav-pills nav-stacked">
        <li class="active"><a href="#section1">Przygotowanie do lotu</a></li>
        <li><a href="#section2">Bagaż</a></li>
        <li><a href="#section3">Opis klas lotu</a></li>
		 <li><a href="#section4">Informacje o odprawie</a></li>
        <li class="dropdown">
                              
          </ul>
        </li>
      </ul>
    </nav>
    <div class="col-sm-9">
      <div id="section1">    
        <h1>Przygotowanie do lotu</h1>
        <p>
		Przed rozpoczęciem prosimy o upewnienie się, czy mają Państwo odpowiednie dokumenty takie jak: ważny paszport, wizę (jeśli wymagana) lub inny dokument (jak dowód tożsamości),
		które upoważniają	do wjazdu na terytorium obcego kraju. Jeśli wybierają się Państwo do Stanów Zjednoczonych z polskim paszportem, prosimy pamiętać o konieczności posiadania
		wizy amerykańskiej. 
		<br/><br/>
		Jeżeli chcesz zabrać w podróż zwierzę domowe (kota lub psa) oferujemy Ci taką możliwość.
		Miejsce przewozu zwierzęcia - w kabinie pasażerskiej lub w luku bagażowym samolotu - uzależnione jest od jego wagi i wielkości.
		
		</p>
      </div>
      <div id="section2"> 
        <h1>Bagaż</h1>
        <p>
<b>W zależności od klasy podróży pasażerowie mogą zabrać ze sobą na pokład: </b> <br/>
-  Klasa 1 - 2 sztuki każda do 9 kg <br/>
-  Klasa 2 - 2 sztuki, w sumie do 9 kg (1 sztuka max. 5 kg) <br/>
-  Klasa 3 - 1 sztuka do 8 kg <br/>
Bagaż podręczny powinien zmieścić się w górnej półce na pokładzie lub pod poprzedzającym fotelem. <br/>

<b>Dodatkowo, w ramach ceny biletu, jako bagaż podręczny pasażer może zabrać ze sobą: </b> <br/>
-  torebkę damską lub torbę męską lub laptopa (wymiary 40 cm x 35 cm x 12 cm)<br/>
-  dla podróżujących z dziećmi - pokarm i składany wózek dla dziecka lub spacerówkę<br/>

<b>Osoby niepełnosprawne mogą zabrać ze sobą następujące przedmioty niezbędne w trakcie podróży: </b><br/>
wózek inwalidzki (wózek inwalidzki zostanie załadowany do bagażnika przed wejściem na pokład i zostanie zwrócony pasażerowi po wylądowaniu)<br/>
kule lub inny sprzęt medyczny do użytku osobistego


		
		</p>
      </div>        
      <div id="section3">         
        <h1>Opis klas lotu</h1>
        <p>
		<b> Klasa 1</b> <br/>
		Zawsze dbamy o Twoją satysfakcję i przyjemność, dlatego oferujemy 
		pyszne i wyjątkowe dania przyrządzone z pasją.
	Menu biznesowe komponowane jest tak, aby nie zbrakło w nim elementów tradycyjnych 
	oraz wpływów z kuchni międzynarodowej. <br/> <br/>
Na wszystkich połączeniach w klasie 1 przysługuje wyższy limit bagażowy:

Loty długodystansowe: 3 × 32 kg sztuki bagażu rejestrowanego.
Loty krótkodystansowe: 2 × 32 kg sztuki bagażu rejestrowanego.

Po wyłądowaniu, Twój bagaż będzie dostarczony w pierwszej kolejności.<br/>	
	
		<b> Klasa 2 </b> <br/>
		
		Menu  klasy 2 zostało przygotowane przez naszych najlepszych szefów kuchni,
		którzy przygotowują również posiłki do klasy 1! </br> </br>
		
		Na wszystkich połączeniach w klasie 2 przysługuje wyższy limit bagażowy:
		2 × 23 kg sztuki bagażu rejestrowanego. </br> </br>
		
		<b> Klasa 3 </b> <br/>
		Podczas lotów krótkodystansowych (do 6 godzin) oferujemy drobną przekąskę. <br/>
		Podczas lotów długodystansowych w klasie 1 zawsze skosztujesz smacznych i wyjątkowych dań. Możesz również dokupić smaczne dania będąc już na pokładzie samolotu. <br/>
		Podróżując w klasie ekonomicznej możesz zabrać ze sobą bagaż podręczny do 8 kg oraz bagaż rejestrowany do 23 kg. <br/>
		</p>
      </div>
      <div id="section4">         
        <h1>Informacje o odprawie</h1>
        <p>
		<b>Odprawa biletowo-bagażowa dla rejsów obsługiwanych uruchamiana jest na minimum:</b> <br/>
-  2 godziny przed rozkładową godziną odlotu do portów polskich 
 oraz pozostałych portów, z których realizowane są połączenia średniego zasięgu 
 (Europa, Bliski Wschód, Afryka Północna); </br>
-  3 godziny przed rozkładową godziną odlotu w przypadku 
rejsów do USA, Kanady i innych połączeń dalekiego zasięgu; </br> </br>

Ze względu na możliwe utrudnienia z infrastrukturą lotniskową  
prosimy o zwrócenie uwagi na możliwość wydłużonego czasu oczekiwania do kontroli bezpieczeństwa.  </br> </br>

Pasażerów o ograniczonej zdolności ruchowej używających sprzętu ułatwiającego poruszanie prosimy o 
uwzględnienie dłuższego czasu niezbędnego do przeprowadzenia kontroli bezpieczeństwa zarówno pasażera jak i tego sprzętu.
		</p>
      </div>      
       </div>
  </div>
</div>


	</p> 
  </div>
  
</div>
		
		
		
	
	
	

<?php
  require '../end.html';
  ?>