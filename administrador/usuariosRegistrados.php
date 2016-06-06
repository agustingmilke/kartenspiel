
<?php
	require_once ('../jpgraph/jpgraph.php');
	require_once ('../jpgraph/jpgraph_line.php');
	session_start();
    if(isset($_SESSION['usuario']))
    {

    }
    else
    {
        //echo "no hay";
    }

    $con = mysqli_connect("localhost", "root", "kartenspiel", "kartenspiel");
    //$consulta = mysqli_query($con, "select * from amigos where Usuario='".$_SESSION['usuario']."'");
    
    $consulta = mysqli_query($con, "select * from registros");
    $consulta2 = mysqli_query($con, "Select Year From registros Group By Year Having Count(*) > 1 Order By Year");
    $año = array();
    $cont = 0;
    if ($row = mysqli_fetch_array($consulta, MYSQLI_ASSOC)){ 
    	do{
	        $num[$row["Year"]][$cont] = (int)$row["Num"];
	        $cont++;
	        if($cont ==12){
	        	$cont=0;
	        }
	    }while($row = mysqli_fetch_array($consulta, MYSQLI_ASSOC));
    } 
    if ($row2 = mysqli_fetch_array($consulta2, MYSQLI_ASSOC)){ 
	    do{
	        array_push($año, $row2["Year"]);
	    }while($row2 = mysqli_fetch_array($consulta2, MYSQLI_ASSOC));
	}
    else { 
        echo "¡ No se ha encontrado ningún registro !"; 
    }

    $cant = count($año);

	$graph = new Graph(900,350,"auto");
	$graph->SetScale("textlin");

	$theme_class=new UniversalTheme;

	$graph->SetTheme($theme_class);
	$graph->img->SetAntiAliasing(false);
	$graph->title->Set('Registro de Usuarios en KartenSpiel');
	$graph->SetBox(false);

	$graph->img->SetAntiAliasing();

	$graph->yaxis->HideZeroLabel();
	$graph->yaxis->HideLine(false);
	$graph->yaxis->HideTicks(false,false);

	$graph->xgrid->Show();
	$graph->xgrid->SetLineStyle("solid");
	$graph->xaxis->SetTickLabels(array('Ene','Feb','Mar','Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Nov', 'Oct', 'Dic'));
	$graph->xgrid->SetColor('#E3E3E3');

	// Create the first line
	for($i =0; $i<$cant; $i++){
		$data = $num[$año[$i]];
		$p1 = new LinePlot($data);
		
		$p1->SetColor("#6495ED");
		$p1->SetLegend('Año:'.$año[$i].'');
		$graph->Add($p1);	
	}

	$graph->legend->SetFrameWeight(1);

	// Output line
	//$graph->Stroke();
	@unlink("registros.png");
	
	$graph->Stroke("registros.png");
    ?>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="estilo_administrador.css">
		<link type="image/png" rel="icon" href="img/KartenSpiel_icono.png">
		<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
	</head>
	<body background="img/url.jpg ">
		<header>

			<br>
			<form method="post" action="metodos.php"  style="display:inline;">
				<input type="hidden" name="action" value="cerrar_sesion">
				<input class="bMenu" type="submit" value="Cerrar Sesion" style="font-size:15px; padding:2px 2px; margin-top:0px; margin-left:30px; position:absolute; width: 130px; height: 32px">
			</form>
			<center><h1 class="header">KartenSpiel</h1><br><br></center>

		</header>
		<nav>
				
			<div id ="menu">
				<ul>
					<li><a href="usuarios.php"> Usuarios</a></li>
					<li><a href="comentarios.php"> Comentarios</a></li>
					<li><a href="usuariosRegistrados.php"> Registros</a></li>
					<li><a href="partidasJugadas.php"> Partidas</a></li>
				</ul>
			</div>
			
		</nav>
		<section>
			<br><br>
			<img class="registros" src="registros.png" alt="" border="0">
		</section>
		


	</body>
</html>