
<?php
    if (isset($_POST["password"]) && isset($_POST["usuario"])) {
        $con = mysqli_connect("localhost", "root", "", "kartenspiel");  
        $consulta = mysqli_query($con, "select * from usuarios where Usuario='".  $_POST["usuario"]  ."' and Contrasena='".  $_POST["password"]  ."'");
        if (mysqli_num_rows($consulta) > 0) {
            session_start();
            $_SESSION['usuario'] = $_POST["usuario"];

            $consulta = mysqli_query($con, "select Tipo from usuarios where Usuario='".  $_POST["usuario"]  ."'");
        
            $row = mysqli_fetch_array($consulta, MYSQLI_ASSOC);

            if($row["Tipo"] == 1){
                echo "  <META HTTP-EQUIV='REFRESH' CONTENT='0;URL=menu.php'> ";
            }
            else{
                echo "  <META HTTP-EQUIV='REFRESH' CONTENT='0;URL=administrador/usuarios.php'> ";
            }
        
        }
        else
        {
            echo "no pudo iniciar sesion";
        }
    }

?>