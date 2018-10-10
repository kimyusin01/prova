<?php
if(isset($_GET['pagina']))
	{
		$pagina=$_GET['pagina'];
		if( file_exists('./pagine/'.$pagina))
	{
	 include('./pagine/'.$pagina);

	}
		}
	   else
	{
		 
		 include('pagine/home.html');
	}

?>