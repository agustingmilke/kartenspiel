<!DOCTYPE html>
<?php
    
    session_start();
    if(isset($_SESSION["usuario"])){

    }
    else{
        echo "primero inicia sesion";
    }
    $con = mysqli_connect("localhost", "root", "kartenspiel", "kartenspiel");
    $consulta = mysqli_query($con, "select * from amigos where Usuario='".$_SESSION['usuario']."'");
    $amigos = array();
    if ($row = mysqli_fetch_array($consulta, MYSQLI_ASSOC)){ 
       do { 
            array_push($amigos, $row["Amigo"]); 

        } while ($row = mysqli_fetch_array($consulta, MYSQLI_ASSOC)); 
    } 
    else { 
        echo "¡ No se ha encontrado ningún registro !"; 
        } 
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
    $PG=ganadas();

?>

<HTML lang="es">


    <HEAD>
        <TITLE>Login</TITLE>
        <link type="image/png" rel="icon" href="img/KartenSpiel_icono.png">
        <link rel="stylesheet" type="text/css" href="css/estilos.css">
    </HEAD>


    <BODY background="img/url.jpg">



        <NAV>
        </NAV>

        <SECTION class="login">
        	<h1 align="center">Menu</h1>
            <center><img class='logros' src='img/linea.png' width='300px' height='20px'></center>
            <br>
            <center>
            <form action="http://192.241.188.222:8080" method="GET">
                <input name="name" type="hidden" value="<?php echo $_SESSION['usuario'];?>">
                <!--<input name="friends" type="hidden" value="<?php //echo json_encode($amigos);?>">-->
                <input name="ganadas" type="hidden" value="<?php echo $PG;?>">
                <input class="bMenu" type="submit" value="Jugar" ><br> 
            </form>
                <input class="bMenu" type="submit" value="Perfil" onclick = "location='Perfil.php'"><br>
                <input class="bMenu" type="submit" value="Amigos" onclick = "location='amigos.php'"><br>
                <input class="bMenu" type="submit" value="Logros" onclick = "location='logros.php'"><br>
                <input class="bMenu" type="submit" value="Configuracion" onclick = "location='partidas.php'"><br>
                
            </center>
        </SECTION>

        <FOOTER>
        </FOOTER>
    
    </BODY>





</HTML>
