	<?php
	define ("WHERE", "' WHERE cdt = '");
	include './pagine/registrato/connect.php';
	include './pagine/registrato/utente/gestioneSegnalazione/edit.html';

	if ( isset( $_POST[ 'Modifica' ] ) ) {

		//get the name and comment entered by user
		$codice = $_GET[ 'codice' ];
		$titolo = $_POST[ 'titolo' ];
		$descrizione = $_POST[ 'descrizione' ];
		$gravita = $_POST[ 'gravita' ];

		$array = array( 0, 0, 0 );

		if ( $titolo != "" ) {
			$array[ 0 ] = 1;
		} else {
			$array[ 0 ] = -1;
		}



		if ( $descrizione != "" ) {
			$array[ 1 ] = 1;
		} else {
			$array[ 1 ] = -1;
		}



		if ( $gravita != "" ) {
			$array[ 2 ] = 1;
		} else {
			$array[ 2 ] = -1;
		}






		if ( $conn ) {




			if ( $array[ 0 ] == 1 ) {
				$query = "UPDATE  segnalazione
								  SET titolo = '" . addslashes($titolo) . WHERE . $codice . "' ";
				$result = mysqli_query( $conn, $query );
				if ( $result == null ) {

					$array[ 0 ] = 0;
				}





			}



			if ( $array[ 1 ] == 1 ) {
				$query = "UPDATE segnalazione
								  SET descrizione = '" . addslashes($descrizione) . WHERE . $codice . "' ";
				$result = mysqli_query( $conn, $query );
				if ( $result == null ) {

					$array[ 1 ] = 0;
				}



			}



			if ( $array[ 2 ] == 1 ) {
				$query = "UPDATE  segnalazione
								  SET gravita = '" . $gravita . WHERE . $codice . "' ";
				$result = mysqli_query( $conn, $query );
				if ( $result == null ) {

					$array[ 2 ] = 0;
				}



			}





			for ( $j = 0; $j < 2; $j++ ) {
				$stringa = null;
				$checked = 0;
				for ( $i = 0; $i < 3; $i = $i + 1 ) {
					if ( $array[ $i ] == $j ) {
						$checked = 1;
					}
				}

				if ( $checked == 1 ) {
					if ( $j == 0 ) {
						$stringa = "IMPOSSIBILE MODIFICARE I SEGUENTI DATI:";

					} else {
						$stringa = "DATI MODIFICATI:";
					}

					for ( $i = 0; $i < 3; $i = $i + 1 ) {
						if ( $array[ $i ] == $j ) {
							switch ( $i ) {
								case 0:
									$stringa .= " TITOLO";
									break;
								case 1:
									$stringa .= " DESCRIZIONE";
									break;
								case 2:
									$stringa .= " GRAVITA'";
									break;
								default:
									break;
							}
						}
					}

					echo '<script type="text/javascript">alert("' . $stringa . '")</script>';
				}

			}








			mysqli_close( $conn );


			echo '<script>
				window.location = "./index.php?pagina=registrato/utente/gestioneSegnalazione/segnalazione.php&cdt=' . $codice . '";
				</script>';

		} else {
			echo "Connessione database fallita";
		}

	}






	?>