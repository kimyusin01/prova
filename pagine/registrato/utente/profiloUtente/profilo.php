<?php echo'<html>

<head>
	

</head>



<body>



	<!-- Main -->
	<div id="main" class="wrapper style1">
		<div class="container">
			<header class="major">
				<center>
					<h2>I tuoi dati</h2>
				</center>
			</header>




			<!-- Content -->

			<!-- ################################################################################################ -->


		

		<div class="wrapperrow3">
			<main class="hoc container clear">
				<!-- main body -->
				<!-- ################################################################################################ -->
				<div class="content">';


					
					echo '<center>';
					
					include './pagine/registrato/connect.php';
					include './pagine/funzioni/amministrazione.php';
					if ( $conn ) {
						$codice=$_SESSION["codiceAccount"];
	
					visualizzaProfilo("utente", $codice, $conn);
						mysqli_close( $conn );
					} else {
						echo "impossibile connettersi";
					}
					echo '
					<form action="./index.php" method="">
					<input type="hidden"  name="pagina" value="registrato/account.php">
					<input type="submit" value="Indietro" >
					</form>';
					echo '</center>';
					echo'</div>
                    </main>
		</div>
        </div>
        </div>
</body>

</html>';
				
?>