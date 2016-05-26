<?php   
        include ("../metodos.php");

        $obj=new metodos();

        if(isset($_SESSION['usuario']))
        {

        }
        else
        {
            echo "no hay";
        }

        $con = mysqli_connect("localhost", "root", "", "kartenspiel");  
        $consulta = mysqli_query($con, "select partidas_g from usuarios where Usuario = '".$_SESSION['usuario']."'");
      if($row = mysqli_fetch_array($consulta, MYSQLI_ASSOC)){
      $x = $row['partidas_g'];
    }
//calidad y efectividad en ventas
    ?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>KartenSpiel</title>
  <meta name="viewport" content="width=device-width, inicial-scale=1, maximum-scale=1">
  <link rel="stylesheet" href="/css/style.css" media="all" type="text/css"/>
  <script src="/socket.io/socket.io.js"></script>
  <script src="/js/main.js"></script>
  <script src="/js/play.js"></script>
</head>
<body align="center" style="background-image: url(images/Fondo_5.jpg)">
  <div id="Seleccion">
  <center>
  <table>
    <tr>
      <td id="S1" onclick="Selection(1)"><img src="images/Carta_1_1.jpg" width="120" height="180"></td>
      <td></td>
      <td><div id='S4' onclick='Selection(4)' style='background-image: url(images/Fondo_1.jpg); height: 180px; width: 280px'></div></td>
      <td></td>
      <td rowspan= 2 id="MuestraF" style="background-image: url(images/Fondo_1.jpg); height: 360px; width: 240px;"><div id="MuestraC" align="center"><img src="images/Carta_1_1.jpg" width="120" height="180"></div></td>
    </tr>
    <tr>
      <td id="S2"><?php
          if($x > 4){
            echo "<img onclick='Selection(2)' src='images/Carta_2_1.jpg' width='120px' height='180px'>";
          }
          else{
            echo "<img src='images/Carta_2_X.jpg' width='120px' height='180px'>";
          }
        ?></td> 
      <td id="Mas"><img src="images/mas.png"width="180" height="180"></td>
      <td ><?php
          if($x > 9){
            echo "<div id='S5' onclick='Selection(5)' style='background-image: url(images/Fondo_2.jpg); height: 180px; width: 280px'></div>";
          }
          else{
            echo "<div id='S5' style='background-image: url(images/Fondo_2.jpg); height: 180px; width: 280px'><div align='center'><br><img src='images/candado.png' width='200' height='130'></div></div>";
          }
        ?></td>
      <td id="Igual"><img src="images/igual.png"width="180" height="180"></td>
    </tr>
    <tr>
      <td id="S3"><?php
          if($x > 14){
            echo "<img onclick='Selection(3)' src='images/Carta_3_1.jpg' width='120px' height='180px'>";
          }
          else{
            echo "<img src='images/Carta_3_X.jpg' width='120px' height='180px'>";
          }
        ?></td>
      <td></td>
      <td ><?php
          if($x > 19){
            echo "<div id='S6' onclick='Selection(6)' style='background-image: url(images/Fondo_3.jpg); height: 180px; width: 280px'></div>";
          }
          else{
            echo "<div id='S6' style='background-image: url(images/Fondo_3.jpg); height: 180px; width: 280px'><div align='center'><br><img src='images/candado.png' width='200' height='130'></div></div>";
          }
        ?></td>
      <td></td>
      <td id="Aceptar" onclick="Mostrar()"><img src="images/aceptar.png"width="180" height="180"></td>
    </tr>
  </table>
</center>

  </div>
  <div id ="content" align="center" >
    <div id="board" >
      <table id="scores">

        <td>
          <div id="Titulo">KartenSpiel</div>
        </td>
        <td>
        Jugador: 
        </td>
        <td>
          <div id="jugador"></div>
        </td>
        <td>
        Turno: 
        </td>
        <td>
          <div id="Turno"></div>
        </td>
        
        
      </table>
      

      <!--<div id="player" align="center">-->
          <div id="playerB">
            <div id="jugadorB"></div>
            <div id="torreB"></div>
          </div>
          <div id="playerC">
            <div id="jugadorC"></div>
            <div id=torreC></div>
          </div>
          <div id="playerD">
            <div id="jugadorD"></div>
            <div id="torreD"></div>
          </div>
        
       <!--</div>-->
          <!--<img src="jugador_1.png" id="jugador1" class="player" width="150" height="150">-->
    
        
        <div class="rows">
            <div id="p0" onclick="CheckCell(14,0)" class="cell descendente"><div id="P0"class="horizontal"></div></div>
            <div id="p1" onclick="CheckCell(13,0)" class="cell descendente"><div id="P1"class="horizontal"></div></div>
            <div id="mz0" onclick="CheckCell(12,5)" class="cell mazo"><div id="MZ" class="vertical"></div></div>
            <div id="p2" onclick="CheckCell(11,1)" class="cell ascendente"><div id="P2"class="horizontal"></div></div>
            <div id="p3" onclick="CheckCell(10,1)" class="cell ascendente"><div id="P3"class="horizontal"></div></div>
            <div id="a0" onclick="CheckCell(9,2)" class="cell almacen"><div id="A0"class="vertical"></div></div>
            <div id="a1" onclick="CheckCell(8,2)" class="cell almacen"><div id="A1"class="vertical"></div></div>
            <div id="a2" onclick="CheckCell(7,2)" class="cell almacen"><div id="A2"class="vertical"></div></div>
            <div id="t" onclick="CheckCell(6,3)" class="cell torre"><div id="T" class="vertical"></div></div>
            <div id="m0" onclick="CheckCell(0,4)" class="cell mano"><div id="M0"class="horizontal"></div></div>
            <div id="m1" onclick="CheckCell(1,4)" class="cell mano"><div id="M1"class="horizontal"></div></div>
            <div id="m2" onclick="CheckCell(2,4)" class="cell mano"><div id="M2"class="horizontal"></div></div>
            <div id="m3" onclick="CheckCell(3,4)" class="cell mano"><div id="M3"class="horizontal"></div></div>
            <div id="m4" onclick="CheckCell(4,4)" class="cell mano"><div id="M4"class="horizontal"></div></div>
            <div id="m5" onclick="CheckCell(5,4)" class="cell mano"><div id="M5"class="horizontal"></div></div>
        </div>  
        <div id="chat">
          <div id="messages"></div>
          <br/>
          <form onsubmit="return addMessage(this)">
            <input type="text" id="texto" placeholder="Cuéntanos algo...">
            <br>
            <input type="submit" value="Enviar!">
          </form>
      </div>
    </div>
  </div>
  <script src="js/play.js"></script>
</body>
</html>