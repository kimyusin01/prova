<!--
	Landed by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
						
		<?php
echo'
<html>
	
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">

 <link href="./cssCitizengo/visualizzaMedia.css" rel="stylesheet" type="text/css">

</head>

			<!-- Main -->
				<div id="main" class="wrapper style1">
					<div class="container">
						<header class="major">';
						
include 'funzioni/segnalazioni.php';
include 'registrato/connect.php';
if ( isset( $_POST[ 'controllo' ] ) ) {
	$cdt = $_POST[ 'cdt' ];

	if ( $conn ) {
		$sqlcdt = "select * from segnalazione where cdt = '" . $cdt . "'";
		$cdt = mysqli_query( $conn, $sqlcdt );
		if ( isset( $cdt ) ) {
			if ( mysqli_num_rows( $cdt ) > 0 ) {
				while ( $row = mysqli_fetch_assoc( $cdt ) ) {
					$descrizione = wordwrap( $row[ 'descrizione' ], 52, "\t", 1 );
					echo "
					<h2>Riepilogo segnalazione</h2>
							<p>Ecco qui la segnalazione</p>
						</header><center>
							<div class='content'>
							<p> CDT: " . $row[ 'cdt' ] . " <br>
							Titolo: " . $row[ 'titolo' ] . "<br>
							 Descrizione: " . $descrizione . "<br> 
							 Gravità: " . $row[ 'gravita' ] . "<br>
						
						
						Locazione: " . $row[ 'indirizzo' ] . " <br>
						Stato: " . $row[ 'stato' ]."<br>";
					
					
					stampaMediaSegnalazione($row['cdt'], $conn);
					
					echo "</p></div></center>";
				}
			} else {
				echo "<h2>Controlla segnalazione</h2></header>
               <center> <div class='content'>
                <p>Codice di tracking non riconosciuto.</p>
                </div></center>";
			}


		}
		
	}
}

echo'	</header></div></div>			
</html>';

		?>												
							
							
							
							
							
							
							
							
							
							

						<!-- Content -->
							
			<!-- ################################################################################################ -->
			
						
	