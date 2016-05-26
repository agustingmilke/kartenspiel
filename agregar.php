<?php

		$con = mysqli_connect("localhost", "root", "", "kartenspiel");  
        session_start();

        $consulta = mysqli_query($con, "select Usuario from usuarios where Usuario='".  $_POST["amigo"]  ."' ");

        if ($row = mysqli_fetch_array($consulta, MYSQLI_ASSOC)){ 
           	$insertar  = mysqli_query($con, "INSERT INTO `amigos`(`ID`, `Usuario`, `Amigo`) VALUES ('','".  $_SESSION["usuario"]  ."','".  $_POST["amigo"]  ."')");
           	echo "  <META HTTP-EQUIV='REFRESH' CONTENT='0;URL=amigos.php'> ";
           	echo "<script> alert('Se agrego el amigo'); </script> ";
        } 
        else { 
            echo "  <META HTTP-EQUIV='REFRESH' CONTENT='0;URL=amigos.php'> ";
            echo "<script> alert('No se agrego el amigo'); </script> ";
        }

        

    ?>