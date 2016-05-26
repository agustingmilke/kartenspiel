
<?php
	require_once ('jpgraph/jpgraph.php');
	require_once ('jpgraph/jpgraph_line.php');
	session_start();
    if(isset($_SESSION['usuario']))
    {

    }
    else
    {
        echo "no hay";
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
	$graph->title->Set('Registros en KartenSpiel');
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
	$graph->Stroke();
	$graph->Stroke("registros.png");
    ?>
