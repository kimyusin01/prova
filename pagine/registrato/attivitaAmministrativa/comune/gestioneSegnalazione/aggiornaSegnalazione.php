<?php

include './pagine/registrato/connect.php';

if ( isset( $_POST[ 'ente' ] ) ) {
	$ente = $_POST[ 'ente' ];
	$cdt = $_POST[ 'cdt' ];
	if ( $conn ) {
		$sql = 'select codice from ente where nome = "' . $ente . '"';
		if ( $ente != "nessuno" ) {
			$result = mysqli_query( $conn, $sql );
			$rows = mysqli_fetch_assoc( $result );
			$codice = $rows[ "codice" ];
			$sql = 'update segnalazione set stato = "in lavorazione" where cdt = ' . $cdt;
			$result = mysqli_query( $conn, $sql );
		} else {
			$codice = "NULL";
			$sql = 'update segnalazione set stato = "in attesa" where cdt = ' . $cdt;
			$result = mysqli_query( $conn, $sql );
		}
		$sql = 'update segnalazione set ente =' . $codice . ' where cdt = ' . $cdt;
		$result = mysqli_query( $conn, $sql );
		
		
	}

}

if ( isset( $_POST[ 'stato' ] ) ) {
	$stato = $_POST[ 'stato' ];
	$cdt = $_POST[ 'cdt' ];
	
	if($stato == "Apri segnalazione") {
		$stato = "in attesa";
	}
	else {
		$stato = "rifiutata";
	}
	
	$sql = 'update segnalazione set stato = "'.$stato.'" where cdt = ' . $cdt;
	$result = mysqli_query( $conn, $sql );
	

}

echo "<script type='text/javascript'>";
		echo "alert('Segnalazione modificata con successo.');";
		echo 'window.location ="./index.php?pagina=registrato/attivitaAmministrativa/comune/gestioneSegnalazione/segnalazione.php&cdt=' . $cdt. '" ';
		echo "</script>";



?>