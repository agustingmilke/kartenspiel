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

        $con = mysqli_connect("localhost", "root", "kartenspiel", "kartenspiel");  
        $consulta = mysqli_query($con, "select partidas_g from usuarios where Usuario = '".$_SESSION['usuario']."'");
    	if($row = mysqli_fetch_array($consulta, MYSQLI_ASSOC)){
			$x = $row['partidas_g'];
		}

    ?>

<html>
	<head>
		<link rel="stylesheet" type="text/css" href="css/estilos.css">
		<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
	</head>
	<body background="img/url.jpg">
		<center><h1>LOGROS</h1></center><br>
		<table>
			<tr >
				<td>Te la regalamos</td>
				<td><center><img align= "center" class='logros' src='img/Carta_1_1.jpg' width='60px' height='90px'></center></td>
				<td><img class='logros' src='img/si.png' width='50px' height='50px'></td>
			</tr>
			<tr>
				<td colspan=3>
					<img class='logros' src='img/linea.png' width='700px' height='20px'>
				</td>
			</tr>
			<tr>
				<td>Te lo ragalamos</td>
				<td><center><img align= "center" class='logros' src='img/Fondo_1.jpg' width='90px' height='90px'></center></td>
				<td><img class='logros' src='img/si.png' width='50px' height='50px'> </td>
			</tr>
			<tr>
				<td colspan=3>
					<img class='logros' src='img/linea.png' width='700px' height='20px'>
				</td>
			</tr>
			<tr>
				<td>Tienes que ganar 5 o mas partidas</td>
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
					<img class='logros' src='img/linea.png' width='700px' height='20px'>
				</td>
			</tr>
			<tr>
				<td>Tienes que ganar 10 o mas partidas</td>
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
					<img class='logros' src='img/linea.png' width='700px' height='20px'>
				</td>
			</tr>
			<tr>
				<td>Tienes que ganar 15 o mas partidas</td>
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
					<img class='logros' src='img/linea.png' width='700px' height='20px'>
				</td>
			</tr>
			<tr>
				<td>Tienes que ganar 20 o mas partidas</td>
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


	</body>



</html>