<?php
		
        include ("metodos.php");

        $obj=new metodos();

        if(isset($_SESSION['usuario']))
        {

        }
        else
        {
            echo "no hay";
        }

        $con = mysqli_connect("localhost", "root", "", "kartenspiel");  
        $consulta = mysqli_query($con, "select partidas_g from usuarios where Usuario = '".$_SESSION['usuario']."'");
    	if($row = mysqli_fetch_array($consulta, MYSQLI_ASSOC)){
			$x = $row['partidas_g'];
		}
		//session_start();
		function ganadas(){
            $con = mysqli_connect("localhost", "root", "", "kartenspiel");
            $consulta = mysqli_query($con, "select partidas_g from usuarios where Usuario='".  $_SESSION['usuario']  ."'");
            if ($row = mysqli_fetch_array($consulta, MYSQLI_ASSOC)){ 
               do { 
                    return "".$row["partidas_g"]."";
                } while ($row = mysqli_fetch_array($consulta, MYSQLI_ASSOC)); 
            } 
            else { 
                echo "¡ No se ha encontrado ningún registro !"; 
            } 
        }

		function perdidas(){  
    	$con = mysqli_connect("localhost", "root", "", "kartenspiel"); 
            $consulta = mysqli_query($con, "select partidas_p from usuarios where Usuario='".  $_SESSION['usuario']  ."'");
            if ($row = mysqli_fetch_array($consulta, MYSQLI_ASSOC)){ 
               do { 
                    return $row["partidas_p"]; 
                } while ($row = mysqli_fetch_array($consulta, MYSQLI_ASSOC)); 
            } 
            else { 
                echo "¡ No se ha encontrado ningún registro !"; 
            }
		}
	$PG=ganadas();
	$PP=perdidas();
    ?>

<html>
	<head>
		<link rel="stylesheet" type="text/css" href="css/estilos.css">
		<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>logros</title>

        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
        <style type="text/css">
        ${demo.css}
        </style>
        <script type="text/javascript">
    $(function () {
        
    Highcharts.setOptions({
        colors: ['#4A9C32', '#CD1920']
    });

    // Build the chart
    $('#container').highcharts({

        chart: {
            backgroundColor: "#77966D",
            plotBackgroundImage: 'img/url.jpg',
            plotBorderWidth: 6,
            plotShadow: false,
            type: 'pie'
        },
        credits: {
            enabled: false
        },

        title: {
            text: 'Partidas',
            style: {"color": "#FFFFFF"}
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
               // allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    style: {
                        color: '#3F7CAC'
                    },
                    connectorColor: '#3F7CAC'
                }
            }
        },
        series: [{
            name: 'Partidas',
            data: [
                { name: 'Ganadas', y: <?php echo $PG;?>},
                {
                    name: 'Perdidas',
                    y: <?php echo $PP;?>,
                   
                },
            ]
        }]
    });
});
        </script>
	</head>
	<body background="img/url.jpg">
		
		<center><h1>LOGROS</h1></center><br>
		
		<div class="logros">
		<table >

			<tr >
				<td><h2>Te la regalamos</h2></td>
				<td><center><img align= "center" class='logros' src='img/Carta_1_1.jpg' width='60px' height='90px'></center></td>
				<td><img class='logros' src='img/si.png' width='50px' height='50px'></td>
			</tr>
			<tr>
				<td colspan=3>
					<center><img class='logros' src='img/linea.png' width='580px' height='25px'></center>
				</td>
			</tr>
			<tr>
				<td><h2>Te lo ragalamos</h2></td>
				<td><center><img align= "center" class='logros' src='img/Fondo_1.jpg' width='90px' height='90px'></center></td>
				<td><img class='logros' src='img/si.png' width='50px' height='50px'> </td>
			</tr>
			<tr>
				<td colspan=3>
					<center><img class='logros' src='img/linea.png' width='580px' height='25px'></center>
				</td>
			</tr>
			<tr>
				<td><h2>Tienes que ganar 5 o mas partidas</h2></td>
				<td><center><img class='logros' src='img/Carta_2_1.jpg' width='60px' height='90px'></center></td>
				<td><?php
					if($x > 4){
						echo "<img class='logros' src='img/si.png' width='50px' height='50px'>";
					}
					else{
						echo "<img class='logros' src='img/no.png' width='50px' height='50px'>";
					}
				?></td>
			</tr>
			<tr>
				<td colspan=3>
					<center><img class='logros' src='img/linea.png' width='580px' height='25px'></center>
				</td>
			</tr>
			<tr>
				<td><h2>Tienes que ganar 10 o mas partidas</h2></td>
				<td><center><img align= "center" class='logros' src='img/Fondo_2.jpg' width='90px' height='90px'></center></td>
				<td><?php
					if($x > 9){
						echo "<img class='logros' src='img/si.png' width='50px' height='50px'>";
					}
					else{
						echo "<img class='logros' src='img/no.png' width='50px' height='50px'>";
					}
				?></td>
			</tr>
			<tr>
				<td colspan=3>
					<center><img class='logros' src='img/linea.png' width='580px' height='25px'></center>
				</td>
			</tr>
			<tr>
				<td><h2>Tienes que ganar 15 o mas partidas </h2></td>
				<td><center><img class='logros' src='img/Carta_3_1.jpg' width='60px' height='90px'></center></td>
				<td><?php
					if($x > 14){
						echo "<img class='logros' src='img/si.png' width='50px' height='50px'>";
					}
					else{
						echo "<img class='logros' src='img/no.png' width='50px' height='50px'>";
					}
				?></td>
			</tr>
			<tr>
				<td colspan=3>
					<center><img class='logros' src='img/linea.png' width='580px' height='25px'></center>
				</td>
			</tr>
			<tr>
				<td><h2>Tienes que ganar 20 o mas partidas</h2></td>
				<td><center><img align= "center" class='logros' src='img/Fondo_3.jpg' width='90px' height='90px'></center></td>
				<td><?php
					if($x > 19){
						echo "<img class='logros' src='img/si.png' width='50px' height='50px'>";
					}
					else{
						echo "<img class='logros' src='img/no.png' width='50px' height='50px'>";
					}
				?></td>
			</tr>
		</table>
		</div>
		
		<br>
		<br>
		<!--<script src="https://code.highcharts.com/highcharts.js"></script>
		<div id="container" style="min-width: 310px; height: 400px;width:700px; max-width: 600px; margin: 0 auto;  margin-left: 700px; margin-right: auto; margin-top: 0px"></div>
		-->
	</body>



</html>