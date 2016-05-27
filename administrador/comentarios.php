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
        $consulta = mysqli_query($con, "select * from comentarios ");

    ?>

<html>
	<head>
		<link rel="stylesheet" type="text/css" href="estilo_administrador.css">
		<link type="image/png" rel="icon" href="img/KartenSpiel_icono.png">
		<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
	</head>
	<body background="img/url.jpg ">
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
				</ul>
			</div>
			
		</nav>
		<section>
			<div>
				<?php
					if ($row = mysqli_fetch_array($consulta, MYSQLI_ASSOC)){ 
			        	do {
							echo "<br><h2 style='display:inline;'>".$row["usuario"]."</h2>";
							echo "<textarea rows='10' cols='100'>".$row["comentario"]."</textarea>";
							
								echo "<form action='metodos.php' method='post'>";
									echo "<br><br>";
									echo "<input class='bMenu' type='submit' value='Eliminar'><br><br><br><br>";
									echo "<input type='hidden' name='Id' value='".$row['Id']."'>";
									echo "<input type='hidden' name='action' value='comentario_borrar'>";
								echo "</form>";
						
						echo "<hr size=1 width=95% align='center'>";
						}while ($row = mysqli_fetch_array($consulta, MYSQLI_ASSOC)); 
		            } 
		            else { 
		                echo "<center><h1>No hay Comentarios</h1></center><br>";
		            }
				?>
			</div>
		</section>
		


	</body>
</html>