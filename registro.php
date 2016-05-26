<?php
	if (isset($_POST["clave"]) && isset($_POST["usuario"]) && isset($_POST["correo"]) && isset($_POST["edad"]) && isset($_POST["nombre"]) ) {
		$con = mysqli_connect("localhost", "root", "", "kartenspiel"); 
		$sql = "INSERT INTO 'usuarios'('Usuario', 'Contrasena', 'Nombre', 'Correo', 'Tipo', 'partidas_g', 'partidas_p', 'codigo') 
				VALUES ('".$_POST["usuario"]."','".$_POST["clave"]."','".$_POST["nombre"]."','".$_POST["correo"]."',1,0,0,0)";
        
        
        if (mysqli_query($con, $sql)) {
            session_start();
            $_SESSION['usuario'] = $_POST["usuario"];

            echo "  <META HTTP-EQUIV='REFRESH' CONTENT='0;URL=menu.html'> ";
        
        }
        else
        {
            echo "no pudo iniciar sesion";
        }
            

	}

?>