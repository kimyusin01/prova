	<?php
		session_start();
include '../../../connect.php';
include '../../../../funzioni/amministrazione.php';
if ( isset( $_POST[ 'creazione' ] ) ) {

	//get the name and comment entered by user
	$codice = strtoupper($_POST[ 'codice' ]);
	$username =strtolower( $_POST[ 'username' ]);
	$email = strtolower($_POST[ 'email' ]);
	$password = $_POST[ 'password' ];
	$nome = strtolower($_POST[ 'nome' ]);
		
	
	if($conn)
	{
		creaComEnte($username, $password, $email, $nome, $codice , $conn);
		mysqli_close( $conn );
		echo'<script>
				window.location = "../../../../../index.php?pagina=registrato/attivitaAmministrativa/amministratore/gestioneComune/create.html";
				</script>';
	}
	else
	{
		echo "Connessione database fallita";
	}
}
else
{
	echo "Non hai i diritti per svolgere questa operazione";
}
?>