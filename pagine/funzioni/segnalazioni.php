<?php
define ("PERCORSO", "percorso");
define ("DESCRIZIONE", "descrizione");
define ("BR", "<br><br>");
define ("STATO", "stato");
define ("GRUPPO_DI_LAVORO", "gruppo_di_lavoro");
define ("NIENTE", "niente");
define ("GRUPPO", "gruppo");
define ("TD", "<td>");
define ("TD_FINE", "</td>");
function stampaMediaSegnalazione( $cdt, $conn ) {
	$sql = "select * from media where cdt = '" . $cdt . "'";
	$result = mysqli_query( $conn, $sql );
echo BR;
	while ( $row = mysqli_fetch_array( $result ) ) {
		$estensione = pathinfo( $row[ PERCORSO ] . $row[ 'nome' ], PATHINFO_EXTENSION );
		if ( strtolower( $estensione ) == "png" ||
			strtolower( $estensione ) == "jpg" ||
			strtolower( $estensione ) == "jpeg" ) {
			echo "<div id='img_div'>";
			echo "<img src='" . $row[ PERCORSO ] . $row[ 'nome' ] . "'>";
			echo "</div>";
			echo BR;

		}

		if ( strtolower( $estensione ) == "mov" ||
			strtolower( $estensione ) == "mp4" ||
			strtolower( $estensione ) == "wmv" ) {
			echo '<video controls >
												   <source
												   src="' . $row[ PERCORSO ] . $row[ 'nome' ] . '">
												   </video>';
			echo BR;

		}
	}
}

function stampaSegnaUteGrup( $segnalazione ) {
	$segnalazione[ DESCRIZIONE ] = wordwrap( $segnalazione[ DESCRIZIONE ], 52, "\t", 1 ); //per andare a capo ogni 52 caratteri
	echo "
					<b>CDT:</b> " . $segnalazione[ 'cdt' ] . BR ."

					<b>Titolo:</b> " . $segnalazione[ 'titolo' ] . BR ."

					<b>Descrizione:</b> " . $segnalazione[ DESCRIZIONE ] . "<br><br>

					<b>Gravità:</b> " . $segnalazione[ 'gravita' ] . BR ."

					<b>Indirizzo:</b> " . $segnalazione[ 'indirizzo' ] . BR ."";
					if($_SESSION[ "codice" ] == 4) {
					
					echo "<b>Latitudine:</b> " . $segnalazione[ 'latitudine' ] . BR ."
					
						<b>Longitudine:</b> " . $segnalazione[ 'longitudine' ] . BR ."";

					}
					echo "<b>Stato:</b> " . $segnalazione[ STATO ] . BR ."";
}

function stampaListaSegnalazioni( $conn, $tipoAccount, $codice ) {
	$cartella = "attivitaAmministrativa/" . $tipoAccount;
	if ( $tipoAccount == GRUPPO_DI_LAVORO ) {
		$cartella = "attivitaAmministrativa/gruppoDiLavoro";
	} else if ( $tipoAccount == "utente" ) {
		$cartella = "utente";
	}
	echo "Filtro: <br>";
	echo '<form  id="statoSegnalazione" action="./index.php?pagina=registrato/' . $cartella . '/gestioneSegnalazione/view.php" method="post">';
	echo '<select name = "stato" form = "statoSegnalazione">';
	echo '<option value = "niente">----</option>';
	echo '<option value = "tutte">tutte</option>';
	if ( $tipoAccount != GRUPPO_DI_LAVORO ) {
		if ( $tipoAccount != "ente" ) {
			echo '<option value = "rifiutata">rifiutata</option>';
			echo '<option value = "in attesa">in attesa</option>';
		}
		echo '<option value = "in lavorazione">in lavorazione</option>';
	}
	echo '<option value = "assegnata">assegnata</option>';
	echo '<option value = "chiusa">chiusa</option>';
	$stato = null;
	echo '<input type="submit" value = "Conferma"></input></form>';
	$proprieta = NIENTE;
	  if ( isset( $_POST[ STATO ] ) ) {
		$stato = $_POST[ STATO ];
		if($stato==NIENTE)  {
			$proprieta = NIENTE;
		}
		  else if($stato != "tutte")  {
			$proprieta = 'and stato = "' . $stato .'"';
			 echo "<center><h3>Hai scelto di visualizzare le segnalazioni con lo stato di: '" . $stato."'</h3></center>";
		  }
		 else {
			 $proprieta = null;
			 echo "<center><h3>Hai scelto di visualizzare tutte le segnalazioni </h3></center>";
		 }
			 
	}
	if ( strcmp( $proprieta, NIENTE ) != 0 ) {

		echo " 
				<div class='content' style='overflow-x:auto;'>
					
					<table class='table'>
					<tr>
						<th align='center' colspan='1'>Attivit&agrave;</th>
						<th align='center'> CDT </th>
						<th align='center'> Titolo </th>
						<th align='center'> Descrizione </th>
						<th align='center'> Gravità </th>
						<th align='center'> Indirizzo </th>
						<th align='center'> Stato Segnalazione </th>";
		switch ( $tipoAccount ) {
			case 'comune':
				echo "<th align='center'> Ente assegnato </th>";
				break;
			case 'ente':
				echo "<th align='center'> Gruppo Assegnato </th>";
				break;
			case GRUPPO_DI_LAVORO:
				echo "<th align='center'> Latitudine </th>
											<th align='center'> Longitudine </th>";
				break;
			default:
				break;
		}
		echo "</tr>";

		if($tipoAccount == GRUPPO_DI_LAVORO) {
			$tipoAccount = GRUPPO;
		}
		
		$sql = 'select * from segnalazione where ' . $tipoAccount . ' = "' . $codice . ' " ' . $proprieta;
		$result = mysqli_query( $conn, $sql );
		if ( isset( $result ) && mysqli_num_rows( $result ) > 0  ) {
		
				while ( $rows = mysqli_fetch_assoc( $result ) ) {

					echo '<td align = "center"> 
				<form action="./index.php?pagina=registrato/' . $cartella . '/gestioneSegnalazione/segnalazione.php&cdt=' . $rows[ 'cdt' ] . '"  method="POST"> 
				<input type="submit" name value="Mostra">
		</form>';
					//eliminazione



					echo TD . $rows[ 'cdt' ] . TD_FINE .
                			TD . $rows[ 'titolo' ] . TD_FINE.
							TD . $rows[ DESCRIZIONE ] . TD_FINE.
                			TD  . $rows[ 'gravita' ] . TD_FINE.
							TD  . $rows[ 'indirizzo' ] . TD_FINE.
							TD  . $rows[ STATO ] . TD_FINE;
					switch ( $tipoAccount ) {
						case 'comune':
							echo TD . $rows[ 'ente' ] . TD_FINE;
							break;
						case 'ente':
							echo TD . $rows[ GRUPPO ] . TD_FINE;
							break;
						case GRUPPO:
							echo TD . $rows[ 'latitudine' ] . TD_FINE.
											TD . $rows[ 'longitudine' ] . TD_FINE;
							break;
						default:
							break;
					}
					echo "</tr>";
				}
			
		}

	}
	return $stato ;
}


?>