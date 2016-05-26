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
        $consulta = mysqli_query($con, "select Usuario, Comentarios from usuarios ");
    

    ?>

<html>
	<head>
		<link rel="stylesheet" type="text/css" href="administrador.css">
		<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
	</head>
	<body bgcolor="#B7B7B7">

		<div class=>
			<div>
				<?php
					if ($row = mysqli_fetch_array($consulta, MYSQLI_ASSOC)){ 
			        	do {
							echo "<h2>".$row["Usuario"]."</h2><br>";
							echo "<textarea rows='10' cols='100'>".$row["Comentarios"]."</textarea>";
							echo "<center>";
								echo "<br><br>";
								echo "<input type='button' value='Modificar'><br><br>";
								echo "<input type='button' value='Eliminar'><br><br><br>";
						echo "</center>";
						echo "<hr size=1 width=95% align='center'>";
						}while ($row = mysqli_fetch_array($consulta, MYSQLI_ASSOC)); 
		            } 
		            else { 
		                echo "<center><h1>No hay Comentarios</h1></center><br>";
		            }
				?>
			</div>
			
		</div>


	</body>
</html>