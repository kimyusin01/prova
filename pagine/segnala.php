<?php
define ("CODICE", "codice");
define ("RESULTS", "results");

echo '<html>

<head>
	<link href="./cssCitizengo/visualizzaMedia.css" rel="stylesheet" type="text/css">
	
</head>

</html>';
include './pagine/funzioni/segnalazioni.php';
include './pagine/registrato/connect.php';
if ( isset( $_POST[ 'invio' ] ) ) {
	$titolo = $_POST[ 'titolo' ];
	$descrizione = $_POST[ 'descrizione' ];
	$gravita = $_POST[ 'gravita' ];
	$via = $_POST[ 'via' ];
	$citta = $_POST[ 'citta' ];
	$nazione = "Italia";
	$address = $via . ', ' . $citta . ', ' . $nazione; // Your address
	$prepAddr = str_replace( ' ', '+', $address );
	$lat = $_POST[ 'latitudine' ];
	$lng = $_POST[ 'longitudine' ];

	if ( ( $lat == null || $lng == null ) && ( $via == null || $citta == null ) ) {
		echo "<script language='javascript'>
		alert('Segnalazione non effettuata. Non è stata riconosciuta la posizione. Riprovare.');
		window.location.href='index.php?pagina=segnala.html';
		</script>";
	} else {
		$i = 0;

		if ( $citta != null && $via != null ) {
			$lat = null;
			$lng = null;
		}



		while ( $i < 10 && ( $lat == null || $lng == null ) ) {
			$geocode = file_get_contents( 'http://maps.google.com/maps/api/geocode/json?address=' . $prepAddr . '&sensor=false' );

			$output = json_decode( $geocode );

			$lat = $output->results[ 0 ]->geometry->location->lat;
			$lng = $output->results[ 0 ]->geometry->location->lng;
			$i++;
		}

		if ( $lat == null || $lng == null ) {
			echo "<script language='javascript'>
		alert('Segnalazione non effettuata. Non è stata riconosciuta la posizione. Riprovare.');
		window.location.href='index.php?pagina=segnala.html';
		</script>";
		} else {
			// reverse geocode 
			$result = null;
			do {
				$url = sprintf( "https://maps.googleapis.com/maps/api/geocode/json?latlng=%s,%s", $lat, $lng );

				$content = file_get_contents( $url ); // get json content

				$metadata = json_decode( $content, true ); //json decoder

				if ( count( $metadata[ RESULTS ] ) > 0 ) {
					// for format example look at url
					// https://maps.googleapis.com/maps/api/geocode/json?latlng=40.714224,-73.961452
					$result = $metadata[ RESULTS ][ 0 ];

				} else {
					// no results returned
				}
			} while ( !( count( $metadata[ RESULTS ] ) > 0 ) );
			// fine reverse geocode

			$indirizzo = $result[ 'formatted_address' ];
			if ( $via == null || $citta == null ) {
				//elimino la provincia e la nazione
				$indirizzoTemp = strrev( $indirizzo );
				$posPrimaVirgola = stripos( $indirizzoTemp, ',' );
				$indirizzoTemp = substr( $indirizzoTemp, $posPrimaVirgola + 4 );
				// ricavo la citta
				$indirizzoTemp = strrev( $indirizzoTemp );
				$posUltimaVirgola = strripos( $indirizzoTemp, ',' );
				$citta = substr( $indirizzoTemp, $posUltimaVirgola + 8 );


			}
			$errore = true;
			$ran2 = null;

			if ( $conn ) {
				$sqlcom = "select codice from comune where nome = '" . strtolower( $citta ) . "'";
				$codcom = mysqli_query( $conn, $sqlcom );

				echo "<div id='main' class='wrapper style1'>
					<div class='container'>
						<header class='major'>
							<h2>Riepilogo segnalazione</h2>";

				if ( isset( $codcom ) ) {

					if ( mysqli_num_rows( $codcom ) > 0 ) {
						if ( $_FILES[ "file" ] != null ) {

							$i = 0;
							srand( mktime() );
							foreach ( $_FILES[ "file" ][ "name" ] as $indice => $nome ) {
								if ( $_FILES[ "file" ][ "error" ][ $indice ] == 0 ) {
									$estensione = pathinfo( $_FILES[ "file" ][ "name" ][ $indice ], PATHINFO_EXTENSION );

									if ( strtolower( $estensione ) == "png" ||
										strtolower( $estensione ) == "jpg" ||
										strtolower( $estensione ) == "jpeg" ||
										strtolower( $estensione ) == "mov" ||
										strtolower( $estensione ) == "mp4" ||
										strtolower( $estensione ) == "wmv" ) {
										if ( $_FILES[ "file" ][ "size" ][ $indice ] < 100000000 ) {
											$ran2[ $i ] = rand() . "." . $estensione;
											$risultato = move_uploaded_file( $_FILES[ "file" ][ "tmp_name" ][ $indice ], getcwd() . "/uploads/" . $ran2[ $i ] );

											if ( $risultato ) {
												$errore = false;
											} else {
												echo "<script language='javascript'>
												alert('Errore imprevisto durante lo spostamento dell'immagine. Riprovare.');
												window.location.href='index.php?pagina=segnala.html';
												</script>";

											}
										} else {
											echo "<script language='javascript'>
												alert('Il file selezionato è troppo grande, non deve superare 50MB. Riprovare.');
												window.location.href='index.php?pagina=segnala.html';
												</script>";

										}
									} else {
										echo "<script language='javascript'>
												alert('Estensione non consentita! Hai cercato di caricare un file ." . $estensione . ". Riprovare.');
												window.location.href='index.php?pagina=segnala.html';
												</script>";
									}
								} else {
									echo "<script language='javascript'>
												alert('Errore imprevisto durante il caricamento dell'immagine. Riprovare.');
												window.location.href='index.php?pagina=segnala.html';
												</script>";
								}
								$i++;
							}
						} else {
							echo "<script language='javascript'>
												alert('Nessun file selezionato. Riprovare.');
												window.location.href='index.php?pagina=segnala.html';
												</script>";
						}
						if ( !$errore ) {
							while ( $row = mysqli_fetch_assoc( $codcom ) ) {
								$sql = null;
								if ( $_SESSION[ CODICE ] == 0 ) {

									$sql = "insert into segnalazione (titolo, descrizione, gravita, comune, stato, indirizzo, latitudine, longitudine) values ('" . addslashes( $titolo ) . "', '" . addslashes( $descrizione ) . "', '" . $gravita . "',  '" . $row[ CODICE ] . "','in attesa', '" . addslashes( $indirizzo ) . "'," . $lat . "," . $lng . ");";
								} else {
									$sql = "insert into segnalazione (titolo, descrizione, gravita, comune, stato, indirizzo, latitudine, longitudine,utente) values ('" . addslashes( $titolo ) . "', '" . addslashes( $descrizione ) . "', '" . $gravita . "',  '" . $row[ CODICE ] . "','in attesa', '" . addslashes( $indirizzo ) . "'," . $lat . "," . $lng . "," . $_SESSION[ "codiceAccount" ] . ");";
								}



								$query = mysqli_query( $conn, $sql );
								if ( !isset( $query ) ) {
									echo "<script language='javascript'>
									alert('Segnalazione non effettuata. Riprovare.');
									window.location.href='index.php?pagina=segnala.html';
									</script>";
								}
							}


							$path = "uploads/";
							$cdt = null;
							$i = 0;
							foreach ( $_FILES[ "file" ][ "name" ] as $indice => $nome ) {

								$estensione = pathinfo( $_FILES[ "file" ][ "name" ][ $indice ], PATHINFO_EXTENSION );

								$nameFile = $_FILES[ 'file' ][ 'name' ][ $indice ];

								$sqlCDT = "select cdt from segnalazione where titolo = '" . addslashes( $titolo ) . "' AND descrizione = '" . addslashes( $descrizione ) . "' AND latitudine =" . $lat . " AND longitudine = " . $lng . ";";
								$queryCDT = mysqli_query( $conn, $sqlCDT );

								if ( isset( $queryCDT ) && mysqli_num_rows( $queryCDT ) > 0 ) {

									while ( $row = mysqli_fetch_assoc( $queryCDT ) ) {
										$sql = "insert into media (nome, percorso, cdt) values ('" . $ran2[ $i ] . "','" . $path . "'," . $row[ 'cdt' ] . ");";
										$query = mysqli_query( $conn, $sql );
										$cdt = $row[ 'cdt' ];

									}
									$i++;

								}
							}



							$descrizione = wordwrap( $descrizione, 52, "\t", 1 );

							echo "
							
							
							
				
							<p>Ecco la tua segnalazione <br>
							Suggerimento: memorizza il CDT per controllare lo stato della segnalazione.</p>
						
							
							
							<div class='content'>
							<center>
							<br>
							<p> CDT: " . $cdt . " <br>
							<p> Titolo: " . $titolo . "<br>
							<p> Descrizione: " . $descrizione . "<br> 
							<p> Gravità: " . $gravita . "<br>
							<p> Locazione: " . $indirizzo . "</p> <br>
							<p> Media: <br>";

							stampaMediaSegnalazione( $cdt, $conn );

							echo "</div>";

							echo '<td align = "center"> 
				<form action="index.php?pagina=eliminaSegnalazione.php&cdt=' . $cdt . '"   method="POST"> 
				<input type="submit" name value="Annulla segnalazione">
		</form>';

							echo '<form>
						
						</form></center></div></div>';
						}
					} else {
						$sqlEmail = "select email from amministratore";
						$queryEmail = mysqli_query( $conn, $sqlEmail );
						if ( isset( $queryEmail ) && mysqli_num_rows( $queryEmail ) > 0 ) {

							while ( $row = mysqli_fetch_assoc( $queryEmail ) ) {
								$messaggio = "E' avvenuta una segnalazione presso un comune non presente nel sistema.
										Comune: " . $citta . "
									
									
									Segnalazione:
									Titolo: " . $titolo . "
									Descrizione: " . $descrizione . "
									Gravita': " . $gravita . "
									Locazione: " . $address . "";
								mail( $row[ 'email' ], 'Comune non presente nel sistema', $messaggio );
							}

						}
						echo "Il comune non ha ancora aderito al sistema. <br>
							  Sono stati presi provvedimenti per effettuare la richiesta di partecipazione. <br>
							  Ci scusiamo per il disagio. <br>
							  </div></div>";

					}
					echo "<p></p>
						</header>";

				}
			}
		}
	}

}
?>