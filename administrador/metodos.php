<?php
    
    session_start();
    if(isset($_POST["action"])){
        $con = mysqli_connect("localhost", "root", "kartenspiel", "kartenspiel");
        
        if($_POST['action'] == 'eliminar') {
            $consulta = mysqli_query($con, "DELETE FROM `usuarios` WHERE Usuario = '".$_POST["usuario"]."'");
            echo "<META HTTP-EQUIV='REFRESH' CONTENT='0;URL=usuarios.php'> ";
        } 

        if($_POST['action'] == 'modificar'){
            $consulta = mysqli_query($con, "UPDATE `usuarios` SET `Usuario`='".$_POST["usuario"]."',`Nombre`='".$_POST["nombre"]."',`Correo`='".$_POST["correo"]."',`partidas_g`='".$_POST["pg"]."',`partidas_p`='".$_POST["pp"]."' WHERE usuario = '".$_POST["usuario_modificar"]."'");
            //Header('HTTP/1.1 301 Moved Permanently');
            //header('Location: http://localhost/PROYECTO%20TITULACION/index_administrador.html');
            echo "<META HTTP-EQUIV='REFRESH' CONTENT='0;URL=usuarios.php'> ";
        }
        
        if($_POST['action'] == 'comentario'){
            $consulta=mysqli_query($con, "INSERT INTO `comentarios`(`Id`, `usuario`, `comentario`) VALUES ('NULL','".$_SESSION["usuario"]."','".$_POST["comentario"]."')");
            echo "<META HTTP-EQUIV='REFRESH' CONTENT='0;URL=contacto.php'> ";
        }
        
        if($_POST['action'] == 'comentario_borrar') {
            $consulta = mysqli_query($con, "DELETE FROM `comentarios` WHERE Id = ".$_POST["Id"]."");  
            echo "<META HTTP-EQUIV='REFRESH' CONTENT='0;URL=comentarios.php'> ";
        } 
        
        if($_POST['action'] == 'registrar') {
            $sql = "INSERT INTO `usuarios`(`Usuario`, `Contrasena`, `Nombre`, `Correo`, `Tipo`, `partidas_g`, `partidas_p`, `partidas_t`) 
                VALUES ('".$_POST["usuario"]."','".$_POST["clave"]."','".$_POST["nombre"]."','".$_POST["correo"]."',1,0,0,0)";
            $sql2 ="SELECT codigo FROM codigo WHERE Usuario = '".$_POST["usuario"]."'";
            $consulta = mysqli_query($con, $sql2);
            if($row = mysqli_fetch_array($consulta, MYSQLI_ASSOC)){
                if($row["codigo"] == $_POST["codigo"]){
                    $consulta = mysqli_query($con, $sql);
                    $_SESSION["usuario"]= $_POST["usuario"];
                    //aqui va lo de la fecha y el update para el registro
                    $año = date("Y");
                    $mes = date("m");
                    $contar="SELECT * FROM registros WHERE Year=".$año." AND Mes=".$mes."";
                    $consulta2= mysqli_query($con, $contar);
                    if($row = mysqli_fetch_array($consulta2, MYSQLI_ASSOC)){
                        $num=$row["Num"];
                        $num= $num + 1;

                        $sumar = "UPDATE `registros` SET `Num`=".$num." WHERE `Id`=".$row["Id"]."";
                        $consulta3= mysqli_query($con, $sumar);
                    }
                    else{
                        $insertar = "INSERT INTO `kartenspiel`.`registros` (`Id`, `Mes`, `Year`, `Num`) 
                        VALUES (NULL, '1', '".$año."', '0'), (NULL, '2', '".$año."', '0'), (NULL, '3', '".$año."', '0'), (NULL, '4', '".$año."', '0'), 
                        (NULL, '5', '".$año."', '0'), (NULL, '6', '".$año."', '0'), (NULL, '7', '".$año."', '0'), (NULL, '8', '".$año."', '0'), 
                        (NULL, '9', '".$año."', '0'), (NULL, '10', '".$año."', '0'), (NULL, '11', '".$año."', '0'), (NULL, '12', '".$año."', '0');";

                        $consulta4= mysqli_query($con, $insertar);
                        $contar2="SELECT * FROM registros WHERE Year=".$año." AND Mes=".$mes."";
                        $consulta5= mysqli_query($con, $contar2);

                        if($row = mysqli_fetch_array($consulta5, MYSQLI_ASSOC)){
                            $num=1;

                        $sumar = "UPDATE `registros` SET `Num`=".$num." WHERE `Id`=".$row["Id"]."";
                        $consulta3= mysqli_query($con, $sumar);
                        }
                        
                    }


                    //aqui termina lo de la fecha
                    echo "<META HTTP-EQUIV='REFRESH' CONTENT='0;URL=usuario/menu.html'> ";
                }
                else{
                    echo "<script>alert('El codigo no es correcto');</script>";
                    echo "<META HTTP-EQUIV='REFRESH' CONTENT='0;URL=codigo.php'> ";
                }
            }
            
        }
        
        if($_POST["action"]=="solicitar"){
            $consulta = mysqli_query($con, "select Usuario from usuarios where Usuario='".  $_POST["amigo"]  ."' ");
            $result=mysql_query("SELECT count(*) as total from AMIGOS WHERE Usuario = ".$_SESSION."");
            $data=mysql_fetch_assoc($result);

            $max = mysqli_query($con, "select * from amigos where Usuario='".  $_POST["amigo"]  ."' ");
            if($data==20){
                echo "  <META HTTP-EQUIV='REFRESH' CONTENT='0;URL=amigos.php'> ";
                echo "<script> alert('No puedes tener mas de 20 amigos'); </script> ";
            }
            else{
                if ($row = mysqli_fetch_array($consulta, MYSQLI_ASSOC)){ 
                    $sql = mysqli_query($con, "INSERT INTO `solicitud` (`Id`, `Solicitante`, `Solicitado`) VALUES (NULL, '".$_SESSION["usuario"]."', '".$_POST["amigo"]."')");        
                    echo "  <META HTTP-EQUIV='REFRESH' CONTENT='0;URL=amigos.php'> ";
                    echo "<script> alert('Se mando la solicitud'); </script> ";
                } 
                else { 
                    echo "  <META HTTP-EQUIV='REFRESH' CONTENT='0;URL=amigos.php'> ";
                    echo "<script> alert('No existe este usuario'); </script> ";
                }
            }
            

        }

        if($_POST["action"]=='aceptar'){
            $result=mysql_query("SELECT count(*) as total from AMIGOS WHERE Usuario = ".$_SESSION."");
            $data=mysql_fetch_assoc($result);
            if($data==20){
                echo "  <META HTTP-EQUIV='REFRESH' CONTENT='0;URL=amigos.php'> ";
                echo "<script> alert('No puedes tener mas de 20 amigos'); </script> ";
            }
            else{
                if (mysqli_query($con, "DELETE FROM `solicitud` WHERE `Id` = ".$_POST["id"]."")){ 
                    $insertar = mysqli_query($con, "INSERT INTO `amigos`(`Id`, `Usuario`, `Amigo`) VALUES ('','".  $_POST["usuario"]  ."','".  $_POST["amigo"]  ."')");
                    $insertar = mysqli_query($con, "INSERT INTO `amigos`(`Id`, `Usuario`, `Amigo`) VALUES ('','".  $_POST["amigo"]  ."','".  $_POST["usuario"]  ."')");
                    echo "  <META HTTP-EQUIV='REFRESH' CONTENT='0;URL=amigos.php'> ";
                    echo "<script> alert('Se mando la solicitud'); </script> ";
                } 
                else { 
                    echo "  <META HTTP-EQUIV='REFRESH' CONTENT='0;URL=amigos.php'> ";
                    echo "<script> alert('No existe este usuario'); </script> ";
                }
            }
            

        }

        if($_POST["action"]=="anti-amigo"){
            if(mysqli_query($con, "DELETE FROM `amigos` WHERE `Usuario` = '".$_SESSION["usuario"]."' AND Amigo = '".$_POST["amigo"]."'"))
            {
                if(mysqli_query($con, "DELETE FROM `amigos` WHERE `Usuario` = '".$_POST["amigo"]."' AND `Amigo` = '".$_SESSION["usuario"]."' "))
                {
                    echo "  <META HTTP-EQUIV='REFRESH' CONTENT='0;URL=amigos.php'> ";
                    echo "<script> alert('Se ha eliminado el amigo'); </script> ";
                }
            }
            else{
                echo "  <META HTTP-EQUIV='REFRESH' CONTENT='0;URL=amigos.php'> ";
                echo "<script> alert('No existe este usuario'); </script> ";
            }

        }

        if($_POST["action"]=="recuperar"){
            $sql = "SELECT * FROM usuarios WHERE Correo = '".$_POST["correo"]."' ";
            $consulta = mysqli_query($con, $sql);
            
            if($row = mysqli_fetch_array($consulta, MYSQLI_ASSOC)){
                $para      = "".$_POST["correo"]."";
                $titulo    = 'Recuperacion de Usuario y Contraseña';
                $mensaje   = 'Usuario =  '.$row["Usuario"].'        Contraseña = '.$row["Contrasena"].'';
                $mensaje   = wordwrap($mensaje, 70);
                $cabeceras = 'From: KartenSpiel <kartenspiel.soporte@gmail.com>'."\r\n";
                
                if(mail($para, $titulo, $mensaje, $cabeceras)){
                    echo "<script>alert('Se envio el codigo');</script>";
                }
                else{

                }
                
            }
            else{
                echo " <META HTTP-EQUIV='REFRESH' CONTENT='0;URL=Login.php'> ";
                
            }
        }

        if($_POST["action"]=="sonido"){
            $_SESSION["volumen"]=$_POST["volumen"];
            echo " <META HTTP-EQUIV='REFRESH' CONTENT='0;URL=configuracion.php'> ";
        }

        if($_POST["action"]=="cambiar"){
            $sql = "UPDATE `usuarios` SET `Contrasena` = '".$_POST["clave"]."' WHERE Usuario = '".$_SESSION["usuario"]."' ";
            $consulta = mysqli_query($con, $sql);
            
            echo " <META HTTP-EQUIV='REFRESH' CONTENT='0;URL=configuracion.php'> ";
        }

        if($_POST["action"]=="cerrar_sesion"){
            session_destroy();
            echo " <META HTTP-EQUIV='REFRESH' CONTENT='0;URL=../Login.php'> ";
        }

    }



    class metodos{


        function ganadas(){
            $con = mysqli_connect("localhost", "root", "kartenspiel", "kartenspiel");
            $consulta = mysqli_query($con, "select partidas_g from usuarios where Usuario='".  $_SESSION['usuario']  ."'");
            if ($row = mysqli_fetch_array($consulta, MYSQLI_ASSOC)){ 
               do { 
                    echo "".$row["partidas_g"].""; 
                } while ($row = mysqli_fetch_array($consulta, MYSQLI_ASSOC)); 
            } 
            else { 
                echo "¡ No se ha encontrado ningún registro !"; 
            } 
        }

        function perdidas(){
            $con = mysqli_connect("localhost", "root", "kartenspiel", "kartenspiel"); 
            $consulta = mysqli_query($con, "select partidas_p from usuarios where Usuario='".  $_SESSION['usuario']  ."'");
            if ($row = mysqli_fetch_array($consulta, MYSQLI_ASSOC)){ 
               do { 
                    echo "".$row["partidas_p"].""; 
                } while ($row = mysqli_fetch_array($consulta, MYSQLI_ASSOC)); 
            } 
            else { 
                echo "¡ No se ha encontrado ningún registro !"; 
            } 
        }

        function partidas(){
            $con = mysqli_connect("localhost", "root", "kartenspiel", "kartenspiel");  
            $consulta = mysqli_query($con, "select partidas_t from usuarios where Usuario='".  $_SESSION['usuario']  ."'");
            if ($row = mysqli_fetch_array($consulta, MYSQLI_ASSOC)){ 
               do { 
                    echo "".$row["partidas_t"].""; 
                } while ($row = mysqli_fetch_array($consulta, MYSQLI_ASSOC)); 
            } 
            else { 
                echo "¡ No se ha encontrado ningún registro !"; 
            } 
        }


    }


    
    ?>
