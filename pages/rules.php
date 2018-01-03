<?php 
  session_start(); 

  if (!isset($_SESSION['email'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: sign-in.php');
  }
  if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['email']);
    header('location: sign-in.php');
  }
?>

<!DOCTYPE html>
<html>


<!-- navigator inladen -->
<?php include '../navigator.php' ?>

<script type="text/javascript">
    document.getElementById("nav-rules").classList.toggle('active');
</script>

    <section class="content">
	 <div class="container-fluid">
			 <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">	
					<div class="header">
                            <h1>
                                Spelregels
                            </h1>
							</div>
					 <div class="body">
					   <h3>Wedstrijden</h3>
					      <p> We gokken op 1 wedstrijd per dag (de leukste affiche, bij twijfel de wedstrijd ‘s avonds), dit zijn in totaal 23 wedstrijden.</p>
					<h3> Punten </h3>
					
					<p> Iedereen geeft voor aanvang van de wedstrijd zijn gok voor de einduitslag mee. Indien volledig juist: 3 punten, indien de winnaar of gelijkspel juist: 1 punt. De laatste 3 wedstrijden (de 2 halve finales en de finale) zijn dubbel zo belangrijk en daarvoor krijg je respectievelijk 6 en 2 punten. 
					De score die je indient is de score na 120'. Wanneer je een gelijkspel indient tijdens de knockoutfase, vul je in het vakje 'extra' ook de winnaar van de penalties in. De puntenverdeling is dan als volgt: je had het gelijkspel voor de penalties perfect juist: 3 punten, je hebt gelijkspel gegokt, maar geen exacte score: 1 punt, wanneer je de winnaar van de penalties ook nog eens juist hebt, komt bij beiden nog 1 punt bij. 
                    Indien er na puntenverdeling van alle wedstrijden een gelijkstand plaatsvindt zijn dit de volgende criteria waarop je positie bepaald wordt :
                                <ol>
                                <li>Aantal maal de score volledig correct tijdens het EK</li>
                                <li>Aantal punten behaald tijdens de voorbereiding</li>
                                <li>Aantal maal de score volledig correct tijdens de voorbereiding</li>
                                <li>Minuut van de eerste goal in de finale</li>             
                                </ol> </p>
								
				<h3> Gokken indienen </h3>
                <p> De gokken zullen worden ingediend met Google Forms (https://docs.google.com/…/1wKYJ2O7NW8F42kUyoJa7GWT…/viewform). Dit is anders als bij de vorige editie en kan omslachtiger lijken, maar heeft enkele voordelen:
				<ol> <li>Bij de laatste wedstrijden kunnen personen vanboven in het klassement hetzelfde gokken als personen net onder hun om ervoor te zorgen dat die hen niet meer kunnen inhalen, een anoniem systeem verhindert dit. Er zal wel voor gezorgd worden dat je op 1 of andere manier de scores van de andere personen tijdens/na de wedstrijd kan zien. </li>
				<li> Ik heb een script geschreven dat automatisch alle data ophaalt, de score per persoon berekent en een tussenstand bijhoudt, dit bespaart mij veel kopieerwerk van Facebook. </li>
				<li>Je zal je score steeds via dezelfde link indienen, als je het dus als bladwijzer in je browser of als shortcut op de homepage van je smartphone (zie foto in de groep) hebt staan gaat dit heel snel. </li>
				<li> Hoe minder je als student op Facebook zit, hoe beter :) </li>
				Nadeel: Er wordt uitgegaan van de eerlijkheid van de deelnemers. In theorie kan je gokken uitbrengen in de naam van iemand anders. Ik stel voor dat we dit niet doen, anders moet iedereen nog eens een persoonlijke code beginnen bijhouden... </ol> 
Noot:
<ul> <li> Je kan je gok zoveel aanpassen als je wilt (opnieuw indienen van die speeldag), enkel de laatst ingediende telt. </li>
<li> Er is een timecheck ingebouwd, je kan tot 1 seconde voor aanvang van de wedstrijd posten, als je na aanvang post, wordt je gok door het algoritme genegeerd. </li>
<li> Indien je geen internet hebt: je zal steeds kunnen gokken op een aantal wedstrijden op voorhand, en in het slechtste geval sms je naar Aaron of ik. </li> </ul>
</p>

				<h3> Bonussen </h3>

