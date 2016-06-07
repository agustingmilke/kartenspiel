var Total_secs;
var Total_mins;
var cronometer;
var board = new Array(14);
var almacen = new Array(3);

//w = variable que se utiliza para saber si el jugador ya robo cartas en su turno
//j = guarda el valor anterior de la pila, para ser comparada despues
//i = guarda el valor seleccionado de la torre, mano o almacen
//s = direccion seleccionada anteriormente
//x = direccion actual
//z = grupo seleccionado (0: pilas desc, 1: pilas asc, 2: almacen, 3: torre, 4: mano, 5: mazo)
//q = grupo seleccionado anteriormente (0: almacen, 1: torre, 2: mano, 4: no hay seleccion)
//t = cartas de la torre que han sido usadas
function musica(){
	
}
function SelectCell(x, y){
		if(x<6)M = document.getElementById("M"+x);
		else if(x==6){
			M = document.getElementById("T");
			addTower(idplayer,y,Sala)

		}
		board[x]=y;
		M.innerHTML="<img src='images/Carta_"+SC+"_"+y+".jpg' width='100' height='160'></img>";
		M.style.visibility="visible";
}
function CheckCell(x,z){
		if(z==0&&w!=1&&turno==true){
			j=board[x];
			 if((i==12&&(j==null||j==13))||((i==j-1||i==0)&&i<13)){
				if(x==14)c=0;
				if(x==13)c=1;
				M = document.getElementById("P"+c);
				if(i==0)i=j-1;
				if(j==null){
					i=12;
					M.style.visibility="visible";
				}
				board[x]=i;
				M.innerHTML="<img src='images/Carta_"+SC+"_"+i+".jpg' width='100' height='160' ></img>";
				addDesc(i,x,c,Sala)
				if(i==1){
					i=13;
					board[x]=null;
					M.innerHTML="";
				}
				if(q==2){
						q=4;
						board[s]=13;
						i=13;
						y=0;
						for(c=0;c<6;c++){
							if(board[c]!=13){
								y=1;
							}	
						}
						if(y==0){
							for(x=0;x<6;x++){
							y=Math.round(Math.random()*12);
							SelectCell(x,y);
							}
						}
						else{
							N = document.getElementById("M"+s);
							N.innerHTML="";
						}			
				}
				else if(q==0){
					if(s==9)c=0;
					if(s==8)c=1;
					if(s==7)c=2;
					N = document.getElementById("A"+c);
					q=4;
					addSigAlm(c,Sala)
					i=13;	
				}
				else if(q==1){
					N = document.getElementById("T");
					q=4;
					y=Math.round(Math.random()*12);
					SelectCell(s,y);
					t++;
					if(t==6){
						board[s]=13;
						i=13;
						N.innerHTML="";
						addWinner(Sala,player)
					}
				}
			}
		}
		if(z==1&&w!=1&&turno==true){
			j=board[x];
			 if((i==1&&(j==null||j==13))||((i==j+1||i==0)&&i<13)){
				if(x==11)c=2;
				if(x==10)c=3;
				if(i==0)i=j+1;
				M = document.getElementById("P"+c);
				if(j==null){
					i=1;
					M.style.visibility="visible";
				}	
				board[x]=i;
				M.innerHTML="<img src='images/Carta_"+SC+"_"+i+".jpg' width='100' height='160' ></img>";
				addAsc(i,x,c,Sala)
				if(i==12){
					i=13;
					board[x]=null;
					M.innerHTML="";
				}
				if(q==2){
					q=4;
					board[s]=13;
					i=13;
					y=0;
						for(c=0;c<6;c++){
							if(board[c]!=13){
								y=1;
							}
						}
						if(y==0){
							for(x=0;x<6;x++){
							y=Math.round(Math.random()*12);
							SelectCell(x,y);
							}
						}
						else{
							N = document.getElementById("M"+s);
							N.innerHTML="";
						}						
				}
				else if(q==0){
					if(s==9)c=0;
					if(s==8)c=1;
					if(s==7)c=2;
					N = document.getElementById("A"+c);
					q=4;
					addSigAlm(c,Sala)
					i=13;
				}
				else if(q==1){
					N = document.getElementById("T");
					q=4;
					y=Math.round(Math.random()*12);
					SelectCell(s,y);
					t++;
					if(t==6){
						board[s]=13;
						i=13;
						N.innerHTML="";
						addWinner(Sala,player)
					}
				}
			}
		}
		if(z==2&&w!=1&&turno==true){
			if(q==2){
				if(x==9)c=0;
				if(x==8)c=1;
				if(x==7)c=2;
				addAlm(i,x,c,Sala)
				M.style.visibility="visible";
				N = document.getElementById("M"+s);
				board[s]=13;
				i=13;
				N.innerHTML="";
				turno=false;
				w=1;
			}
			else{
				i=board[x];
				s=x;
				q=0;
			}
		}
		if(z==3&&turno==true){
			i=board[x];
			s=x;
			q=1;
		}
		if(z==4&&turno==true&&board[x]!=13){
			i=board[x];
			s=x;
			q=2;
		}
		if(z==5&&turno==true){
			if(w==1){
				for(x=0;x<6;x++){
					y=Math.round(Math.random()*12);
					if(board[x]==13){
						SelectCell(x,y);
					}	
				}
				q=4;
				w=0;
			}
		}
}
function play(){
	i=13;
	t=0;
	w=0;
	for(var x=0;x<3;x++){
	almacen[x]= new Array(20);
		for (var y=0;y<20;y++){
			almacen[x][y]=13;
		} 
	}
	t=0;
	for(x=0;x<7;x++){
		y=Math.round(Math.random()*12);
		SelectCell(x,y);
	}
	addUsername(idplayer,player,Sala)
}
function Selection(S){
	switch(S){
		case 1:
			M = document.getElementById("MuestraC");
			M.innerHTML="<img src='images/Carta_1_1.jpg' width='120' height='180' ></img>";
			SC=1;
			break;
		case 2:
			M = document.getElementById("MuestraC");
			M.innerHTML="<img src='images/Carta_2_1.jpg' width='120' height='180' ></img>";
			SC=2;
			break;	
		case 3:
			M = document.getElementById("MuestraC");
			M.innerHTML="<img src='images/Carta_3_1.jpg' width='120' height='180' ></img>";
			SC=3;
			break;	
		case 4:
			M = document.getElementById("MuestraF");
			M.style ="background-image: url(images/Fondo_1.jpg); height: 360px; width: 240px;";
			SF=1;
			break;	
		case 5:
			M = document.getElementById("MuestraF");
			M.style ="background-image: url(images/Fondo_2.jpg); height: 360px; width: 240px;";
			SF=2;
			break;	
		case 6:
			M = document.getElementById("MuestraF");
			M.style ="background-image: url(images/Fondo_3.jpg); height: 360px; width: 240px;";
			SF=3;
			break;	
		default:
			break;	
	}	
}
function MostrarJuego(){
	document.getElementById("Seleccion").style.display="none";
	document.getElementById("modo").style.display="none";
	document.getElementById("Salas").style.display="none";
	document.getElementById("crearSalas").style.display="none";
	document.getElementById("content").style.display="block";
	document.getElementById("Usuarios").style.display="none";
	document.getElementById("content").style = "background-image: url(images/Fondo_"+SF+".jpg); height: 650px;";
	socket.emit('consultaAmigos',player);
	play()
}
function MostrarCrear(){
	document.getElementById("modo").style.display="none";
	document.getElementById("Seleccion").style.display="none";
	document.getElementById("content").style.display="none";
	document.getElementById("crearSalas").style.display="block";
	document.getElementById("Salas").style.display="none";
	document.getElementById("Usuarios").style.display="none";
	//alert(rooms);
}
function MostrarSalas(){
	document.getElementById("modo").style.display="none";
	document.getElementById("crearSalas").style.display="none";
	document.getElementById("Salas").style.display="block";
	document.getElementById("Seleccion").style.display="none";
	document.getElementById("content").style.display="none";
	document.getElementById("Usuarios").style.display="none";
}
function MostrarSeleccion(){
	socket.emit('new-ganadas',player);
	document.getElementById("P0").innerHTML="";
	document.getElementById("P1").innerHTML="";
	document.getElementById("P2").innerHTML="";
	document.getElementById("P3").innerHTML="";
	document.getElementById("A0").innerHTML="";
	document.getElementById("A1").innerHTML="";
	document.getElementById("A2").innerHTML="";
	document.getElementById("messages").innerHTML="";
	document.getElementById("torreB").innerHTML="";
	document.getElementById("jugadorB").innerHTML=" ";
	document.getElementById("usuarioB").innerHTML=" ";
	document.getElementById("torreC").innerHTML="";
	document.getElementById("jugadorC").innerHTML=" ";
	document.getElementById("usuarioC").innerHTML=" ";
	document.getElementById("torreD").innerHTML="";
	document.getElementById("jugadorD").innerHTML=" ";
	document.getElementById("usuarioD").innerHTML=" ";
		for(x=0;x<15;x++)
		board[x]=null;
	document.getElementById("Seleccion").style.display="block";
	document.getElementById("modo").style.display="none";
	document.getElementById("Salas").style.display="none";
	document.getElementById("crearSalas").style.display="none";
	document.getElementById("content").style.display="none";
	document.getElementById("Usuarios").style.display="none";
}
function MostrarModo(){
	document.getElementById("Seleccion").style.display="none";
	document.getElementById("modo").style.display="block";
	document.getElementById("Salas").style.display="none";
	document.getElementById("crearSalas").style.display="none";
	document.getElementById("content").style.display="none";
	document.getElementById("Usuarios").style.display="none";
}
function MostrarUsuarios(){
	document.getElementById("Seleccion").style.display="none";
	document.getElementById("modo").style.display="none";
	document.getElementById("Salas").style.display="none";
	document.getElementById("crearSalas").style.display="none";
	document.getElementById("content").style.display="none";
	document.getElementById("Usuarios").style.display="block";
}
function MostrarAmigos(){
	document.getElementById("Amigos").style.display="block";
	socket.emit('consultaAmigos',player);
}

document.getElementById("Seleccion").style.display="none";
document.getElementById("Salas").style.display="none";
document.getElementById("crearSalas").style.display="none";
document.getElementById("content").style.display="none";
document.getElementById("Usuarios").style.display="none";
document.getElementById("Amigos").style.display="none";
SC=1;
SF=1;
/*play();*/
