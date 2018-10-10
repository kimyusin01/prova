<?php
echo'
<html>

<body>
	<div id="main" class="wrapper style1">
		<div class="container">
			<header class="major">
				<h2>Gruppi inseriti</h2>
				<p>Qui puoi visualizzare, modificare ed eliminare i tuoi gruppi</p>
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
									
								

								</tr>
';
								
		include './pagine/registrato/connect.php';
		include './pagine/funzioni/amministrazione.php';
  if($conn) {
	  viewFigli( "ente", $conn );
	 mysqli_close( $conn );
  }
		 else
		 {
			 echo "impossibile connettersi";
		 }

				echo'			</table>
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

</html>';?>
<script>
	function confirm_update() {
		if ( confirm( "Sei sicuro che vuoi eliminare il gruppo?\n" ) ) {
			return true;
		} else {
			return false;
		}
	}
</script>