<?php
echo'<html>

<head>

</head>

<body>
	<!-- Main -->
	<div id="main" class="wrapper style1">
		<div class="container">
			<header class="major">
				<h2>Visualizza Statistiche</h2>
				<p>Qui puoi vedere le statistiche sulle segnalazioni</p>
			</header>
<div class="content" style="overflow-x:auto;">
	
	
	
				<table class="table">

					<tr>
						
						<th align="center"> Totale Segnalazioni Ricevute </th>
						
						<th align="center"> Segnalazioni assegnate </th>
						
						<th align="center"> Segnalazioni chiuse </th>
						
					</tr>
';
		include './pagine/registrato/connect.php';
  if($conn) {
	  
	  $gruppo = $_SESSION["codiceAccount"];
	  
    
	  
	$totSegnalazioni=0;
	$segnRisolte=0;
	$segnAssegnata=0;  
	$PercSegnRisolte=0;
	$PercSegnAssegnata=0;
	
	  
	  	
	  	
	
	  $sql = 'select count(*) as tot from segnalazione where gruppo = "' . $gruppo  .'"';
	  $result = mysqli_query($conn, $sql);
	  $rows = mysqli_fetch_assoc($result);
	  $totSegnalazioni=$rows['tot'];

	  $sql = 'select count(*) as tot from segnalazione where gruppo = "' . $gruppo  .'" and stato="chiusa"';
	  $result = mysqli_query($conn, $sql);
	  $rows = mysqli_fetch_assoc($result);
	  $segnRisolte=$rows['tot'];      
	 
	 
	  	  
	  
	  $sql = 'select count(*) as tot from segnalazione where gruppo = "' . $gruppo  .'" and stato="assegnata"';
	  $result = mysqli_query($conn, $sql);
	  $rows = mysqli_fetch_assoc($result);
	  $segnAssegnata=$rows['tot'];    	  
	  
	  
	  
	  if($totSegnalazioni!=0)
	  {
	  
		 	//calcolo percentuali
			$PercSegnRisolte=(100*$segnRisolte)/$totSegnalazioni;
			
			
			$PercSegnAssegnata=100*$segnAssegnata/$totSegnalazioni;
	  	// formatto i numeri per avere due cifre dopo la virgola
	  
		$PercSegnRisolte=number_format( $PercSegnRisolte, 2);
	  
	  	
	  	$PercSegnAssegnata=number_format( $PercSegnAssegnata, 2);
		  //stampa tabella
		  }
		  echo"<tr>
		  		<td align='center'>$totSegnalazioni</td>
		  		
				<td align='center'>$segnAssegnata</td>
				<td align='center'>$segnRisolte</td>
				
				
		  </tr>";
		  
		  
		  
    }
	
		else
		 {
			 echo "impossibile connettersi";
		 }

		echo'		</table>
			</div>
			
	<h3>Rappresentazione in grafico a barre</h3>
	<div background-color:transparent id="piechart"></div>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/data.js"></script>
<script src="https://code.highcharts.com/modules/drilldown.js"></script>

<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
 

		</div>
	</div>
	<!-- ################################################################################################ -->
	<!-- ################################################################################################ -->
	<!-- ################################################################################################ -->


</body>

</html>';
		?>
<script>


var PercSegnAssegnata=<?php echo $PercSegnAssegnata?>;
var PercSegnRisolte=<?php echo $PercSegnRisolte?>;
		  		
	// Create the chart
Highcharts.chart('container', {
  chart: {
    type: 'column'
  },
  title: {
    text: 'Statistiche segnalazioni'
  },
  subtitle: {
    
  },
  xAxis: {
    type: 'category'
  },
  yAxis: {
    title: {
      text: 'Percentuali totali delle segnalazioni'
    }

  },
  legend: {
    enabled: false
  },
  plotOptions: {
    series: {
      borderWidth: 0,
      dataLabels: {
        enabled: true,
        format: '{point.y:.1f}%'
      }
    }
  },

  tooltip: {
    headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
    pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> del totale<br/>'
  },

  "series": [
    {
      "name": "Segnalazioni",
      "colorByPoint": true,
      "data": [
        
        {
          "name": "Assegnate",
          "y": PercSegnAssegnata,
          "drilldown": "Assegnate"
        },
       
        {
          "name": "Chiuse",
          "y": PercSegnRisolte,
          "drilldown": "Chiuse"
        },
        
      ]
    }
  ]
  
});
	


</script>


