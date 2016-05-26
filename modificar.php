<!DOCTYPE html>
<?php
		
        include ("metodos.php");

        $obj=new metodos();

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
		<link rel="stylesheet" type="text/css" href="administrador.css">
		<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
	</head>
	<body bgcolor="#B7B7B7">
		<div>
			<?php
                    if ($row = mysqli_fetch_array($consulta, MYSQLI_ASSOC)){ 
						echo "<form action='metodos.php' method='post'>";
						echo "<input type='hidden' name='action' value='modificar'> ";
						echo "<input type='hidden' name='usuario_modificar' value='".$_POST["usuario"]."'> ";
						echo "<table>";
							echo "<tr>";
								echo "<td><h2>Usuario: </h2></td>";
								echo "<td><input name='usuario' type='text' value='".$row["Usuario"]."'></td>";
							echo"</tr>";
							echo "<tr>";
								echo "<td><h3>Correo: </h3><input name='correo' type='text' value='".$row["Correo"]."'></td>";
								echo "<td><h3>Partidas Ganadas: </h3><input name='pg' type='number' value='".$row["partidas_g"]."'></td>";
							echo "</tr>";
							echo "<tr>";
								echo "<td><h3>Nombre: </h3><input name='nombre' type='text' value='".$row["Nombre"]."'></td>";
								echo "<td><h3>Partidas Perdidas: </h3><input name='pp' type='text' value='".$row["partidas_p"]."'></td>";
							echo "</tr>";
						echo "</table>";
						echo "<center>";
							echo "<br>";
							echo "<input type='submit' value='Modificar'><br><br>";
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

		</div>

	</body>





</html>