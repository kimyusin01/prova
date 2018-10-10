<!doctype php>
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->

<nav id="nav">
						<ul>
							<?php
		if ( $_SESSION[ 'codice' ] == 0 ) {
		menuUtenteNonRegistrato();
		} else {

			switch ( $_SESSION[ "ruolo" ] ) {
			
		case 'amministratore': menuAmministratore();
						
					break;
					
					
					
				
		case 'comune':menuComune();
					
					break;

		case 'ente':menuEnte();
					
					break;
					
					
		case 'gruppo_di_lavoro':menuGruppoDiLavoro();
			 

					break;
					
				case 'utente':menuUtenteRegistrato();
				
					break;
					
				default: break;
			}

			echo '
			<li ><a href="./pagine/registrato/logout.php">logout</a></li>';
		}
		?>
						</ul>
					</nav>
<!-- ################################################################################################ -->



<?php

function menuAmministratore()
{
			echo'<li class="active"><a href="./index.php?pagina=registrato/account.php"> La tua Home</a></li>

		<li><a class="drop" href="#">Gestisci Comune</a>
            <ul>
            	<li><a href="./index.php?pagina=registrato/attivitaAmministrativa/amministratore/gestioneComune/create.html">Aggiungi Comune</a></li>
				<li><a href="./index.php?pagina=registrato/attivitaAmministrativa/amministratore/gestioneComune/view.php">Comuni inseriti</a></li>
	 			
            </ul>
       </li>';
}

function menuComune()
{
	echo'<li class="active"><a href="./index.php?pagina=registrato/account.php"> La tua Home</a></li>
		 <li><a class="drop" href="#">Gestisci Ente</a>
            <ul>
            	<li><a href="./index.php?pagina=registrato/attivitaAmministrativa/comune/gestioneEnte/create.html">Aggiungi Ente</a></li>
				<li><a href="./index.php?pagina=registrato/attivitaAmministrativa/comune/gestioneEnte/view.php">Enti inseriti</a></li>
	 			
            </ul>
       </li>
		<li><a class="drop" href="#">Gestisci Segnalazione</a>
            <ul>
            
			<li><a href="./index.php?pagina=registrato/attivitaAmministrativa/comune/gestioneSegnalazione/view.php">Visualizza Segnalazioni</a></li>
			<li><a href="./index.php?pagina=registrato/attivitaAmministrativa/comune/gestioneSegnalazione/statistiche.php">Visualizza Statistiche</a></li>
			</ul>
        </li>
		<li ><a href="./index.php?pagina=registrato/attivitaAmministrativa/comune/profilo.php">I miei dati</a></li>';
}

function menuEnte()
{
		echo '<li class="active"><a href="./index.php?pagina=registrato/account.php"> La tua Home</a></li>
				<li><a class="drop" href="#">Gestisci Gruppi</a>
            <ul>
            	<li><a href="./index.php?pagina=registrato/attivitaAmministrativa/ente/gestioneGruppo/create.html">Aggiungi Gruppo</a></li>
				<li><a href="./index.php?pagina=registrato/attivitaAmministrativa/ente/gestioneGruppo/view.php">Gruppi inseriti</a></li>
	 			
            </ul>
       </li>
<li><a class="drop" href="#">Gestisci Segnalazione</a>
            <ul>
            	
				<li><a href="./index.php?pagina=registrato/attivitaAmministrativa/ente/gestioneSegnalazione/view.php">Visualizza segnalazione </a></li>
	 			<li><a href="./index.php?pagina=registrato/attivitaAmministrativa/ente/gestioneSegnalazione/statistiche.php">Visualizza statistiche</a></li>
            </ul>
       </li>
				
				<li ><a href="./index.php?pagina=registrato/attivitaAmministrativa/ente/profilo.php">I miei dati</a></li>';
}
function menuGruppoDiLavoro()
{
	echo ' <li class="active"><a href="./index.php?pagina=registrato/account.php"> La tua Home</a></li>
			<li><a class="drop" href="#">Gestisci segnalazione</a>
				<ul>
              	<li><a href="./index.php?pagina=registrato/attivitaAmministrativa/gruppoDiLavoro/gestioneSegnalazione/view.php">Visualizza segnalazione</a></li>
				<li><a href="./index.php?pagina=registrato/attivitaAmministrativa/gruppoDiLavoro/gestioneSegnalazione/statistiche.php">Visualizza statistiche</a></li>
              	</ul>
          	</li>
		  	<li ><a href="./index.php?pagina=registrato/attivitaAmministrativa/gruppoDiLavoro/profilo.php">I miei dati</a></li>';
}

function menuUtenteNonRegistrato()
{
		echo' <li class="active"><a href="./index.php?pagina=home.html">Home</a>
		</li>

<li><a class="drop" href="#">Notizie su di noi</a>
            <ul>
              <li ><a href="./index.php?pagina=chiSiamo.html">Chi Siamo</a></li>
<li ><a href="./index.php?pagina=contatti.html">Contatti</a></li>
              
              
            </ul>
          </li>
		 <li ><a href="./index.php?pagina=segnala.html">Invia Segnalazione</a></li>
			<li ><a href="./index.php?pagina=controllaSegnalazione.html">Controlla Segnalazione</a></li>
		 <li><a class="drop" href="#">Accedi</a>
            <ul>
              <li><a href="./index.php?pagina=registrato/login.php&account=utente">Utente</a></li>
              <li><a class="drop" href="#">Area Amministrativa</a>
                <ul>
                 <li><a href="./index.php?pagina=registrato/login.php&account=amministratore">Amministratore</a></li>
              <li><a href="./index.php?pagina=registrato/login.php&account=comune">Comune</a></li>
              <li><a href="./index.php?pagina=registrato/login.php&account=ente">Ente</a></li>
              <li><a href="./index.php?pagina=registrato/login.php&account=gruppo_di_lavoro">Gruppo di lavoro</a></li>
                </ul>
              </li>
              
            </ul>
          </li>

		  <li ><a href="./index.php?pagina=/registrato/utente/create.html">Iscriviti</a></li>';
		
}
function menuUtenteRegistrato()
{
	echo '		<li class="active"><a href="./index.php?pagina=registrato/account.php"> La tua Home</a></li>
 		<li><a href="./index.php?pagina=segnala.html">Invia Segnalazione</a></li>
		
		 <li><a class="drop" href="#">Gestione Segnalazione</a>
            <ul>
              <li><a href="./index.php?pagina=registrato/utente/gestioneSegnalazione/view.php">Le mie segnalazioni</a></li>
              <li><a href="./index.php?pagina=registrato/utente/gestioneSegnalazione/segnalazioniVicine.html">Segnalazioni vicine</a></li>
                
              
            </ul>
		<li ><a href="./index.php?pagina=registrato/utente/profiloUtente/profilo.php"> I miei dati</a></li>';
}


?>




