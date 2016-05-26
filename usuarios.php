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

        $con = mysqli_connect("localhost", "root", "", "kartenspiel");  
        $consulta = mysqli_query($con, "select * from usuarios ");
    

    ?>

<html>
	<head>
		<link rel="stylesheet" type="text/css" href="administrador.css">
		<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
	</head>
	<body bgcolor="#B7B7B7">

		<div >
			<div>
				<?php
		            if ($row = mysqli_fetch_array($consulta, MYSQLI_ASSOC)){ 
		               do { 
		                   	echo "<h2>".$row["Usuario"]."</h2>";
							echo "<table>";
								echo "<tr>";
									echo "<td><h3>Correo: ".$row["Correo"]."</h3></td>";
									echo "<td><h3>Partidas Ganadas: ".$row["partidas_g"]."</h3></td>";
								echo "</tr>";
								echo "<tr>";
									echo "<td><h3>Nombre: ".$row["Nombre"]."</h3></td>";
									echo "<td><h3>Partidas Perdidas: ".$row["partidas_p"]."</h3></td>";
								echo "</tr>";
							echo "</table>";
							echo "<center>";
								echo "<br>";
								echo "<input onclick='eliminar(`".$row['Usuario']."`)' type='button' value='Eliminar'><br><br><br>";
								echo "<form action='modificar.php' method='post'>";
									echo "<input type='hidden' name='usuario' value='".$row['Usuario']."'>";
									echo "<input type='submit' value='Modificar'><br><br>";
								echo "</form>";
							echo "</center>";
							echo "<br><hr size=1 width=95% align='center'>";
		                } while ($row = mysqli_fetch_array($consulta, MYSQLI_ASSOC)); 
		            } 
		            else { 
		                echo "<center><h1>No hay amigos</h1></center><br>";
		            }
		        ?>
							

			</div>
			
		</div>
		<script>
		function eliminar(usuario) 
		{
			$.ajax({
				type: "POST",
				url: 'http://localhost/PROYECTO%20TITULACION/metodos.php',
				data:{action:'eliminar', data: usuario},
				success:function() {
		     		location.reload();
		   		}
			});
		 }
		function modificar(usuario) 
		{
			$.ajax({
				type: "POST",
				url: 'http://localhost/PROYECTO%20TITULACION/modificar.php',
				data:{action:'modificar', data: usuario}
			});
		 }
		</script>

	</body>
</html>

	<!-- function eliminar(){
		echo "<script language='javascript'>alert('si jala');</script>";
		//echo "<meta http-equiv='refresh'>"; 
	} -->
