<?php
	session_start();
	$con = mysqli_connect("localhost", "root", "kartenspiel", "kartenspiel");  
    $consulta = mysqli_query($con, "select * from baneados where Usuario='".  $_SESSION["baneado"]  ."'");
    if($row = mysqli_fetch_array($consulta, MYSQLI_ASSOC)){
    	$mensaje = $row["Mensaje"];
    }
?>
<HTML>

    <HEAD>
        <TITLE>Registro</TITLE>
        <link type='image/png' rel="icon" href="img/KartenSpiel_icono.png">
        <link rel="stylesheet" type="text/css" href="css/estilos.css">
    </HEAD>


    <BODY background="img/url.jpg">

        <HEADER>
        </HEADER>

        <NAV>
        </NAV>

        <SECTION class="registro">
        	<h1 align="center">Has sido baneado</h1>
            <hr size=1 width=50% align="center">
            <center><h2>En breve, redactamos el motivo por el que has sido baneado:</h2><br></center>
            <center><h3><?php echo $mensaje; ?></h3></center>
        </SECTION>

        <FOOTER>
        </FOOTER>
    
    </BODY>

</HTML>
