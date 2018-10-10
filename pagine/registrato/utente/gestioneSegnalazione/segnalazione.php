<?php
echo '
<html>

<head>


	
 <link href="./cssCitizengo/visualizzaMedia.css" rel="stylesheet" type="text/css">



</head>

<body>
	<!-- Main -->
	<div id="main" class="wrapper style1">
		<div class="container">
			<header class="major">
				<center>
					<h2>Riepilogo segnalazione</h2>
					<p>Ecco qui la segnalazione</p>
				</center>
			</header>
		</div>

		<div class="wrapperrow3">
			<main class="hoc container clear">
				<!-- main body -->
				<!-- ################################################################################################ -->
				<div class="content">
';

echo '<center>';
include './pagine/funzioni/segnalazioni.php';
include './pagine/registrato/connect.php';

if ( $conn ) {
	$cdt = $_GET[ "cdt" ];
	$sql = 'select * from segnalazione where cdt = "' . $cdt . '"';
	$result = mysqli_query( $conn, $sql );
	if ( isset( $result ) && mysqli_num_rows( $result ) > 0 ) {
		

			while ( $rows = mysqli_fetch_assoc( $result ) ) {

				stampaSegnaUteGrup( $rows );

				$proprieta = null;
				$stato = null;

				if ( $rows[ 'utente' ] == $_SESSION[ "codiceAccount" ] ) {
					
					if ( $rows[ 'stato' ] == "in attesa" ) {
						
						echo '<form action="./index.php?pagina=registrato/utente/gestioneSegnalazione/delete.php&codice=' . $rows[ 'cdt' ] . '" onsubmit="return confirm_update();"  method="POST" id="user_update"> 
					<input type="submit" value="elimina">
					</form>
		  			
					
		  			<form action="./index.php?pagina=registrato/utente/gestioneSegnalazione/modifica.php&codice=' . $rows[ 'cdt' ] . '"  method="POST"> 
					<input type="submit" value="modifica">
					</form>';

					} else if($rows[ 'stato' ] == "in lavorazione") {
						
						echo '<b>Un ente ha già preso in carico la segnalazione, non può essere modificata.</b>';
					}
				}

				echo "</tr><br><br>
								<b>MEDIA:</b><br><br>";
				stampaMediaSegnalazione( $cdt, $conn );


			}
		
	}
	mysqli_close( $conn );
} else {
	echo "impossibile connettersi";
}

if ( $_SESSION["vista"]=="vista") {
	$pagina = "view.php";
}
else {
	$pagina = "segnalazioniVicine.html";
}
echo '<form action="./index.php" method="get">
					<input type="hidden"  name="pagina" value="registrato/utente/gestioneSegnalazione/'.$pagina.'">
					<input type="submit" value="Indietro" class="primary">';

echo '</center>';
echo '	
				</div>
					</main>	
				</div>
				</div>
</body>

</html>
			
<script>
	function confirm_update() {
		if ( confirm( "Sei sicuro di voler eliminare la segnalazione?" ) ) {
			return true;
		} else {
			return false;
		}
	}
</script>
';
?>