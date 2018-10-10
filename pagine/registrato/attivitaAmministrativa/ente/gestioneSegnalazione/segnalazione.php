<?php
echo'
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
					include './pagine/registrato/connect.php';
					include './pagine/funzioni/segnalazioni.php';
					if ( $conn ) {
						$ente = $_SESSION[ "codiceAccount" ];
						$cdt = $_GET[ "cdt" ];
						$sql = 'select * from segnalazione where cdt = "' . $cdt . '"';
						$result = mysqli_query( $conn, $sql );
						if ( isset( $result ) && mysqli_num_rows( $result ) > 0 ) {
							
								while ( $rows = mysqli_fetch_assoc( $result ) ) {

									$descrizione = wordwrap( $rows[ 'descrizione' ], 52, "\t", 1 ); //per andare a capo ogni 52 caratteri
									echo "
					<b>CDT:</b> " . $rows[ 'cdt' ] . " <br><br>

					<b>Titolo:</b> " . $rows[ 'titolo' ] . " <br><br>

					<b>Descrizione:</b> " . $descrizione . "<br><br>

					<b>Gravità:</b> " . $rows[ 'gravita' ] . " <br><br>

					<b>Indirizzo:</b> " . $rows[ 'indirizzo' ] . " <br><br>

					<b>Stato:</b> " . $rows[ 'stato' ] . " <br>";







									if ( $rows[ 'gruppo' ] != null ) {
										echo "<br><b>Gruppo di lavoro:</b> " . $rows[ 'gruppo' ] . " <br><br>";
									} else {
										echo "<br><b>Gruppo di lavoro:</b> Nessuno <br><br>";
									}




									$proprieta = null; // per far comparire o scomparire il form
									$messaggio = null;
									if ( $rows[ 'stato' ] == "chiusa" ) {
										$proprieta = "hidden";
										$messaggio = "Non è possibile cambiare il gruppo di lavoro. <br>
													  La segnalazione è stata risolta.<br>";
									}

									$sql = "select codice from gruppo_di_lavoro where ente = '" . $ente . "'";
									$result = mysqli_query( $conn, $sql );
									echo '<form ' . $proprieta . ' id="aggiornaSegnalazione" action="./index.php?pagina=registrato/attivitaAmministrativa/ente/gestioneSegnalazione/aggiornaSegnalazione.php" method="post"
									>
									';
									echo "Scegli il gruppo di lavoro:<br><br>";
									//select dinamica	
									echo '<select name = "gruppo" form = "aggiornaSegnalazione">';
									echo '<option value = "nessuno">nessuno</option>';
									while ( $row = mysqli_fetch_array( $result ) ) {
										echo '<option value ="' . $row {
											"codice"
										} . '">' . $row {
											"codice"
										} . '</option>';
									}
									echo '<input type="hidden" id="cdt" name="cdt" value="' . $rows[ "cdt" ] . '"><br>';
									echo '<input type="submit" value = "Conferma"></input></form>';
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
					<input type="hidden"  name="pagina" value="registrato/attivitaAmministrativa/ente/gestioneSegnalazione/view.php">
					<input type="submit" value="torna indietro" class="primary">';
					echo '</center>
					

</body>

</html>';?>