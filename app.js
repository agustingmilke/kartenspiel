var express = require('express');
var app = express();
var path = require('path');
var server = require('http').Server(app);
var io = require('socket.io').listen(server);
var mysql   = require('mysql');
var name;
var ganadas=0;
var friends;

app.use(express.static(path.join(__dirname, 'public')));
    app.get('/',function(req,res){
    	console.log(req.query);

    	//name=req.query.name;
    	//friends=req.query.friends;
    	//ganadas=req.query.ganadas;	
       res.sendfile(__dirname+'/juego.html') ; 
       
    });
var rooms = [];
var users = [];
app.use(express.static('public'));
app.get('/hello', function(req, res) {  
  res.status(200).send("Hello World!");
});

io.on('connection', function(socket) {  
	var datos={
		name: name,
		ganadas: ganadas
		//friends: friends
	};
	socket.emit('inicio',datos);
  	socket.emit('rooms',rooms);
	/*var connection = mysql.createConnection({
	   host: 'localhost',
	   user: 'root',
	   password: '',
	   database: 'kartenspiel',
	   port: 3306
	});*/
  //console.log('Alguien se ha conectado con Sockets');
  
  /*socket.emit('preguntar');
  socket.on('db_results', function(data){
  	clave=data;
  	socket.emit('clave',clave);
  });

  socket.interval =   setInterval(function(){
                            sendDbdatatoClient( socket );
                        } , 3000);*/

  socket.on('disconnect',function(){
	 console.log("alguien se desconectooooo :C");
	 /*if( socket.interval ){
            clearInterval( socket.interval );
        }*/
  });	
  socket.on('new-message', function(data) {
    io.sockets.emit('messages', data);
  });
  socket.on('new-room',function(data){
  	rooms.push(data);
  	io.sockets.emit('rooms',rooms);
  });
  socket.on('new-player',function(data){
  	for(var x=0;x<rooms.length;x++){
  		if(rooms[x].name==data){
  			rooms[x].player++;
  			if(rooms[x].player>=2){
  				rooms[x].status=1;
  			}
  			if(rooms[x].player==4){
  				rooms[x].status=2;
  			}
  		}
  	}
  	io.sockets.emit('rooms',rooms);
  })
  socket.on('new-Tower',function(data){
    io.sockets.emit('Tower',data)
  })
  socket.on('new-Winner',function(data){
  	io.sockets.emit('Winner',data)
  });
  socket.on('new-Desc',function(data){
    io.sockets.emit('Desc',data);
  });
  socket.on('new-Asc',function(data){
    io.sockets.emit('Asc',data);
  });
  socket.on('new-Alm',function(data){
    io.sockets.emit('Alm',data);
  });
  socket.on('new-sigAlm',function(data){
    io.sockets.emit('sigAlm',data);
  });
  socket.on('turn',function(data){
    io.sockets.emit('sigTurn',data);
  });
  socket.on('new-game',function(data){
  	for(var x=0;x<rooms.length;x++){
  		if(rooms[x].name==data){
  			rooms[x].status=3;
  			io.sockets.emit('sig-game',rooms[x]);

  		}
  	}
  	for(var x=0;x<users.length;x++){
  		if(users[x].Sala==data){
  			users[x].status=1;
  		}
  	}
  	io.sockets.emit('sigUser',users);
  	io.sockets.emit('rooms',rooms);
  })
  socket.on('new-user',function(data){
  	users.push(data);
    io.sockets.emit('sigUser',users);
  });
  socket.on('new-Username',function(data){
    io.sockets.emit('Username',data);
  });
  socket.on('new-reset',function(data){
  	for(var x=0;x<rooms.length;x++){
  		if(rooms[x].name==data.Sala){
  			rooms[x].status=1;
  			rooms[x].player=data.contador;
  		}
  	}
  	for(var x=0;x<users.length;x++){
  		if(users[x].Sala==data.Sala){
  			users[x].status=0;
  		}
  	}
  	io.sockets.emit('rooms',rooms);
  	io.sockets.emit('sigUser',users);
  	io.sockets.emit('reset',data.Sala);
  });
  socket.on('new-close',function(data){
  	io.sockets.emit('close',data);
  	for(var x=0;x<users.length;x++){
  		if(users[x].Sala==data){
  			users.splice(x,1);
  		}
  	}
  	for(var x=0;x<rooms.length;x++){
  		if(rooms[x].name==data){
  			rooms.splice(x,1);
  		}
  	}
  	io.sockets.emit('rooms',rooms);
  });
  socket.on('delete-User',function(data){
  	io.sockets.emit('delUser',data);
  	for(var x=0;x<users.length;x++){
  		if(users[x].Sala==data.Sala){
  			if(users[x].player==data.player)
  				users.splice(x,1);
  		}
  	}
  });

    
});

server.listen(8080, function() {  
  console.log("Servidor corriendo en http://localhost:8080");
});

