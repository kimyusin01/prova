		  <?php 
		 
	include './pagine/registrato/connect.php';
	if($conn)
	{
	if(isset($_GET['codice']))
	{
		$codice = $_GET['codice'];

		
		$sql = "delete from ente where codice = '" . $codice . "'";
		if (mysqli_query($conn, $sql)) {
			$sql = "UPDATE segnalazione
								  SET stato = 'in attesa'
								  WHERE ente is null";
			mysqli_query($conn, $sql);
			mysqli_close($conn);				
			echo'<script>
				window.location = "./index.php?pagina=registrato/attivitaAmministrativa/comune/gestioneEnte/view.php";
				</script>';
			
		} else {
			echo "Non e' possibile eliminare.";

		}
	
	}
}
else{
	echo "impossibile connettersi al database";
}
	
	




    echo'
    </div>
 
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
