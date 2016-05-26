<?php
    
    if(isset($_POST["action"])){
        $con = mysqli_connect("localhost", "root", "", "kartenspiel");
        if($_POST['action'] == 'eliminar') {
            $consulta = mysqli_query($con, "DELETE FROM `usuarios` WHERE Usuario = '".$_POST["data"]."'");
        } 
        if($_POST['action'] == 'modificar'){
            $consulta = mysqli_query($con, "UPDATE `usuarios` SET `Usuario`='".$_POST["usuario"]."',`Nombre`='".$_POST["nombre"]."',`Correo`='".$_POST["correo"]."',`partidas_g`='".$_POST["pg"]."',`partidas_p`='".$_POST["pp"]."' WHERE usuario = '".$_POST["usuario_modificar"]."'");
            //Header('HTTP/1.1 301 Moved Permanently');
            //header('Location: http://localhost/PROYECTO%20TITULACION/index_administrador.html');
            echo "  <META HTTP-EQUIV='REFRESH' CONTENT='0;URL=usuarios.php'> ";

        }
    }


      

    session_start();

    class metodos{


        function ganadas(){
            $con = mysqli_connect("localhost", "root", "", "kartenspiel");
            $consulta = mysqli_query($con, "select partidas_g from usuarios where Usuario='".  $_SESSION['usuario']  ."'");
            if ($row = mysqli_fetch_array($consulta, MYSQLI_ASSOC)){ 
               do { 
                    echo "".$row["partidas_g"].""; 
                    return "".$row["partidas_g"]."";
                } while ($row = mysqli_fetch_array($consulta, MYSQLI_ASSOC)); 
            } 
            else { 
                echo "¡ No se ha encontrado ningún registro !"; 
            } 
        }
        function contrasena(){
            $con = mysqli_connect("localhost", "root", "", "kartenspiel");
            $consulta = mysqli_query($con, "select contrasena from usuarios where Usuario='".  $_SESSION['usuario']  ."'");
            if ($row = mysqli_fetch_array($consulta, MYSQLI_ASSOC)){ 
               do { 
                    echo "".$row["contrasena"].""; 
                    return "".$row["contrasena"]."";
                } while ($row = mysqli_fetch_array($consulta, MYSQLI_ASSOC)); 
            } 
            else { 
                echo "¡ No se ha encontrado ningún registro !"; 
            } 
        }
        function perdidas(){
            $con = mysqli_connect("localhost", "root", "", "kartenspiel"); 
            $consulta = mysqli_query($con, "select partidas_p from usuarios where Usuario='".  $_SESSION['usuario']  ."'");
            if ($row = mysqli_fetch_array($consulta, MYSQLI_ASSOC)){ 
               do { 
                    echo "".$row["partidas_p"]."";
                    return "".$row["partidas_p"].""; 
                } while ($row = mysqli_fetch_array($consulta, MYSQLI_ASSOC)); 
            } 
            else { 
                echo "¡ No se ha encontrado ningún registro !"; 
            } 
        }

        function correo(){
            $con = mysqli_connect("localhost", "root", "", "kartenspiel");
            $consulta = mysqli_query($con, "select correo from usuarios where Usuario='".  $_SESSION['usuario']  ."'");
            if ($row = mysqli_fetch_array($consulta, MYSQLI_ASSOC)){ 
               do { 
                    echo "".$row["correo"].""; 
                    return "".$row["correo"]."";
                } while ($row = mysqli_fetch_array($consulta, MYSQLI_ASSOC)); 
            } 
            else { 
                echo "¡ No se ha encontrado ningún registro !"; 
            } 
        }
        function conectar(){
            $con = mysql_connect("localhost", "root", ""); 
            $base = mysql_select_db("kartenspiel", $con);    
            session_start();
        }



    }


    
    ?>
