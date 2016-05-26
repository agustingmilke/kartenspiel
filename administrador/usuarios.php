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

        $con = mysqli_connect("localhost", "root", "", "kartenspiel");  
        $consulta = mysqli_query($con, "select * from usuarios ");
    

    ?>

<html>
	<head>
		<link rel="stylesheet" type="text/css" href="estilo_administrador.css">
		<link type="image/png" rel="icon" href="img/KartenSpiel_icono.png">
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
					<li><a href="usuarios.php" > Usuarios</a></li>
					<li><a href="comentarios.php" > Comentarios</a></li>
					<li><a href="usuariosRegistrados.php"> Registros</a></li>
				</ul>
			</div>
			
		</nav>


		<section>
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
								echo "<input type='hidden' name='action' value='eliminar'>";
								echo "<input class='bMenu' type='submit' value='Eliminar'><br><br><br>";
							echo "</form>";
							echo "<form action='modificar.php' method='post'>";
								echo "<input type='hidden' name='usuario' value='".$row['Usuario']."'>";
								echo "<input type='submit' class='bMenu' value='Modificar'><br><br>";
							echo "</form>";
						echo "</div>";
						echo "</center>";
						echo "<br><hr size=1 width=95% align='center'>";
	                } while ($row = mysqli_fetch_array($consulta, MYSQLI_ASSOC)); 
	            } 
	            else { 
	                echo "<center><h1>No hay amigos</h1></center><br>";
	            }
	        ?>
						

		</section>

	</body>
</html>

	<!-- function eliminar(){
		echo "<script language='javascript'>alert('si jala');</script>";
		//echo "<meta http-equiv='refresh'>"; 
	} -->
