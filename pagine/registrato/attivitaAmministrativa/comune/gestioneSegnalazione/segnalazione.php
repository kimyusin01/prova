
<?php
define ("STATO", "stato");
define ("HIDDEN", "hidden");



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




			<!-- Content -->

			<!-- ################################################################################################ -->


		</div>

		<div class="wrapperrow3">
			<main class="hoc container clear">
				<!-- main body -->
				<!-- ################################################################################################ -->
				<div class="content">

					<center>';
					include './pagine/registrato/connect.php';
					include './pagine/funzioni/segnalazioni.php';
					if ( $conn ) {
						$comune = $_SESSION[ "codiceAccount" ];
						$cdt = $_GET[ "cdt" ];
						$sql = 'select * from segnalazione where cdt = "' . $cdt . '"';
						$result = mysqli_query( $conn, $sql );
						if ( isset( $result ) && mysqli_num_rows( $result ) > 0 ) {
						

								while ( $rows = mysqli_fetch_assoc( $result ) ) {

									$descrizione = wordwrap( $rows[ 'descrizione' ], 52, "\t", 1 ); //per andare a capo ogni 52 caratteri
									$sqlEnte = 'select nome from ente where codice = "' . $rows[ 'ente' ] . '"'; //per ricavare il nome dell'ente (noi abbiamo solo il codice)
									$result = mysqli_query( $conn, $sqlEnte );
									$rowsEnte = mysqli_fetch_assoc( $result );
									echo "
					<b>CDT:</b> " . $rows[ 'cdt' ] . " <br><br>

					<b>Titolo:</b> " . $rows[ 'titolo' ] . " <br><br>

					<b>Descrizione:</b> " . $descrizione . "<br><br>

					<b>Gravità:</b> " . $rows[ 'gravita' ] . " <br><br>

					<b>Indirizzo:</b> " . $rows[ 'indirizzo' ] . " <br><br>

					<b>Stato:</b> " . $rows[ STATO ] . " <br> ";


									$proprieta = null;
									$stato = null;

									if ( $rows[ STATO ] == "rifiutata" ) {
										$stato = "Apri segnalazione";
									} elseif ( $rows[ STATO ] == "in attesa" ) {
										$stato = "Rifiuta segnalazione";
									}
									else {
										$proprieta = HIDDEN;
									}

										echo"<br>";

									echo '<form ' . $proprieta . ' id="aggiornaSegnalazioneStato" action="./index.php?pagina=registrato/attivitaAmministrativa/comune/gestioneSegnalazione/aggiornaSegnalazione.php" method="post"
									>
									';
									echo '<br><input type="hidden" id="stato" name="stato" value="' . $stato . '" </input>';
									echo '<input type="hidden" id="cdt" name="cdt" value="' . $rows[ "cdt" ] . '" </input>';
									echo '<input type="submit" value = "' . $stato . '"></input></form>';
									if($rowsEnte[ 'nome' ]==null)
									{
										echo "<b>Ente: </b> Nessuno <br><br>";
									}
									else
									{
										echo "<b>Ente:</b> " . $rowsEnte[ 'nome' ] . " <br><br>";
									}
									

									$proprieta = null; // per far comparire o scomparire il form
									$messaggio = null;


									if ( $rows[ STATO ] == "chiusa" ) {
										$proprieta = HIDDEN;
										$messaggio = "Non è possibile cambiare l'ente. <br>
													  La segnalazione è stata risolta.<br>";
									}

									if ( $rows[ STATO ] == "assegnata" ) {
										$proprieta = HIDDEN;
										$messaggio = "Non è possibile cambiare l'ente. <br>
													  La segnalazione è stata già assegnata ad un gruppo di lavoro.<br>";

									}

									$sql = "select nome from ente where comune = '" . $comune . "'";
									$result = mysqli_query( $conn, $sql );
									echo '<form ' . $proprieta . ' id="aggiornaSegnalazione" action="./index.php?pagina=registrato/attivitaAmministrativa/comune/gestioneSegnalazione/aggiornaSegnalazione.php" method="post"
									>
									';
									echo "Scegli l'ente: <br><br>";
									//select dinamica	
									echo '<select name = "ente" form = "aggiornaSegnalazione">';
									echo '<option value = "nessuno">nessuno</option>';
									while ( $row = mysqli_fetch_array( $result ) ) {
										echo '<option value ="' . $row {
											"nome"
										} . '">' . $row {
											"nome"
										} . '</option>';
									}
									echo '<input type="hidden" id="cdt" name="cdt" value="' . $rows[ "cdt" ] . '"><br>';
									echo '
									
									<div class="col-12">
											<ul class="actions">
												<li><input type="submit" name="Conferma" value="Conferma" class="primary" /></li>
												
											</ul>
										</div>
									</form>';






									echo $messaggio;
									echo "</tr>
									<b>MEDIA:</b><br><br>
									";




									stampaMediaSegnalazione($cdt, $conn);
								}
							
						}
						mysqli_close( $conn );
					} else {
						echo "impossibile connettersi";
					}
					echo '
					<form action="./index.php" method="get">
					<input type="hidden"  name="pagina" value="registrato/attivitaAmministrativa/comune/gestioneSegnalazione/view.php">
					<input type="submit" value="torna indietro" class="primary">';
					echo '</center>
					
				</div>
		</div>
</body>

</html>';?>