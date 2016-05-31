<!DOCTYPE html>

<HTML>


    <HEAD>
        <TITLE>Registro</TITLE>
        <link type='image/png' rel="icon" href="img/KartenSpiel_icono.png">
        <link rel="stylesheet" type="text/css" href="css/estilos.css">

    </HEAD>


    <BODY background="img/url.jpg">

        <HEADER>
        </HEADER>

        <NAV>
        </NAV>

        <SECTION class="registro">
        	<h1 align="center">Registro</h1>
            <center><img class='logros' src='img/linea.png' width='300px' height='20px'></center>
            <br>
            <form action = "codigo.php" method="post" onsubmit = "return validar()">
            <center> 
                <table width="50%">
                    <tr>
                        <td width="10%"><h2>Usuario:</h2></td> 
                        <td ><input name = "usuario" class="registro" type="text" placeholder="Usuario" align="center" id="usuario"></td>
                    </tr>
                    <tr>
                         <td width="10%"><h2>Contrase&ntildea:</h2></td>  
                         <td ><input name = "clave" class="registro" type="password" placeholder="Clave" align="center" id="clave"></td>
                    </tr>
                    <tr>
                        <td width="10%"><h2>Correo:</h2></td>  
                        <td ><input name = "correo" class="registro" type="text" placeholder="Correo" align="center" id="correo"></td>
                    </tr>
                    <tr>
                        <td width="10%"><h2>Nombre:</h2></td>   
                        <td ><input name = "nombre" class="registro" type="text" placeholder="Nombre" align="center"></td>
                    </tr>
                    <tr>
                        <td width="10%"><h2>Edad:</h2></td> 
                        <td ><input name = "edad" class="registro" type="number" placeholder="Edad" align="center"></td>
                    </tr>
                </table>
                <br><br>
                <input class="bMenu" type="submit" value="Registrarse" >
            </form>
            </center>
            <br>
        </SECTION>

        <FOOTER>
        </FOOTER>
    
    </BODY>

    <script>
        function validar(){
            var correo = document.getElementById("correo").value;
            var clave = document.getElementById("clave").value;
            var usuario = document.getElementById("usuario").value;
            var val_correo = /\w+([-+.']\w+)*@\w+([-.]\w+)*/;

            var array;
            if( val_correo.exec(correo)) {
                if(/\w{8,15}/.test(usuario)){
                    if(/[0-9]+/.test(clave) && /[A-Za-z]+/.test(clave) && /\w{8,15}/.test(clave)){
                        return true;    
                    }
                    else{
                        alert("El usuario necesita tener minimo 1 letra, minimo 1 numero y entre 8 y 15 caracteres");
                        return false;
                    }
                }
                else{
                    alert("El usuario tiene que tener entre 8 y 15 caracteres");
                    return false;
                }
                
            }
            else{
                alert("El correo no es valido");
                return false;
            }

        }

        

        function validarPasswd(){
            patron = /[0-9]{1}[A-Za-z]{1}/;
            if(patron.test(texto)){
                alert("okok");
                return true;
            }
            else{
                alert("aguantala, est mal");
                return false;
            }
        }

        function tiene_numeros(texto){
            for(i=0; i<texto.length; i++){
                if (numeros.indexOf(texto.charAt(i),0)!=-1){
                    return true;
                }
            }
            return false;
        }

        function tiene_letras(texto){
            texto = texto.toLowerCase();
            for(i=0; i<texto.length; i++){
               if (letras.indexOf(texto.charAt(i),0)!=-1){
                  return true;
               }
            }
            return false;
        }

    </script>



</HTML>
