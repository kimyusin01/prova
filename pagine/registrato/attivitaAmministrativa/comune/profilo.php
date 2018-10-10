<?php
echo'
	<!-- Main -->
	<div id="main" class="wrapper style1">
		<div class="container">
			<header class="major">
				<center>
					<h2>I tuoi dati</h2>
				</center>
			</header>






		</div>

		<div class="wrapperrow3">
			<main class="hoc container clear">
				<!-- main body -->
				<!-- ################################################################################################ -->
				<div class="content">';

					
					echo '<center>';
					include './pagine/funzioni/amministrazione.php';
					include './pagine/registrato/connect.php';
					if ( $conn ) {
						$codice=$_SESSION["codiceAccount"];
	
				visualizzaProfilo("comune", $codice, $conn);


						mysqli_close( $conn );
					} else {
						echo "impossibile connettersi";
					}
					echo '
					<form action="./index.php" method="">
					<input type="hidden"  name="pagina" value="registrato/account.php">
					<input type="submit" value="Indietro" >
					</form>';
					echo '</center>
					
				</div>
                </main>
		</div>

		</div>';
?>