<!DOCTYPE html>
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
        $consulta = mysqli_query($con, "select * from amigos where Usuario='".  $_SESSION['usuario']  ."'");
        $solicitudes = mysqli_query($con, "select * from solicitud where Solicitado='".  $_SESSION['usuario']  ."'");
        
    ?>

<HTML lang="es">


    <HEAD>
        <TITLE>Amigos</TITLE>
        <link type="image/png" rel="icon" href="img/KartenSpiel_icono.png">
        <link rel="stylesheet" type="text/css" href="css/estilos.css">
        <script>
            function ok(){
                confirmar=confirm("¿Estas seguro de eliminar este amigo?"); 
                if (confirmar) 
                    return true;
                else 
                    return false; 
            }
        </script>
    </HEAD>


    <BODY background="img/url.jpg">

        <HEADER>
            <a href="menu.php"><img src="img/volver.png" width=40 height=40 style="position:absolute"></a>
        </HEADER>

        <NAV>
        </NAV>

        <SECTION class="amigos">
        	<div class="agregar">
                <form action="metodos.php" method="post" >
                    <center>
                        <h1>Agregar a usuario: </h1><input type="hidden" name="action" value="solicitar">
                        <input name = "amigo" type='text' placeholder='Buscar un amigo'>
                        <input class="bMenu" style="width:130px ;" type='submit' value='Agregar'>
                    </center>
                </form>
            </div>
            <div class="amigos">
                <center><h1>Amigos</h1></center><br><br>
                <?php
                    if ($row = mysqli_fetch_array($consulta, MYSQLI_ASSOC)){ 
                       do { 
                            echo "<center><h2>Amigo: ".$row["Amigo"]."</h2>";
                            echo "<form action='metodos.php' method='post' onsubmit='return ok()'>";
                                echo "<input class='bMenu' type=submit value='Eliminar' style='font-size: 90%; width: 150px;' ></center><br><br>";
                                echo "<input type='hidden' name='action' value='anti-amigo'>";
                                echo "<input type='hidden' name='amigo' value='".$row["Amigo"]."'>";
                            echo "</form>";
                            echo "<hr size=1 align='center'><br>";
                        } while ($row = mysqli_fetch_array($consulta, MYSQLI_ASSOC)); 
                    } 
                    else { 
                        echo "<center><h1>No hay amigos</h1></center><br>"; 
                    }
                ?>
            </div>
            <div class="solicitudes">
                <center><h1>Solicitudes</h1></center><br><br>
                <?php
                    if ($row = mysqli_fetch_array($solicitudes, MYSQLI_ASSOC)){ 
                       do { 
                            echo "<center><h2>Amigo: ".$row["Solicitante"]."</h2> ";
                            echo "<form action='metodos.php' method='post'>";
                                echo "<input class='bMenu' type=submit value='Aceptar' style='font-size: 90%; width: 150px;'></center><br><br>";
                                echo "<input type='hidden' name='usuario' value='".$row["Solicitante"]."'>";
                                echo "<input type='hidden' name='amigo' value='".$_SESSION["usuario"]."'>";
                                echo "<input type='hidden' name='id' value='".$row["Id"]."'>";
                                echo "<input type='hidden' name='action' value='aceptar'>";
                            echo "</form>";
                            echo "<hr size=1 align='center'><br>"; 
                        } while ($row = mysqli_fetch_array($solicitudes, MYSQLI_ASSOC)); 
                    } 
                    else { 
                        echo "<center><h1>No hay Solicitudes</h1></center><br>"; 
                    }
                ?>
            </div>
            <br><br>
            
        </SECTION>

        <FOOTER>
        </FOOTER>
    
    </BODY>



</HTML>
