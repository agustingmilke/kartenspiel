var express = require('express');
var app = express();
var path = require('path');
var server = require('http').Server(app);
var io = require('socket.io').listen(server);
var mysql   = require('mysql');
var rooms = [];
var users = [];
var invitaciones = [];
var name;
var res;
var p;
var connection = mysql.createConnection({
     host: 'localhost',
     user: 'root',
     password: 'kartenspiel',
     database: 'kartenspiel',
     //port: 3306
  });
connection.connect();
connection.query('SELECT * from usuarios', function(err,rows,fields){
  if(!err)
    console.log(rows);
  else
    console.log('error en la base de datos');
});
app.use(express.static(path.join(__dirname, 'public')));
    app.get('/',function(req,res){
      console.log(req.query);
      name=req.query.name;
      res.sendfile(__dirname+'/juego.html') ;  
    });
app.use(express.static('public'));
app.get('/hello', function(req, res) {  
  res.status(200).send("Hello World!");
});
io.on('connection', function(socket) {  
  socket.emit('inicio',name);
    socket.emit('rooms',rooms);
    io.sockets.emit('invitacion',invitaciones);
  //console.log('Alguien se ha conectado con Sockets');
  socket.on('disconnect',function(){
   console.log("alguien se desconectooooo :C");
  }); 
  socket.on('new-ganadas', function(data) {
    //var ar = new Result([]);
    connection.query("SELECT partidas_g from usuarios where Usuario='"+data+"'", function(err,result,fields){
      if(err)throw err;
      console.log(result[0].partidas_g);
      //var res=result[0].partidas_g;
      var card ={
        res: result[0].partidas_g,
        player: data
      }
      io.sockets.emit('ganadas',card);
    });
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
        if(rooms[x].player>=2&&rooms[x].status==0){
          rooms[x].status=1;
        }
        if(rooms[x].player==4){
          rooms[x].status=2;
        }
        if(rooms[x].player>=2&&rooms[x].status==4){
          rooms[x].status=5;
        }
      }
    }
    io.sockets.emit('rooms',rooms);
  })
  socket.on('new-Tower',function(data){
    io.sockets.emit('Tower',data)
  })
  socket.on('new-Winner',function(data){
    connection.query("SELECT partidas_g from usuarios where Usuario='"+data.player+"'", function(err,result,fields){
      if(err)throw err;
      else{
        p=result[0].partidas_g;
        p++;
        connection.query("UPDATE usuarios SET partidas_g="+p+" WHERE Usuario='"+data.player+"'");
      }
    });
    for(x=0;x<users.length;x++){
        if(users[x].Sala==data.Sala&&users[x].player!=data.player){
          user=users[x].player;
          perdidas(user)
        }
      }
    
    io.sockets.emit('Winner',data);
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
    /*for(var x=0;x<users.length;x++){
      if(users[x].player==data.player){
        users[x].Sala=data.Sala;
        users[x].status=0;
      }
    }*/
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
        if(users[x].player==data.player){
          if(users[x].status==1){
            perdidas(users[x].player)
          }
          users.splice(x,1);
          for(y=0;y<rooms.length;y++){
            if(data.Sala==rooms[y].name){
              rooms[y].player=rooms[y].player-1;
              if(rooms[y].player==3){
                rooms[y].status=1;
              }
              io.sockets.emit('rooms',rooms);
            }
          }
        }
      }
    }
    io.sockets.emit('sigUser',users);
  }); 
  socket.on('consultaAmigos',function(data){
    connection.query("SELECT Amigo from amigos where Usuario ='"+data+"'", function(err,rows,fields){
      if(!err){
        console.log(rows);
        rows.unshift(data);
        io.sockets.emit('Amigos',rows);
      }
        
      else
        console.log('error en la base de datos');
    });
  });
  socket.on('new-invitacion',function(data){
      invitaciones.push(data);
      io.sockets.emit('invitacion',invitaciones);
      io.sockets.emit('rooms',rooms);
  }); 
  socket.on('new-solicitud',function(data){
      connection.query("INSERT INTO `solicitud`(`Id`, `Solicitante`, `Solicitado`) VALUES (NULL,'"+data.player+"','"+data.amigo+"')");
  });
});

server.listen(8080, function() {  
  console.log("Servidor corriendo en http://localhost:8080");
});

function perdidas(user){
  connection.query("SELECT partidas_p from usuarios where Usuario='"+user+"'",function(err,result,fields){
            if(err)throw err;
            else{
              //console.log(result[0].partidas_p);

              p=result[0].partidas_p;
              p++;
              //console.log(p);
              console.log(user);
              connection.query("UPDATE usuarios SET partidas_p="+p+" WHERE Usuario='"+user+"'");
            }
          });
}