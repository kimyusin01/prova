	<?php

	include './pagine/registrato/connect.php';
	include './pagine/registrato/attivitaAmministrativa/ente/edit.html';
	include './pagine/funzioni/amministrazione.php';

	if ( isset( $_POST[ 'Modifica' ] ) ) {

		//get the name and comment entered by user
		$codice = $_GET[ 'codice' ];
		$username = strtolower( $_POST[ 'username' ] );
		$email = strtolower( $_POST[ 'email' ] );
		$password = $_POST[ 'password' ];
		$nome = strtolower( $_POST[ 'nome' ] );

		modificaAccountComEnte( "ente", $conn, $codice, $username, $email, $password, $nome );
		mysqli_close( $conn );
		echo '<script>
				window.location = "./index.php?pagina=registrato/attivitaAmministrativa/ente/profilo.php";
				</script>';
	}


	?>