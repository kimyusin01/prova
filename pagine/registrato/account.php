<?php
define ("USERNAME", "username");
if(!empty( $_SESSION ))
{
	$codiceRuolo=$_SESSION["codice"];
	
	switch($codiceRuolo)
	{
		case 1:stampaPaginaAmministratore();break;
		case 2:stampaPaginaComune(); break;
		case 3:stampaPaginaEnte(); break;
		case 4:stampaPaginaGruppoDiLavoro(); break;
		case 5:stampaPaginaUtente(); break;	
		default:break;
		
	}
}








function stampaPaginaAmministratore()
{
	echo '	
				<!--main-->
				<section id="four" class="wrapper style1 special fade-up">
					<div class="container">
						<header class="major">
							<h2>Benvenuto ';  echo $_SESSION[USERNAME];echo'</h2>
							<p>Queste sono le attività che puoi svolgere</p>
						</header>
						<div class="box alt">
							<div class="row gtr-uniform">
								<section class="col-4 col-6-medium col-12-xsmall">
									<span class="icon alt major fas fa-user-plus"><webicon icon="fa:user-plus"/></span>
									<h3><a href="./index.php?pagina=registrato/attivitaAmministrativa/amministratore/gestioneComune/create.html">Aggiungi Comune</a></h3>
									<p>Qui puoi aggiungere un comune al sistema</p>
								</section>
								<section class="col-4 col-6-medium col-12-xsmall">
									<span class="icon alt major fas fa-university "></span>
									<h3><a href="./index.php?pagina=registrato/attivitaAmministrativa/amministratore/gestioneComune/view.php">Comuni inseriti</a></h3>
									<p>Qui puoi visualizzare modificare o eliminare il comune dal sistema </p>
								</section>
								
							</div>
						</div>
						
					</div>
				</section>

					';
}

