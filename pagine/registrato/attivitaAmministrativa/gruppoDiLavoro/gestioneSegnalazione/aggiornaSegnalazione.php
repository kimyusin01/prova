<?php

include './pagine/registrato/connect.php';

if ( isset( $_POST[ 'stato' ] ) ) {
	$stato = $_POST[ 'stato' ];
	$cdt = $_POST[ 'cdt' ];

	if ( $stato == "Apri segnalazione" ) {
		$stato = "assegnata";
	} else {
		$stato = "chiusa";
	}

	$sql = 'update segnalazione set stato = "' . $stato . '" where cdt = ' . $cdt;
	$result = mysqli_query( $conn, $sql );


}

echo "<script type='text/javascript'>";
echo "alert('Segnalazione modificata con successo.');";
echo 'window.location ="./index.php?pagina=registrato/attivitaAmministrativa/gruppoDiLavoro/gestioneSegnalazione/segnalazione.php&cdt=' . $cdt. '" ';
echo "</script>";



?>