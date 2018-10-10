<!DOCTYPE HTML>

<!--
	Landed by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<?php
session_start();

if ( empty( $_SESSION ) ) {
	$_SESSION[ "codice" ] = 0;
}


echo'<html>';
include 'componentiPagine/title.html';
echo'<body class="is-preload landing">
		<div id="page-wrapper">';
// Header 
include 'componentiPagine/header.php';
include 'componentiPagine/body.php';
// Footer 
include 'componentiPagine/footer.html';
echo'</div>';
//Scripts 
include 'componentiPagine/script.html';
	echo'</body>
</html>';
?>

	