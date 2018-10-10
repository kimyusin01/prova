	<?php
		session_start();
include '../../../connect.php';
include '../../../../funzioni/amministrazione.php';

if ( isset( $_POST[ 'creazione' ] ) ) {

	//get the name and comment entered by user
	
	$username =strtolower( $_POST[ 'username' ]);
	$email = strtolower($_POST[ 'email' ]);
	$password = $_POST[ 'password' ];
	
	
	$array=array(0,0);
	
	
	
	
	if($conn)
	{
		$errore = creaUteGrup( $username, $password, $email, $_SESSION['codiceAccount'], $conn );
		
		
		
		
	mysqli_close( $conn );
		if(!$errore) {
		echo'<script>
				window.location = "../../../../../index.php?pagina=registrato/attivitaAmministrativa/ente/gestioneGruppo/create.html";
				</script>';
		}
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