<?php
include '../connect.php';

function parseToXML($htmlStr)
{
$xmlStr=str_replace('<','&lt;',$htmlStr);
$xmlStr=str_replace('>','&gt;',$xmlStr);
$xmlStr=str_replace('"','&quot;',$xmlStr);
$xmlStr=str_replace("'",'&#39;',$xmlStr);
$xmlStr=str_replace("&",'&amp;',$xmlStr);
return $xmlStr;
}

// Opens a connection to a MySQL server


if($conn){

session_start();

 
$codiceAccount=$_SESSION["codiceAccount"];
$tipoAccount=$_SESSION["codice"];
	
	$condizione = null;
switch($tipoAccount){
		case 2:
		$condizione = 'where comune="'.$codiceAccount.'"';		break;
		case 3:
		$condizione = 'where ente="'.$codiceAccount.'"';	break;
		case 4:
		$condizione=' where gruppo="'.$codiceAccount.'"'; break;
		default:	break;
		
}	
 
// Select all the rows in the markers table
$sql = 'select * from segnalazione ' . $condizione.'';
	
    $result = mysqli_query($conn, $sql);
if (!$result) {
  die('Invalid query: ' . mysqli_error());
}

header("Content-type: text/xml");

// Start XML file, echo parent node
echo "<?xml version='1.0' ?>";
echo '<markers>';
$ind=0;
// Iterate through the rows, printing XML nodes for each
while ($row = @mysqli_fetch_assoc($result)){
  // Add to XML document node
 echo '<marker ';
  echo 'id="' . $row['cdt'] . '" ';
  echo 'name="' . $row['titolo'] . '" ';
  echo 'address="' . parseToXML($row['indirizzo']) . '" ';
  echo 'lat="' . $row['latitudine'] . '" ';
  echo 'lng="' . $row['longitudine'] . '" ';
  echo 'type="' . $row['gravita'] . '" ';
 
  echo '/>';
  $ind = $ind + 1;
}

// End XML file
echo '</markers>';

}else{

session_start();


}


?>