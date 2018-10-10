		  <?php 
		 
	include './pagine/registrato/connect.php';
	if($conn)
	{
	if(isset($_GET['codice']))
	{
		$codice = $_GET['codice'];
// sql to delete a record
		$sql = "select * from media WHERE cdt=" . $codice;
	
		if ($query=mysqli_query($conn, $sql)) {
			while ( $row = mysqli_fetch_assoc( $query ) ) {
		$path = $row[ 'percorso' ] . $row[ 'nome' ];
		unlink( $path );
			}
			$sql = "DELETE FROM segnalazione WHERE cdt=". $codice;
				
			$query = mysqli_query($conn, $sql);
			
			
			echo'<script>
				window.location = "./index.php?pagina=registrato/utente/gestioneSegnalazione/view.php";
				</script>';
			
		} else {
			echo "Non e' possibile eliminare.";

		}
	
	}
		mysqli_close($conn);
}
else{
	echo "impossibile connettersi al database";
}
	
	

echo' </div>
 
    </div>
    <!-- ################################################################################################ -->
    <!-- / main body -->
    <div class="clear"></div>
  </main>
</div>
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
</html>';

?>
   




