<?php
	session_start();
    if(isset($_SESSION['usuario']))
    {

    }
    else
    {
        echo "no hay";
    }

?>
<HTML>

    <HEAD>
        <TITLE>Mensaje</TITLE>
        <link rel="stylesheet" type="text/css" href="estilo_administrador.css">
        <link type="image/png" rel="icon" href="img/KartenSpiel_icono.png">
        <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    </HEAD>


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
                    <li><a href="usuarios.php"> Usuarios</a></li>
                    <li><a href="comentarios.php"> Comentarios</a></li>
                    <li><a href="usuariosRegistrados.php"> Registros</a></li>
                    <li><a href="partidasJugadas.php"> Partidas</a></li>
                    <li><a href="baneados.php"> Baneados</a></li>
                </ul>
            </div>
            
        </nav>

        <SECTION>
        	<center><h2 align="center">Describre un mensaje con la razon por el baneo de <?php echo $_POST["usuario"];?></h2></center>
            <center><form action="metodos.php" method="post">
            <center><textarea id="mensaje" name="mensaje" placeholder="Escribe un mensaje para el usuario" cols="100" rows="15" ></textarea></center>
            <input type="hidden" name="usuario" id="usuario" value="<?php echo $_POST['usuario']; ?>">
            <input type='hidden' name='action' value='eliminar'>
            <input class='bMenu' type='submit' value='Eliminar'>
            </form></center>
        </SECTION>

        <FOOTER>
        </FOOTER>
    
    </BODY>

</HTML>