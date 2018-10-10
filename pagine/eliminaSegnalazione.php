<?php
include 'registrato/connect.php';

if ( isset( $_GET[ 'cdt' ] ) ) {
	
	$sql = "select * from media WHERE cdt=" . $_GET[ 'cdt' ];
	$query = mysqli_query( $conn, $sql );
	while ( $row = mysqli_fetch_assoc( $query ) ) {
		$path = $row[ 'percorso' ] . $row[ 'nome' ];
		unlink( $path );
	}
	
	$sql = "DELETE FROM segnalazione WHERE cdt=" . $_GET[ 'cdt' ];
	$query = mysqli_query( $conn, $sql );
	

}
echo '<script type="text/javascript">
window.location.href = "index.php?pagina=segnala.html";
</script>';
?>
