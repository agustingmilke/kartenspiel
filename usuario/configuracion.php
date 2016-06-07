<!DOCTYPE html>
<?php
session_start();
    if(isset($_SESSION["volumen"])){

    }
    else{
        $_SESSION["volumen"]=.5;
    }
?>

<HTML lang="es">


    <HEAD>
        <TITLE>Login</TITLE>
        <link type="image/png" rel="icon" href="img/KartenSpiel_icono.png">
        <link rel="stylesheet" type="text/css" href="css/estilos.css">

    </HEAD>


    <BODY background="img/url.jpg">

        <HEADER>
            <a href="menu.php"><img src="img/volver.png" width=40 height=40 style="float:top; position:absolute;"></a>
        </HEADER>

        <NAV>
        </NAV>

        <SECTION class="config">
        	<h1 align="center">Configuracion</h1>
            <center><img class='logros' src='img/linea.png' width='500px' height='25px'></center>
            <br><br>
            <audio id="myAudio">
                <source src="sonidos/cambio de turno.mp3" type="audio/mpeg">
                Your browser does not support the audio element.
            </audio>
            <table>
                <tr>
                    <form action="metodos.php" method="post">
                        
                            <td><center><input type="range" min="0" max="1" value="<?php echo $_SESSION["volumen"]?>" step="0.1" id="volumen" name="volumen"></center></td>
                            <input type="hidden" value="sonido" name="action">
                            <td><input class="bMenu" type="submit" value="aceptar" name="aceptar" style='width:150px;'></td>
                        
                    </form>
                </tr>
                <tr>
                    <form action="metodos.php" method="post" onsubmit="return validar()">
                        <input type="hidden" value="cambiar" name="action">
                        <td colspan="2"><br><h2 style ="font-size:80%;">Contrase&ntildea</h2></td>
                </tr>
                <tr>
                        <td><input type="password" placeholder="Cambiar Clave" name="clave" id="clave" style=" font-size:20px"></td>
                        <td><input class="bMenu" type="submit" value="Cambiar" style='width:150px;'></td>
                    </form>
                </tr>
                <tr>
                <form action="metodos.php" method="post">
                    <input type="hidden" value="cerrar_sesion" name="action">
                    <td colspan="2"><br><br><center><input class="bMenu" type="submit" value="Cerrar Sesion" style='width:200px;'></center></td>
                </form>
                </tr>
            </table>
        </SECTION>

        <FOOTER>
        </FOOTER>
    
    </BODY>

    <script>
        var barra = document.getElementById("volumen");
        var myAudio = document.getElementById("myAudio");
        barra.addEventListener("change",function(ev){
            myAudio.volume = ev.target.value;   
            myAudio.play();
        },true);

        function validar(){
            var clave = document.getElementById("clave").value;

            if(/[0-9]+/.test(clave) && /[A-Za-z]+/.test(clave) && /\w{8,15}/.test(clave)){
                
                confirmar=confirm("Estas seguro de cambiar la clave?"); 
                if (confirmar) 
                    return true;
                else 
                    return false; 
                    
            }
            else{
                alert("El usuario necesita tener minimo 1 letra, minimo 1 numero y ser de entre 8 y 15 caracteres185");
                return false;
            }

        }
    </script>




</HTML>
