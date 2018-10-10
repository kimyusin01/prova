<?php

include './pagine/registrato/connect.php';

if ( isset( $_POST[ 'gruppo' ] ) ) {
	$gruppo = $_POST[ 'gruppo' ];
	$cdt = $_POST[ 'cdt' ];
	if ( $conn ) {
		if ( $gruppo != "nessuno" ) {
			$sql = 'update segnalazione set stato = "assegnata" where cdt = ' . $cdt;
		} else {
			$gruppo = "NULL";
			$sql = 'update segnalazione set stato = "in lavorazione" where cdt = ' . $cdt;
			
		}
		$result = mysqli_query( $conn, $sql );
		$sql = 'update segnalazione set gruppo =' . $gruppo . ' where cdt = ' . $cdt;
		$result = mysqli_query( $conn, $sql );

	}

}


echo "<script type='text/javascript'>";
echo "alert('Segnalazione modificata con successo.');";
echo 'window.location ="./index.php?pagina=registrato/attivitaAmministrativa/ente/gestioneSegnalazione/segnalazione.php&cdt=' . $cdt. '" ';
echo "</script>";



?>