function stampaPaginaComune()
{
	echo'<section id="four" class="wrapper style1 special fade-up">
		<div class="container">
			<header class="major">
				<h2>Benvenuto ';  echo $_SESSION[USERNAME];echo'</h2>
				<p>Queste sono le attività che puoi svolgere</p>
			</header>
			<div class="box alt">
				<div class="row gtr-uniform">
					<section class="col-4 col-6-medium col-12-xsmall">
						<span class="icon alt major fas fa-user-plus">
							<webicon icon="fa:user-plus"/>
						</span>
						<h3><a href="./index.php?pagina=registrato/attivitaAmministrativa/comune/gestioneEnte/create.html">Aggiungi Ente</a></h3>
						<p>Qui puoi aggiungere un Ente al sistema</p>
					</section>
					<section class="col-4 col-6-medium col-12-xsmall">
						<span class="icon alt major fas fa-industry"></span>
						<h3><a href="./index.php?pagina=registrato/attivitaAmministrativa/comune/gestioneEnte/view.php">Enti inseriti</a></h3>';
	echo"
						<p>Qui puoi visualizzare modificare o eliminare l'ente dal sistema </p>
					</section>";
	echo'
					
					<section class="col-4 col-6-medium col-12-xsmall">
						<span class="icon alt major fas fa-binoculars"></span>
						<h3><a href="./index.php?pagina=registrato/attivitaAmministrativa/comune/gestioneSegnalazione/view.php">Visualizza segnalazioni </a></h3>';
						echo"<p>Qui puoi visualizzare e modificare lo stato della segnalazione e l'Ente assegnatario</p>
					</section>";
					echo'<section class="col-4 col-6-medium col-12-xsmall">
						<span class="icon alt major fa-area-chart"></span>
						<h3><a href="./index.php?pagina=registrato/attivitaAmministrativa/comune/gestioneSegnalazione/statistiche.php">Visualizza statistiche segnalazioni</a></h3>
						<p>Qui puoi visualizzare le statistiche delle segnalazioni nel tuo comune</p>
					</section>

					<section class="col-4 col-6-medium col-12-xsmall">
						<span class="icon alt major fas fa-edit"></span>
						<h3><a href="./index.php?pagina=registrato/attivitaAmministrativa/comune/profilo.php">I miei dati</a></h6>
          <p>Qui puoi modificare i tuoi dati</p>
								</section>
								
							</div>
						</div>
						
					</div>
				</section>';
}
function stampaPaginaEnte()
{
	echo'
	
					
				<!--main-->
				<section id="four" class="wrapper style1 special fade-up">
					<div class="container">
						<header class="major">
							<h2>Benvenuto ';  echo $_SESSION[USERNAME];echo'</h2>
							<p>Queste sono le attività che puoi svolgere</p>
						</header>
						<div class="box alt">
							<div class="row gtr-uniform">
								<section class="col-4 col-6-medium col-12-xsmall">
									<span class="icon alt major fas fa-user-plus"><webicon icon="fa:user-plus"/></span>
									<h3><a href="./index.php?pagina=registrato/attivitaAmministrativa/ente/gestioneGruppo/create.html">Aggiungi Gruppo di lavoro</a></h3>
          <p>Qui puoi aggiungere un gruppo al sistema</p>
								</section>
								<section class="col-4 col-6-medium col-12-xsmall">
									<span class="icon alt major fas fa-industry"></span>
									<h3><a href="./index.php?pagina=registrato/attivitaAmministrativa/ente/gestioneGruppo/view.php">Gruppi inseriti</a></h3>
          <p>Qui puoi visualizzare modificare o eliminare il gruppo dal sistema </p>
								</section>
								
								<section class="col-4 col-6-medium col-12-xsmall">
									<span class="icon alt major fas fa-binoculars"></span>
									<h3><a href="./index.php?pagina=registrato/attivitaAmministrativa/ente/gestioneSegnalazione/view.php">Visualizza segnalazioni </a></h3>
          <p>Qui puoi visualizzare e modificare lo stato della segnalazione e il gruppo assegnatario</p>
								</section>
								<section class="col-4 col-6-medium col-12-xsmall">
									<span class="icon alt major fa-area-chart"></span>
									<h3><a href="./index.php?pagina=registrato/attivitaAmministrativa/ente/gestioneSegnalazione/statistiche.php">Visualizza statistiche segnalazioni</a></h3>
          <p>Qui puoi visualizzare le statistiche delle segnalazioni nel tuo ente</p>
								</section>
								
								<section class="col-4 col-6-medium col-12-xsmall">
									<span class="icon alt major fas fa-edit"></span>
									<h3><a href="./index.php?pagina=registrato/attivitaAmministrativa/ente/profilo.php">I miei dati</a></h3>
          <p>Qui puoi visualizzare e modificare i tuoi dati</p>
								</section>
								
							</div>
						</div>
						
					</div>
				</section>

					';
}
function stampaPaginaGruppoDiLavoro()
{
	echo'
					
				<!--main-->
				<section id="four" class="wrapper style1 special fade-up">
					<div class="container">
						<header class="major">
							<h2>Benvenuto ';  echo $_SESSION[USERNAME];echo'</h2>
							<p>Queste sono le attività che puoi svolgere</p>
						</header>
						<div class="box alt">
							<div class="row gtr-uniform">
								<section class="col-4 col-6-medium col-12-xsmall">
									<span class="icon alt major fas fa-binoculars"><webicon icon="fa:user-plus"/></span>
									<h3><a href="./index.php?pagina=registrato/attivitaAmministrativa/gruppoDiLavoro/gestioneSegnalazione/view.php">Visualizza segnalazioni </a></h3>
          <p>Qui puoi visualizzare riaprire e chiudere una segnalazione</p>
								</section>
								<section class="col-4 col-6-medium col-12-xsmall">
									<span class="icon alt major fa-area-chart"></span>
									<h3><a href="./index.php?pagina=registrato/attivitaAmministrativa/gruppoDiLavoro/gestioneSegnalazione/statistiche.php">Visualizza statistiche segnalazioni</a></h6>
          <p>Qui puoi visualizzare le statistiche delle segnalazioni nel tuo comune</p>
								</section>
								<section class="col-4 col-6-medium col-12-xsmall">
									<span class="icon alt major fas fa-edit"></span>
									<h3><a href="./index.php?pagina=registrato/attivitaAmministrativa/gruppoDiLavoro/profilo.php">I miei dati</a></h6>
          <p>Qui puoi visualizzare e modificare i tuoi dati</p>
								</section>
								
								
							</div>
						</div>
						
					</div>
				</section>

					';
}
function stampaPaginaUtente()
{
	echo '
	<!--main-->
	<section id="four" class="wrapper style1 special fade-up">
		<div class="container">
			<header class="major">
				<h2>Benvenuto ';  echo $_SESSION[USERNAME];echo'</h2>
				<p>Queste sono le attività che puoi svolgere</p>
			</header>
			<div class="box alt">
				<div class="row gtr-uniform">
					<section class="col-4 col-6-medium col-12-xsmall">
						<span class="icon alt major fas fa-user-plus">
							<webicon icon="fa:user-plus"/>
						</span>
						<h3><a href="./index.php?pagina=segnala.html">Invia una Segnalazione</a></h3>
						<p>Qui puoi inviare una segnalazione</p>
					</section>
					<section class="col-4 col-6-medium col-12-xsmall">
						<span class="icon alt major fas fa-industry"></span>
						<h3><a href="./index.php?pagina=registrato/utente/gestioneSegnalazione/view.php">Le mie segnalazioni</a></h3>
						<p>Qui puoi visualizzare modificare o eliminare le tue segnalazioni dal sistema </p>
					</section>
					
						<section class="col-4 col-6-medium col-12-xsmall">
						<span class="icon alt major fas fa-search"></span>
						<h3><a href="./index.php?pagina=registrato/utente/gestioneSegnalazione/segnalazioniVicine.html">Segnalazioni Vicine</a></h6>
          <p>Visualizza segnalazioni vicine</p>
								</section>	

					<section class="col-4 col-6-medium col-12-xsmall">
						<span class="icon alt major fas fa-edit"></span>
						<h3><a href="./index.php?pagina=registrato/utente/profiloUtente/profilo.php">I miei dati</a></h6>
          <p>Visualizza o Modifica Dati</p>
								</section>
								
						
								
								
								
								
							</div>
						</div>
						
					</div>
				</section>';
}


?>