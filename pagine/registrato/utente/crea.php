<?php
session_start();
include './../connect.php';
include './../../funzioni/amministrazione.php';
if ( isset( $_POST[ 'creazione' ] ) ) {

	//get the name and comment entered by user

	$username = strtolower( $_POST[ 'username' ] );
	$email = strtolower( $_POST[ 'email' ] );
	$password = $_POST[ 'password' ];

	if ( $conn ) {
		$errore = creaUteGrup( $username, $password, $email, null, $conn );

		mysqli_close( $conn );
		if($errore) {
			echo'<script>
				window.location = "../../../index.php?pagina=registrato/utente/create.html";
				</script>';
		}
		else {
		echo'<script>
				window.location = "../../../index.php?pagina=registrato/login.php&account=utente";
				</script>';
		}
	} else {
		echo "Connessione database fallita";
	}
} else {
	echo "Non hai i diritti per svolgere questa operazione";
}
?>