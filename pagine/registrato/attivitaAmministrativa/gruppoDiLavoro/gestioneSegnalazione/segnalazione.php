<?php
echo'
<html>

<head>


	<style>
		img {
			width: 50%;
			height: auto;
		}
		
		video {
			width: 50%;
			height: auto;
		}
	</style>


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
						if ( isset( $result ) && mysqli_num_rows( $result ) > 0) {
							

								while ( $rows = mysqli_fetch_assoc( $result ) ) {
									
									stampaSegnaUteGrup($rows);

									$proprieta = null;
									$stato = null;

									if ( $rows[ 'stato' ] == "chiusa" ) {
										$stato = "Apri segnalazione";
									} elseif ( $rows[ 'stato' ] == "assegnata" ) {
										$stato = "Chiudi segnalazione";
									}
									else {
										$proprieta = "hidden";
									}



									echo '<form ' . $proprieta . ' id="aggiornaSegnalazioneStato" action="./index.php?pagina=registrato/attivitaAmministrativa/gruppoDiLavoro/gestioneSegnalazione/aggiornaSegnalazione.php" method="post"
									>
									';
									echo '<input type="hidden" id="stato" name="stato" value="' . $stato . '" </input>';
									echo '<input type="hidden" id="cdt" name="cdt" value="' . $rows[ "cdt" ] . '" </input>';
									echo '<input type="submit" value = "' . $stato . '"></input></form>';



									echo "</tr>
								<b>MEDIA:</b><br><br>";

									stampaMediaSegnalazione($rows['cdt'], $conn);
								}
							
						}
						mysqli_close( $conn );
					} else {
						echo "impossibile connettersi";
					}
					echo '<form action="./index.php" method="get">
					<input type="hidden"  name="pagina" value="registrato/attivitaAmministrativa/gruppoDiLavoro/gestioneSegnalazione/view.php">
					<input type="submit" value="torna indietro" class="primary">';
					echo '</center>
					</div>
					</main>	
				</div>
				</div>

</body>

</html>';
					?>