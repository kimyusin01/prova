	<?php

	include './pagine/registrato/connect.php';
	include './pagine/registrato/utente/profiloUtente/edit.html';
	include './pagine/funzioni/amministrazione.php';
	if ( isset( $_POST[ 'Modifica' ] ) ) {

		//get the name and comment entered by user
		$codice = $_GET[ 'codice' ];
		$username = strtolower( $_POST[ 'username' ] );
		$email = strtolower( $_POST[ 'email' ] );
		$password = $_POST[ 'password' ];
		modificaAccountGruppoUtente( "utente", $conn, $codice, $username, $email, $password );
		
		mysqli_close( $conn );	

			
			echo '<script>
				window.location = "./index.php?pagina=registrato/utente/profiloUtente/profilo.php";
				</script>';


	}


	
	?>