<p> Met de bonussen blijft het spannend tot op het einde. Vorige edities was er een absolute puntenverdeling voor de bonussen die uiteindelijk niet super bleek te zijn wegens te doorslaggevend in vergelijking met de daarvoor gehaalde punten. Dit jaar opteren we voor een relatieve verdeling. De bonussen wegen op zo’n manier door dat de personen die in het bovenste 1/3de van het klassement theoretisch gezien nog 1ste kunnen eindigen (indien alles juist, en alle personen boven zich, alles fout). Voor de start van het toernooi moet ik van iedereen een voorspelling hebben voor onderstaande gebeurtenissen (https://docs.google.com/…/1r0oPBjcNkf8ACdtYfMgQY-…/viewform…):

<ul> <li>  Wie wordt Europees kampioen? 40% van totaal aantal bonussen die zullen verdeeld worden </li>
     <li>  Wie is verliezend finalist? 20% </li>
<li> Waar eindigen de Belgen? 20% </li>
<li>  Wie wordt de vuilste ploeg? 10% </li>
<li> Wie wordt topschutter? 10% </li> </ul>
Als je finalist blijkt kampioen te worden en omgekeerd krijg je ook nog een aantal punten (15% indien 1 vd 2 juist, maar omgewisseld, 35% indien beiden juist maar plaats omgewisseld). </p>

<h3> Berekening bonussen </h3>
<p>
Vuilste ploeg:
<ul> <li> gele kaart = 1 punt </li>
<li> geel-geel = 2.5 punten </li>
<li> rode kaart = 3 punten </li>
<li> geel-rood = 4 punten </li> </ul>
Bij gelijkstand --> iedereen die een van de ploegen heeft ingevuld met het maximale aantal 'vuilepunten', krijgt de bonuspunten
</p> <p>
Topschutter:
<ul> <li> bij gelijkstand --> iedereen die een speler heeft ingevuld die met het maximale aantal goals eindigt, krijgt de bonuspunten </li> </ul>
</p> <p>
Positie België:
<ul> <li>
finale </li>
<li> halve finale </li>
<li> kwartfinale </li>
<li> 1/8ste finale </li>
<li>  groepsfase </li> </ul>
Je gokt het verst je denkt dat ze geraken. </p>

<h3> Inzet </h3>

<p> Iedereen bezorgt mij 10€ voor 10 juni. Om niet met te weinig geld te eindigen zoals in vorige edities schrijft iedereen dit over op:
<div class="row">
 <div class="col-lg-4 col-md-4 col-sm-8 col-xs-12">
                    <div class="info-box-4">
                       <div class="icon">
                            <i class="material-icons col-light-green">credit_card</i>
                        </div>
                        <div class="content">
                            <div class="text"><h4>Sam Wesemael</h4></div>
                            <div class="number">BE46 7805 9286 6336</div>
                        </div>
                    </div>
                </div>
				</div>
</p>

<h3> Winst </h3>

<ul> <li> 60% van de pot wordt onder iedereen verdeeld. Je krijgt een bedrag in verhouding met je aantal behaalde punten </li>
<li> 40% van de pot wordt uitsluitend verdeeld onder de top 3 (50% naar de winnaar, 33% naar de 2de en 17% naar de 3de. Alsook ontvangt de top 3 een mooie herinnering in de vorm van een certificaat/beker (nog te bepalen) </li>
</ul>	  

	  </div>
	   
    </section>

    <!-- Jquery Core Js -->
    <script src="../plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="../plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Select Plugin Js -->
    <script src="../plugins/bootstrap-select/js/bootstrap-select.js"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="../plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="../plugins/node-waves/waves.js"></script>

    <!-- Custom Js -->
    <script src="../js/admin.js"></script>

    <!-- Demo Js -->
    <script src="../js/demo.js"></script>
</body>

</html>