
<?php
    if (isset($_POST["password"]) && isset($_POST["usuario"])) {
        $con = mysqli_connect("localhost", "root", "kartenspiel", "kartenspiel");  
        $consulta = mysqli_query($con, "select * from usuarios where Usuario='".  $_POST["usuario"]  ."' and Contrasena='".  $_POST["password"]  ."'");
        if ($row = mysqli_fetch_array($consulta, MYSQLI_ASSOC)) {
            session_start();
            if($row["Status"] == 'B'){
                $consulta2 = mysqli_query($con, "select * from baneados where Usuario='".  $_POST["usuario"]  ."'");
                if($row2 = mysqli_fetch_array($consulta2, MYSQLI_ASSOC)){
                    $_SESSION["baneado"]=$_POST["usuario"];
                    echo "  <META HTTP-EQUIV='REFRESH' CONTENT='0;URL=mensaje.php'> ";
                }
            }
            else{
                $_SESSION['usuario'] = $_POST["usuario"];

                $consulta = mysqli_query($con, "select Tipo from usuarios where Usuario='".  $_POST["usuario"]  ."'");
            
                $row = mysqli_fetch_array($consulta, MYSQLI_ASSOC);

                if($row["Tipo"] == 1){
                    echo "  <META HTTP-EQUIV='REFRESH' CONTENT='0;URL=usuario/menu.php'> ";
                }
                else{
                    echo "  <META HTTP-EQUIV='REFRESH' CONTENT='0;URL=administrador/usuarios.php'> ";
                }
            }
        }
        else
        {
            echo "  <META HTTP-EQUIV='REFRESH' CONTENT='0;URL=Login.php'> ";
        }
    }

?>