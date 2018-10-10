<?php
echo "
<html>

<head>
	

</head>

<body>
	<!-- Main -->
	<div id='main' class='wrapper style1'>
		<div class='container'>
			<header class='major'>
				<h2>Visualizza segnalazioni</h2>
				<p>Qui puoi visualizzare e modificare lo stato e l'assegnatario delle segnalazioni</p>
			</header>
			<div>
			<center>
					
					<form action='./index.php' method='get'>
					<input type='hidden'  name='pagina' value='controllaSegnalazione.html'>
					<input type='submit' value='Ricerca tramite codice di tracking (CDT)' >
					</form>
				</center>
				
				<br>
				
				<center>
					<h2>Seleziona lo stato delle segnalazioni che vuoi visualizzare:</h2>
				</center>
			</div>
			<div>";
include './pagine/registrato/connect.php';
include './pagine/funzioni/segnalazioni.php';
if ( $conn ) {
	$utente = $_SESSION[ "codiceAccount" ];
    $_SESSION["vista"]="vista";
		stampaListaSegnalazioni( $conn, "utente", $utente);





	mysqli_close( $conn );
} else {
	echo "impossibile connettersi";
}
echo "</table>";

include 'pagine/registrato/stampaMappa/mappa.php';


echo'</div>
</div>

<!-- ################################################################################################ -->
<!-- ################################################################################################ -->

<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->

</div>
</div>
</body>

</html>';
?>
