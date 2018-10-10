<html>

<body>
	<div id="main" class="wrapper style1">
		<div class="container">
			<header class="major">
				<h2>Enti inseriti</h2>
				<p>Qui puoi visualizzare, modificare ed eliminare i tuoi enti</p>
			</header>
		</div>


		<!-- Table -->
		<section>



			<!-- ################################################################################################ -->
			<!-- ################################################################################################ -->
			<div class="wrapper row3">
				<main class="hoc container clear">
					<!-- main body -->
					<!-- ################################################################################################ -->
					<div class="content" style="overflow-x:auto;">
						<!-- ################################################################################################ -->
						<table class="table">

							<tr>
								<th align="center" colspan="2">Attivit&agrave;</th>
								<th align="center"> codice </th>
								<th align="center"> username </th>
								<th align="center"> email </th>
								<th align="center"> password </th>
								<th align="center"> nome </th>


							</tr>

							<?php 
		include './pagine/registrato/connect.php';
		include './pagine/funzioni/amministrazione.php';
								
  if($conn) {
     viewFigli( "comune", $conn );
	 mysqli_close( $conn );
  }
		 else
		 {
			 echo "impossibile connettersi";
		 }
?>
						</table>
					</div>
					<!-- ################################################################################################ -->
					<!-- / main body -->
					<div class="clear"></div>
				</main>
			</div>
		</section>

		<!-- ################################################################################################ -->
		<!-- ################################################################################################ -->
		<!-- ################################################################################################ -->


</body>

</html>
<script>
	function confirm_update() {
		if ( confirm( "Sei sicuro che vuoi eliminare l'ente?\n(COSÌ FACENDO ELIMINERAI ANCHE I GRUPPI  AD ESSO ASSOCIATI)" ) ) {
			return true;
		} else {
			return false;
		}
	}
</script>