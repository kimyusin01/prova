<?php
define("TDTD", "</td><td>");
echo'
<html>


<body id="vicine">
	<!-- Main -->
	<div id="main" class="wrapper style1">
		<div class="container">
			<header class="major">
				<center>
					<h2>Segnalazioni vicine</h2>
					<p>Ecco qui le tue segnalazioni vicine alla tua posizione</p>
				</center>
			</header>
		</div>

		<div class="wrapperrow3">
			<main class="hoc container clear">
				<!-- main body -->
				<!-- ################################################################################################ -->
				<div class="content">';
echo"<div class='content' style='overflow-x:auto;'>";



include './pagine/funzioni/segnalazioni.php';
include './pagine/registrato/connect.php';
$_SESSION["vista"]="SegnalazioniVicine";
$diff=1;//distanza tra posizione utente e segnalazioni
if ( isset( $_POST[ 'invio' ] ) ) {
	
	$via = $_POST[ 'via' ];
	$citta = $_POST[ 'citta' ];
	$nazione = "Italia";
	$address = $via . ', ' . $citta . ', ' . $nazione; // Your address
	$prepAddr = str_replace( ' ', '+', $address );
	$lat = $_POST[ 'latitudine' ];
	$lng = $_POST[ 'longitudine' ];

	if ( ( $lat == null || $lng == null ) && ( $via == null || $citta == null ) ) {
		
		echo "<script language='javascript'>
		alert('Non è stato possibile rilevare la posizione.');
		window.location.href='index.php?pagina=/registrato/account.php';
		</script>";
	
	} else {
		
		
		$i = 0;

		if ( $citta != null && $via != null ) {
			$lat = null;
			$lng = null;
			
			while ( $i < 10 && ( $lat == null || $lng == null ) ) {
			$geocode = file_get_contents( 'http://maps.google.com/maps/api/geocode/json?address=' . $prepAddr . '&sensor=false' );

			$output = json_decode( $geocode );

			$lat = $output->results[ 0 ]->geometry->location->lat;
			$lng = $output->results[ 0 ]->geometry->location->lng;
			$i++;
		}
			
			if ( $lat == null || $lng == null ) {
			echo "<script language='javascript'>
		alert('Non è stato possibile rilevare la posizione: Indirizzo non valido.');
		window.location.href='index.php?pagina=/registrato/account.php';
		</script>";
			}
			
		}
		
		
		
		
		if($conn){
				
		$sql = 'select * from segnalazione where latitudine<"'.$lat.'"+"'.$diff.'" && latitudine>"'.$lat.'"-"'.$diff.'"&& longitudine <"'.$lng.'"+"'.$diff.'" && longitudine > "'.$lng.'"-"'.$diff.'" ';
			
		$result = mysqli_query( $conn, $sql );
				if ( isset( $result ) ) {
					
					if ( mysqli_num_rows( $result ) > 0 ) {
						
						//stampa intestazione table
						echo'<table>';
						
						echo'<tr>';
						echo'<td>Attivita</td><td>CDT</td><td>Titolo</td><td>Descrizione</td><td>Stato</td><td>Indirizzo</td>';
						echo'</tr>';
						
						//ciclo e stampa valori trovati
						while ( $rows = mysqli_fetch_assoc( $result ) ) {
							
							
						echo'<tr>';
							echo '<td align = "center"> 
				<form action="./index.php?pagina=registrato/utente/gestioneSegnalazione/segnalazione.php&cdt=' . $rows[ 'cdt' ] . '"  method="POST"> 
				<input type="submit" name value="Mostra">
		</form>';
						echo'<td>'.$rows['cdt'].TDTD.$rows['titolo'].TDTD.$rows['descrizione'].TDTD.$rows['stato'].TDTD.$rows['indirizzo'].'</td>';
						echo'</tr>';	
				
						
						}
						
					}else{
						//stampa messaggio se non trova segnalazioni vicine
						echo'<center><div class="content"><p><h3>Non ci sono segnalazioni vicine</h3></p></div></center><br><br>';
					
					}
					
					
				}
				
			}else{
				echo'Impossibile connettersi al database, Riprovare.';
			}
		
		
		
		}
	}
echo'</table></div>';	
echo'<div><center><h3>Ecco un mappa con tutte le segnalazioni nel nostro sistema</h3></center></div><br>';
echo'<iframe width="100%" height="400px" src="https://citizengo.altervista.org/pagine/registrato/mappa/mappa.php"></iframe>';
echo'					</div></main></div></div>
</body>
</html>	';
	
?>

