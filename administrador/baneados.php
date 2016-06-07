<?php
	session_start();
    if(isset($_SESSION['usuario']))
    {

    }
    else
    {
        echo "  <META HTTP-EQUIV='REFRESH' CONTENT='0;URL=../Login.php'> ";
    }

    $con = mysqli_connect("localhost", "root", "kartenspiel", "kartenspiel");  
    $consulta = mysqli_query($con, "select * from usuarios WHERE Status = 'B'");

?>
<HTML>

    <head>
        <link rel="stylesheet" type="text/css" href="estilo_administrador.css">
        <link type="image/png" rel="icon" href="img/KartenSpiel_icono.png">
        <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    </head>

    <BODY background="img/url.jpg">
        <header>

            <br>
            <form method="post" action="metodos.php">
                <input type="hidden" name="action" value="cerrar_sesion">
                <input class="bMenu" type="submit" value="Cerrar Sesion" style="font-size:15px; padding:2px 2px; margin-top:0px; margin-left:30px; position:absolute; width: 130px; height: 32px">
            </form>
            <center><h1 class="header">KartenSpiel</h1><br><br></center>

        </header>

        <nav>
                
            <div id ="menu">
                <ul>
                    <li><a href="usuarios.php" > Usuarios</a></li>
                    <li><a href="comentarios.php" > Comentarios</a></li>
                    <li><a href="usuariosRegistrados.php"> Registros</a></li>
                    <li><a href="partidasJugadas.php"> Partidas</a></li>
                    <li><a href="baneados.php"> Baneados</a></li>
                </ul>
            </div>
            
        </nav>

        <SECTION>
        	<?php
                if ($row = mysqli_fetch_array($consulta, MYSQLI_ASSOC)){ 
                   do { 
                        echo "<h2>".$row["Usuario"]."</h2>";
                        echo "<table>";
                            echo "<tr>";
                                echo "<td width=350><h3>Correo: ".$row["Correo"]."</h3></td>";
                                echo "<td><h3>Partidas Ganadas: ".$row["partidas_g"]."</h3></td>";
                            echo "</tr>";
                            echo "<tr>";
                                echo "<td><h3>Nombre: ".$row["Nombre"]."</h3></td>";
                                echo "<td><h3>Partidas Perdidas: ".$row["partidas_p"]."</h3></td>";
                            echo "</tr>";
                        echo "</table>";
                        echo "<center>";
                        echo "<div class='boton'>";
                            echo "<form action='metodos.php' method='post'>";
                                echo "<input type='hidden' name='usuario' value='".$row['Usuario']."'>";
                                echo "<input type='hidden' name='action' value='anti-ban'>";
                                echo "<input class='bMenu' type='submit' value='Recuperar'><br><br><br>";
                            echo "</form>";
                        echo "</div>";
                        echo "</center>";
                        echo "<br><hr size=1 width=95% align='center'>";
                    } while ($row = mysqli_fetch_array($consulta, MYSQLI_ASSOC)); 
                } 
                else { 
                    echo "<center><br><br><h1>No hay personas baneadas</h1></center><br>";
                }
            ?>
        </SECTION>

    </BODY>

</HTML>