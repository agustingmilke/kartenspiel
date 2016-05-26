<!DOCTYPE html>
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
        $consulta = mysqli_query($con, "select Amigo from amigos where Usuario='".  $_SESSION['usuario']  ."'");
    

    ?>

<HTML lang="es">


    <HEAD>
        <TITLE>Login</TITLE>
        <link type="image/png" rel="icon" href="img/KartenSpiel_icono.png">
        <link rel="stylesheet" type="text/css" href="css/estilos.css">

    </HEAD>


    <BODY background="img/url.jpg">

        <HEADER>
        </HEADER>

        <NAV>
        </NAV>

        <SECTION class="amigos">
        	
            <div>
                <?php
                    if ($row = mysqli_fetch_array($consulta, MYSQLI_ASSOC)){ 
                       do { 
                            echo "<center><h1>Amigo: ".$row["Amigo"]."</h1><br>";
                            echo "<input class='bMenu' type=button value='Invitar a partida'></center><br><br>";
                            echo "<center><img class='logros' src='img/linea.png' width='600px' height='25px'></center>"; 
                        } while ($row = mysqli_fetch_array($consulta, MYSQLI_ASSOC)); 
                    } 
                    else { 
                        echo "<center><h1>No hay amigos</h1></center><br>"; 
                    }
                ?>
            </div>
            <br><br>
            <form action="agregar.php" method="post">
                <center><input name = "amigo" type='text' placeholder='Buscar un amigo'><input class="bMenu" style="width:130px ;"type='submit' value='Agregar'></center>
            </form>

        </SECTION>

        <FOOTER>
        </FOOTER>
    
    </BODY>


</HTML>
