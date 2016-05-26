var socket = io.connect('http://192.241.188.222:8080', { 'forceNew': true });

var rooms =[];
var Turnos=[5];
for(x=0;x<5;x++)
  Turnos[x]=false;
socket.on('inicio',function(data){
  player = data.name;
  ganadas = data.ganadas;
 // friends = data.friends;
  //alert(player);
  //alert(ganadas);
  //alert(friends);
  if(ganadas > 4){
    document.getElementById("S2").innerHTML = "<img onclick='Selection(2)' src='images/Carta_2_1.jpg' width='120px' height='180px'>";
  }
  else{
    document.getElementById("S2").innerHTML = "<img src='images/Carta_2_X.jpg' width='120px' height='180px'>";
  }
  if(ganadas > 9){
    document.getElementById("S5").innerHTML = "<div id='s5' onclick='Selection(5)' style='background-image: url(images/Fondo_2.jpg); height: 180px; width: 280px'></div>";
  }
  else{
    document.getElementById("S5").innerHTML = "<div id='s5' style='background-image: url(images/Fondo_2.jpg); height: 180px; width: 280px'><div align='center'><br><img src='images/candado.png' width='200' height='130'></div></div>";
  }
  if(ganadas > 14){
    document.getElementById("S3").innerHTML = "<img onclick='Selection(3)' src='images/Carta_3_1.jpg' width='120px' height='180px'>";
  }
  else{
    document.getElementById("S3").innerHTML = "<img src='images/Carta_3_X.jpg' width='120px' height='180px'>";
  }
  if(ganadas > 19){
    document.getElementById("S6").innerHTML = "<div id='s6' onclick='Selection(6)' style='background-image: url(images/Fondo_3.jpg); height: 180px; width: 280px'></div>";
  }
  else{
    document.getElementById("S6").innerHTML = "<div id='s6' style='background-image: url(images/Fondo_3.jpg); height: 180px; width: 280px'><div align='center'><br><img src='images/candado.png' width='200' height='130'></div></div>";
  }
})
socket.on('Username',function(data){
  if(data.Sala==Sala){

    if(contador==2){
       if(idplayer!=data.idplayer){
         document.getElementById(`usuarioB`).innerHTML =  `${data.player}` ;
        }
    }
    if(contador==3){
      if(idplayer!=data.idplayer){
        if((idplayer == 1 && data.idplayer == 3)||(idplayer == 2 && data.idplayer == 1)||(idplayer == 3 && data.idplayer == 2)){
          document.getElementById(`usuarioB`).innerHTML =  `${data.player}` ;
        }
        if((idplayer == 1 && data.idplayer == 2)||(idplayer == 2 && data.idplayer == 3)||(idplayer == 3 && data.idplayer == 1)){
          document.getElementById(`usuarioC`).innerHTML =  `${data.player}` ;
        }
      }
    }
    if(contador==4){
      if(idplayer!=data.idplayer){
        if((idplayer == 1 && data.idplayer == 4)||(idplayer == 2 && data.idplayer == 1)||(idplayer == 3 && data.idplayer == 2)||(idplayer == 4 && data.idplayer == 3)){
          document.getElementById(`usuarioB`).innerHTML =  `${data.player}` ;
        }
        if((idplayer == 1 && data.idplayer == 3)||(idplayer == 2 && data.idplayer == 4)||(idplayer == 3 && data.idplayer == 1)||(idplayer == 4 && data.idplayer == 2)){
          document.getElementById(`usuarioC`).innerHTML =  `${data.player}` ;
        }
        if((idplayer == 1 && data.idplayer == 2)||(idplayer == 2 && data.idplayer == 3)||(idplayer == 3 && data.idplayer == 4)||(idplayer == 4 && data.idplayer == 1)){
          document.getElementById(`usuarioD`).innerHTML =  `${data.player}` ;
        }
      }
    }
  }
})
socket.on('delUser',function(data){
  if(data.Sala==Sala){
      restantes--;
      Turnos[data.idplayer]=false;
      if(contador==4){
          if((idplayer == 1 && data.idplayer == 4)||(idplayer == 2 && data.idplayer == 1)||(idplayer == 3 && data.idplayer == 2)||(idplayer == 4 && data.idplayer == 3)){
          document.getElementById('usuarioB').innerHTML = ' ';
          document.getElementById('jugadorB').innerHTML = '';
          document.getElementById('torreB').innerHTML = '';
          }
          if((idplayer == 1 && data.idplayer == 3)||(idplayer == 2 && data.idplayer == 4)||(idplayer == 3 && data.idplayer == 1)||(idplayer == 4 && data.idplayer == 2)){
          document.getElementById('usuarioC').innerHTML = ' ';
          document.getElementById('jugadorC').innerHTML = '';
          document.getElementById('torreC').innerHTML = '';
          }
          if((idplayer == 1 && data.idplayer == 2)||(idplayer == 2 && data.idplayer == 3)||(idplayer == 3 && data.idplayer == 4)||(idplayer == 4 && data.idplayer == 1)){
          document.getElementById('usuarioD').innerHTML = ' ';
          document.getElementById('jugadorD').innerHTML = '';
          document.getElementById('torreD').innerHTML = '';
          }
        }
        if(contador==3){
          if((idplayer == 1 && data.idplayer == 3)||(idplayer == 2 && data.idplayer == 1)||(idplayer == 3 && data.idplayer == 2)){
          document.getElementById('usuarioB').innerHTML = ' ';
          document.getElementById('jugadorB').innerHTML = '';
          document.getElementById('torreB').innerHTML = '';
          }
          if((idplayer == 1 && data.idplayer == 2)||(idplayer == 2 && data.idplayer == 3)||(idplayer == 3 && data.idplayer == 1)){
          document.getElementById('usuarioC').innerHTML = ' ';
          document.getElementById('jugadorC').innerHTML = '';
          document.getElementById('torreC').innerHTML = '';
          }
        }
        if(contador==2||restantes==1){
          document.getElementById('usuarioB').innerHTML = ' ';
          document.getElementById('jugadorB').innerHTML = '';
          document.getElementById('torreB').innerHTML = '';
          addWinner(Sala,player)
        }
      if(data.idplayer==turn){
          do{
            turn = turn + 1;
          if(turn == 5 && contador == 4)
            turn = 1;
          if(turn == 4 && contador == 3)
            turn = 1;
          if(turn == 3 && contador == 2)
            turn = 1;
          }while(Turnos[turn]==false);
          var Turn = {
            turn: turn,
            Sala: Sala
          };
          socket.emit('turn',Turn);
      }
        
  }
})
socket.on('Tower', function(data) {
  if(data.Sala==Sala){
    if(contador==2){
       if(idplayer!=data.player){
         document.getElementById(`torreB`).innerHTML =  `<img src='images/Carta_${SC}_${data.value}.jpg' width='50' height='80' ></img>`;
        }
    }
    if(contador==3){
      if(idplayer!=data.player){
        if((idplayer == 1 && data.player == 3)||(idplayer == 2 && data.player == 1)||(idplayer == 3 && data.player == 2)){
          document.getElementById(`torreB`).innerHTML =  `<img src='images/Carta_${SC}_${data.value}.jpg' width='50' height='80' ></img>`;
        }
        if((idplayer == 1 && data.player == 2)||(idplayer == 2 && data.player == 3)||(idplayer == 3 && data.player == 1)){
          document.getElementById(`torreC`).innerHTML =  `<img src='images/Carta_${SC}_${data.value}.jpg' width='50' height='80' ></img>`;
        }
      }
    }
    if(contador==4){
      if(idplayer!=data.player){
        if((idplayer == 1 && data.player == 4)||(idplayer == 2 && data.player == 1)||(idplayer == 3 && data.player == 2)||(idplayer == 4 && data.player == 3)){
          document.getElementById(`torreB`).innerHTML =  `<img src='images/Carta_${SC}_${data.value}.jpg' width='50' height='80' ></img>`;
        }
        if((idplayer == 1 && data.player == 3)||(idplayer == 2 && data.player == 4)||(idplayer == 3 && data.player == 1)||(idplayer == 4 && data.player == 2)){
          document.getElementById(`torreC`).innerHTML =  `<img src='images/Carta_${SC}_${data.value}.jpg' width='50' height='80' ></img>`;
        }
        if((idplayer == 1 && data.player == 2)||(idplayer == 2 && data.player == 3)||(idplayer == 3 && data.player == 4)||(idplayer == 4 && data.player == 1)){
          document.getElementById(`torreD`).innerHTML =  `<img src='images/Carta_${SC}_${data.value}.jpg' width='50' height='80' ></img>`;
        }
      }
    }
  }
})
socket.on('Desc',function(data){
  if(data.Sala==Sala){
    if(data.value==1){
    board[data.position]=null;
    document.getElementById(`P${data.cell}`).innerHTML = "";
    document.getElementById(`P${data.cell}`).style.visibility="hidden";
    }
    else{
      board[data.position]= data.value;
      document.getElementById(`P${data.cell}`).innerHTML = `<img src='images/Carta_${SC}_${data.value}.jpg' width='100' height='160' ></img>`;
    }
  } 
})
socket.on('Asc',function(data){
  if(data.Sala==Sala){
    if(data.value==12){
      board[data.position]=null;
      document.getElementById(`P${data.cell}`).innerHTML = "";
      document.getElementById(`P${data.cell}`).style.visibility="hidden";
    }
    else{
      board[data.position]= data.value;
      document.getElementById(`P${data.cell}`).innerHTML = `<img src='images/Carta_${SC}_${data.value}.jpg' width='100' height='160' ></img>`;
    }
  }
})
socket.on('Alm',function(data){
  if(data.Sala==Sala){ 
    board[data.position]= data.value;
    for(var t=20;t>0;t--){
            almacen[data.cell][t]=almacen[data.cell][t-1];
    }
    almacen[data.cell][0]=data.value;
    document.getElementById(`A${data.cell}`).innerHTML = `<img src='images/Carta_${SC}_${almacen[data.cell][0]}.jpg' width='100' height='160' ></img>`;
    document.getElementById(`A${data.value}`).style.visibility="visible";
  }
})
socket.on('sigAlm',function(data){
  if(data.Sala==Sala){ 
          if(data.value==0)s=9;
          if(data.value==1)s=8;
          if(data.value==2)s=7;
          for(var t=0;t<20;t++){
          almacen[data.value][t]=almacen[data.value][t+1];
          }
          board[s]=almacen[data.value][0];
          if (almacen[data.value][0]!=13){
            document.getElementById(`A${data.value}`).innerHTML = `<img src='images/Carta_${SC}_${almacen[data.value][0]}.jpg' width='100' height='160' ></img>`;
            document.getElementById(`A${data.value}`).style.visibility="visible";
          }
          else{
            document.getElementById(`A${data.value}`).innerHTML = "";
          }
  }
})
socket.on('sigUser',function(data){
  var html = data.map(function(elem, index) {
    if(elem.Sala==Sala&&elem.status==0)
      return (`<div>${elem.player}</div>`);
  }).join(" ");
  document.getElementById('name_room').innerHTML = `<h1>${Sala}</h1>`;
  document.getElementById('listaUsuarios').innerHTML = html;
})
socket.on('sigTurn',function(data){
  if(data.Sala==Sala){
    if(idplayer==data.turn){
      turno=true;
      document.getElementById('salir').innerHTML = '<img src="images/cerrar_sesion.png" onclick="Abandono()" class="player" width="90" height="80">';
    }
    else{
      document.getElementById('salir').innerHTML = '';
    }
    document.getElementById(`Turno`).innerHTML = `${data.turn}`;
  }
})
socket.on('messages', function(data) {  
  if(data.Sala==Sala)
  document.getElementById('messages').innerHTML += `<div><strong>${data.author}</strong>:<em>${data.text}</em></div>`;
})
socket.on('rooms',function(data){
  rooms=[];
  var html = data.map(function(elem, index) {
    rooms.push(elem.name);
    if(elem.status==2)return ``;    //sala llena
    if(elem.status==3)return ``;    //juego en curso
    return(`<div>
              <strong>${elem.name},${elem.player}</strong><img src="images/aceptar.png" onclick="unirse('${elem.name}',${elem.player})" width="50" height="50">
            </div>`);
  }).join(" ");
  document.getElementById('listaSalas').innerHTML = html;
  var html = data.map(function(elem, index) {
    if(elem.admin==idplayer&&(elem.status==1||elem.status==2)&&elem.name==Sala)
     return('<img src="images/aceptar.png" onclick="iniciar(Sala)"width="90" height="90">');
  }).join(" ");
  document.getElementById("empezar").innerHTML = html;
})
socket.on('sig-game',function(data){  
  if(data.name==Sala){
    MostrarSeleccion()
    contador=data.player;
    restantes=contador;
    if(data.player==2)
      document.getElementById(`jugadorB`).innerHTML = '<img src="images/jugador_1.png" class="player" width="90" height="80">';
      Turnos[1]=true;
      Turnos[2]=true;
    if(data.player==3){
      document.getElementById(`jugadorB`).innerHTML = '<img src="images/jugador_1.png" class="player" width="90" height="80">';
      document.getElementById(`jugadorC`).innerHTML = '<img src="images/jugador_2.png" class="player" width="90" height="80">';
      Turnos[1]=true;
      Turnos[2]=true;
      Turnos[3]=true;
    }
    if(data.player==4){
      document.getElementById(`jugadorB`).innerHTML = '<img src="images/jugador_1.png" class="player" width="90" height="80">';
      document.getElementById(`jugadorC`).innerHTML = '<img src="images/jugador_2.png" class="player" width="90" height="80">';
      document.getElementById(`jugadorD`).innerHTML = '<img src="images/jugador_3.png" class="player" width="90" height="80">';
      Turnos[1]=true;
      Turnos[2]=true;
      Turnos[3]=true;
      Turnos[4]=true;
    }
  }
})
socket.on('Winner',function(data){
  if(data.Sala==Sala){
    document.getElementById('board').style.display="none"
    document.getElementById("ganador").style.display="block";
    if(data.player==player){          
      document.getElementById('ganador').innerHTML = `<br><img src="images/confeti.gif"><img src="images/ganaste.gif"><img src="images/confeti.gif">
                                                      <br><br><div><img src="images/cerrar_sesion.png" onclick="cerrarSala(Sala)" width="110" height="110">
                                                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                      <img src="images/reiniciar.png" onclick="reiniciarSala(Sala)" width="110" height="110"></div>`;
    }
    else
      document.getElementById('ganador').innerHTML = `<br><br><img src="images/perdiste.gif"><br>El jugador ${data.player} ha ganado ¡¡`;
    document.getElementById('ganador').innerHTML +=`  <br>
                                                      <br>
                                                      <table id="amigos">
                                                        <tr><td id="AmigoB"> </td><td id="AmigoC"> </td><td id="AmigoD"> </td></tr>
                                                        <tr><td id="SolicitudB"></td><td id="SolicitudC"></td><td id="SolicitudD"></td></tr>      
                                                    </table>`;
    UserB = document.getElementById("usuarioB").innerHTML;
    UserC = document.getElementById("usuarioC").innerHTML;
    UserD = document.getElementById("usuarioD").innerHTML;
    document.getElementById("AmigoB").innerHTML = UserB;
    document.getElementById("AmigoC").innerHTML = UserC;
    document.getElementById("AmigoD").innerHTML = UserD;
    if(document.getElementById("usuarioB").innerHTML!= ' '){
      document.getElementById("SolicitudB").innerHTML= `<img src ="images/add.png" onclick="solicitud(${UserB})" width="70" height="70">`;
    }
    if(document.getElementById("usuarioC").innerHTML!= ' '){
      document.getElementById("SolicitudC").innerHTML= `<img src ="images/add.png" onclick="solicitud(${UserC})" width="70" height="70">`;
    }
    if(document.getElementById("usuarioD").innerHTML!= ' '){
      document.getElementById("SolicitudD").innerHTML= `<img src ="images/add.png" onclick="solicitud(${UserD})" width="70" height="70">`;
    }
  }
})
socket.on('reset',function(data){
  if(data==Sala){
    document.getElementById("board").style.display="block";
    document.getElementById("ganador").style.display="none";
    MostrarUsuarios()
  }
})
socket.on('close',function(data){
  if(data==Sala){
    document.getElementById("board").style.display="block";
    document.getElementById("ganador").style.display="none";
    MostrarModo()
  }
})
function addMessage(e) {  
  var message = {
    author: player,
    text: document.getElementById('texto').value,
    Sala: Sala
  };
  document.getElementById('texto').value="";
  socket.emit('new-message', message);
  return false;
}
function addDesc(i,x,c,Sala){
  var card = {
    value: i,
    position: x,
    cell: c,
    Sala: Sala
  };

  socket.emit('new-Desc',card);
  return false;
}
function addAsc(i,x,c,Sala){
  var card = {
    value: i,
    position: x,
    cell: c,
    Sala: Sala
  };

  socket.emit('new-Asc',card);
  return false;
}
function addAlm(i,x,c,Sala){
  var card = {
    value: i,
    position: x,
    cell: c,
    Sala: Sala
  };
  turn = idplayer;
  do{
    turn = turn + 1;
  if(turn == 5 && contador == 4)
    turn = 1;
  if(turn == 4 && contador == 3)
    turn = 1;
  if(turn == 3 && contador == 2)
    turn = 1;
  }while(Turnos[turn]==false);
  var Turn = {
    turn: turn,
    Sala: Sala
  };
  socket.emit('new-Alm',card);
  socket.emit('turn',Turn);
  return false;
}
function addSigAlm(c,Sala){
  var card = {
    value: c,
    Sala: Sala
  } 
  socket.emit('new-sigAlm',card);
  return false;
}
function addTower(idplayer,value,Sala){
  var card = {
    player: idplayer,
    value: value,
    Sala: Sala
  };
  socket.emit('new-Tower',card);
  return false;
}
function addUsername(idplayer,player,Sala){
  var card = {
    idplayer: idplayer,
    player: player,
    Sala: Sala
  };
  socket.emit('new-Username',card);
  return false;
}
function addWinner(Sala,player){
  var card = {
    Sala: Sala,
    player: player
  }
  socket.emit('new-Winner',card);
  return false;
}
function Crear(op){

  if(op==0){

  }
  if(op==1){
    var room = {
      name: document.getElementById("room").value,
      status: 0,
      player: 1,
      admin: 1
    }

    Sala = room.name;
    idplayer = 1;
    player = "jugador "+ idplayer;
    turno = true;
    document.getElementById("room").innerHTML = Sala;
    document.getElementById("jugador").innerHTML = idplayer;
    document.getElementById("Sala").innerHTML = room.name;
    
    socket.emit('new-room', room);
    var user = {
      Sala: Sala,
      player: player,
      status: 0
    }

    socket.emit('new-user',user);
    
  }
  MostrarUsuarios()
  return false;
}
function iniciar(Sala){
  socket.emit('new-game',Sala);
  var Turn = {
    turn: 1,
    Sala: Sala
    };
  socket.emit('turn',Turn);
}
function unirse(name,IDP){
  document.getElementById("Sala").innerHTML = name;
  socket.emit('new-player',name); //avisa que alguien se ha unido a la sala

  Sala = name;
  idplayer = IDP+1;
  turno=false;
  document.getElementById("jugador").innerHTML = idplayer;
  player = "jugador "+ idplayer;

  var user = {
      Sala: Sala,
      player: player,
      status: 0
    }
    socket.emit('new-user',user);
  MostrarUsuarios()
  
  return false;
}
function reiniciarSala(Sala){
  var card = {
    Sala: Sala,
    contador: restantes
  }
  socket.emit('new-reset',card);
  return false;
}
function cerrarSala(Sala){
  socket.emit('new-close',Sala);
  return false;
}
function Abandono(){
  var card={
    idplayer: idplayer,
    player: player,
    Sala: Sala
  };
  socket.emit('delete-User',card);
  var message = {
    author: player+" ha abandonado la partida",
    text: '',
    Sala: Sala
  };
  socket.emit('new-message', message);
  //document.getElementById('texto').value="";
  
  Sala="";
  MostrarModo()
  return false;
}