<!DOCTYPE html>
<?php
    
    session_start();
    if(isset($_SESSION["usuario"])){
        if(isset($_SESSION["volumen"])){

        }
        else{
            $_SESSION["volumen"]=.5;
        }
    }
    else{
        echo "  <META HTTP-EQUIV='REFRESH' CONTENT='0;URL=../Login.php'> ";
    }
    $con = mysqli_connect("localhost", "root", "kartenspiel", "kartenspiel");
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
            <form action="http://kartenspielweb.info:8080" method="GET">
                <input name="name" type="hidden" value="<?php echo $_SESSION['usuario'];?>">
                <input class="bMenu" type="submit" value="Jugar" ><br> 
            </form>
                <input class="bMenu" type="submit" value="Perfil" onclick = "location='perfil.php'"><br>
                <input class="bMenu" type="submit" value="Amigos" onclick = "location='amigos.php'"><br>
                <input class="bMenu" type="submit" value="Logros" onclick = "location='logros.php'"><br>
                <input class="bMenu" type="submit" value="Configuracion" onclick = "location='configuracion.php'"><br>
                <input class="bMenu" type="submit" value="Contacto" onclick = "location='contacto.php'"><br>
                
            </center>
        </SECTION>

        <FOOTER>
        </FOOTER>
    
    </BODY>





</HTML>
