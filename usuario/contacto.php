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

    ?>

<HTML lang="es">


    <HEAD>
        <TITLE>Contacto</TITLE>
        <link type="image/png" rel="icon" href="img/KartenSpiel_icono.png">
        <link rel="stylesheet" type="text/css" href="css/estilos.css">
    </HEAD>

    <BODY background="img/url.jpg">

        <SECTION class="contacto">
        	<h1><center>Contacto</center></h1>
        	<h3><center>En el siguiente apartado, podras enviar quejas, sugerencias o comentarios a los administradores de la pagina</center></h3>
        	<form action="metodos.php" method="post">
	        	<center>
                    <textarea name="comentario" cols="100" rows="15" placeholder="Escribe una queja, sugerencia o un comentario "></textarea>
                </center>
                <input type='hidden' name='action' value='comentario'>
                
	        	<input class="bMenu" type="submit" value="Enviar" style="width:140px; margin:40px;">
	        </form>
        	<br><br><br>
        	
        </SECTION>

        
    
    </BODY>





</HTML>
