<!DOCTYPE html>
<?php
		session_start();
        if(isset($_SESSION['usuario']))
        {

        }
        else
        {
            echo "no hay";
        }

        $con = mysqli_connect("localhost", "root", "kartenspiel", "kartenspiel");  
        $consulta = mysqli_query($con, "select * from usuarios where Usuario='".$_POST["usuario"]."'");
    

?>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="estilo_administrador.css">
		<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
	</head>
	<body background="img/url.jpg ">
		<header>

			<center><br><h1>KartenSpiel</h1><br></center>

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

		<section>
			<?php
                    if ($row = mysqli_fetch_array($consulta, MYSQLI_ASSOC)){ 
						echo "<br><form action='metodos.php' method='post'>";
						echo "<input type='hidden' name='action' value='modificar'> ";
						echo "<input type='hidden' name='usuario_modificar' value='".$_POST["usuario"]."'> ";
						echo "<table>";
							echo "<tr>";
								echo "<td colspan=2><h2 style='display:inline;'>Usuario: </h2><input name='usuario' type='text' value='".$row["Usuario"]."'></td>";
								echo "";
							echo"</tr>";
							echo "<tr>";
								echo "<td><h3>Correo: </h3><input name='correo' type='text' value='".$row["Correo"]."'></td>";
								echo "<td><h3>Partidas Ganadas: </h3><input name='pg' type='number' value='".$row["partidas_g"]."'></td>";
							echo "</tr>";
							echo "<tr>";
								echo "<td><h3>Nombre: </h3><input name='nombre' type='text' value='".$row["Nombre"]."'></td>";
								echo "<td><h3>Partidas Perdidas: </h3><input name='pp' type='number' value='".$row["partidas_p"]."'></td>";
							echo "</tr>";
						echo "</table>";
						echo "<center>";
							echo "<br>";
							echo "<input class='bMenu' type='submit' value='Modificar'><br><br>";
						echo "</center>";
						echo "</form>";
                    } 
                    else { 
                        echo "<center><h1>No hay amigos</h1></center><br>"; 
                    }
                ?>
			<inpu>
			
			<script>
		function modificar(usuario) 
		{
			<?php
				$consulta = mysqli_query($con, "UPDATE `usuarios` SET `Usuario`=[value-1],`Contrasena`=[value-2],`Nombre`=[value-3],`Correo`=[value-4],`Tipo`=[value-5],`partidas_g`=[value-6],`partidas_p`=[value-7],`partidas_t`=[value-8] WHERE 1");
			?>
		 }
		</script>

		</section>

	</body>





</html>