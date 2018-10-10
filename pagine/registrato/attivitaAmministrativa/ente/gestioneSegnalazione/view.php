<?php echo'<html>

<head>



</head>

<body>
	<!-- Main -->
	
	<script>
	
	</script>
	
	
	<div id="main" class="wrapper style1">
		<div class="container">
			<header class="major">
				<h2>Visualizza segnalazioni</h2>';
echo "
				<p>Qui puoi visualizzare e modificare lo stato e l'assegnatario delle segnalazioni</p>
			</header>
			<div>
				<center>
					<h2>Seleziona lo stato delle segnalazioni che vuoi visualizzare:</h2>
				</center>
			</div>
			<div>";

				
		include './pagine/registrato/connect.php';
				include './pagine/funzioni/segnalazioni.php';
  if($conn) {
	  $ente = $_SESSION["codiceAccount"];
	 $proprieta= stampaListaSegnalazioni( $conn, "ente", $ente);

	
					mysqli_close( $conn );
					}
					else {
						echo "impossibile connettersi";
					}
				echo "</table></div>";
		

			

if($proprieta=="tutte")
{

	echo'<iframe width="100%" height="600px" src="./pagine/registrato/mappa/mappa.php"></iframe>';
}


echo'		

			
			<!-- ################################################################################################ -->


		</div>
		<!-- ################################################################################################ -->
		<!-- ################################################################################################ -->
		<!-- ################################################################################################ -->
	</div>
	</div>

</body>

</html>';
?>