<?php

if (isset($_POST["clave"]) && isset($_POST["usuario"]) && isset($_POST["correo"]) && isset($_POST["edad"]) && isset($_POST["nombre"]) ) {
		$con = mysqli_connect("localhost", "root", "kartenspiel", "kartenspiel");
		$sql = "SELECT * FROM usuarios WHERE correo = '".$_POST["correo"]."' OR Usuario = '".$_POST["usuario"]."' ";
        $consulta = mysqli_query($con, $sql);

        if(mysqli_fetch_array($consulta, MYSQLI_ASSOC) == 0){
            $codigo = rand(1000, 9999);
            $para      = "".$_POST["correo"]."";
            $titulo    = 'Confirmacion de Correo';
            $mensaje   = 'Favor de confirmar el correo ingresado para el registro de este correo con el codigo siguiente: '.$codigo.'';
            $mensaje   = wordwrap($mensaje, 70);
            $cabeceras = 'From: KartenSpiel <kartenspiel.soporte@gmail.com>'."\r\n";
            
            if(mail($para, $titulo, $mensaje, $cabeceras)){
            	echo "<script>alert('Se envio el codigo');</script>";
            }
            else{
                echo "<script>alert('no se envio el codigo');</script>";
            }
            echo "".$codigo."";
            $sql2 ="SELECT * FROM codigo WHERE Usuario = '".$_POST["usuario"]."'";
            $consulta2 = mysqli_query($con, $sql2);
            if($row = mysqli_fetch_array($consulta2, MYSQLI_ASSOC)){
                $sql3="UPDATE `codigo` SET `Codigo`= '".$codigo."' WHERE Id =".$row["Id"]."";
                mysqli_query($con, $sql3);
            }
            else{
                $sql3 = "INSERT INTO `codigo`(`Id`, `Usuario`, `Codigo`) VALUES ('NULL', '".$_POST["usuario"]."',".$codigo.")";
                if (mysqli_query($con, $sql3)) {
                
                }
                else{
                    echo "<script>alert('no se agrego el codigo');</script>";
                }
            }
            
            
        }
        else{
            echo "  <META HTTP-EQUIV='REFRESH' CONTENT='0;URL=registro.php'> ";
            echo "<script>alert('Ya existe alguien con este correo o nombre de usuario');</script>";
        }
            
    }
    else{
        echo "  <META HTTP-EQUIV='REFRESH' CONTENT='0;URL=registro.php'> ";
    }



?>


<HTML>

	<HEAD>
        <TITLE>Confirmacion</TITLE>
        <link type='image/png' rel="icon" href="img/KartenSpiel_icono.png">
        <link rel="stylesheet" type="text/css" href="css/estilos.css">

    </HEAD>


    <BODY background="img/url.jpg">

        <HEADER>
        </HEADER>

        <NAV>
        </NAV>

        <SECTION class="registro">
            <h1 align="center">Confirmacion</h1>
            <hr size=1 width=50% align="center">
            <br>
            <form action = "metodos.php" method="post">
            <center> 
                <?php
                echo "<form action='metodos.php' method='post'>";
                    echo "<input type='hidden' name='action' value='registrar'> ";
                    echo "<input type='hidden' name='clave' value='".$_POST["clave"]."'> ";
                    echo "<input type='hidden' name='usuario' value='".$_POST["usuario"]."'> ";
                    echo "<input type='hidden' name='correo' value='".$_POST["correo"]."'> ";
                    echo "<input type='hidden' name='edad' value='".$_POST["edad"]."'> ";
                    echo "<input type='hidden' name='nombre' value='".$_POST["nombre"]."'> ";
                    echo '<input name = "codigo" type="text" placeholder="Codigo">';
                    echo "<input type='submit' value='Confirmar'>";
                echo "</form>";
                ?>
            </form>
            <br><br>
            <h2 style="font-family: Charcoal, sans-serif;">El correo enviado puede llegar a los correos no deseados o como SPAM</h2>
            </center>
            <br>
        </SECTION>

</HTML>