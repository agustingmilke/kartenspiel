<?php

        include ("metodos.php");

        $con=new metodos();

        if(isset($_SESSION['usuario']))
        {
            
        }
        else
        {
            echo "no hay";
        }

    ?>

<HTML lang="es">


    <HEAD>
        <TITLE>Login</TITLE>
        <link type="image/png" rel="icon" href="img/KartenSpiel_icono.png">
        <link rel="stylesheet" type="text/css" href="css/estilos.css">
        <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
        <style type="text/css">
        ${demo.css}
        </style>
        <script type="text/javascript">
            $(function () {
                
            Highcharts.setOptions({
                colors: ['#4A9C32', '#CD1920']
            });

            // Build the chart
            $('#container').highcharts({

                chart: {
                    backgroundColor: "#77966D",
                    plotBackgroundImage: 'img/url.jpg',
                    plotBorderWidth: 6,
                    plotShadow: false,
                    type: 'pie'
                },
                credits: {
                    enabled: false
                },

                title: {
                    text: 'Partidas',
                    style: {"color": "#FFFFFF"}
                },
                tooltip: {
                    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                },
                plotOptions: {
                    pie: {
                       // allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: true,
                            format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                            style: {
                                color: '#3F7CAC'
                            },
                            connectorColor: '#3F7CAC'
                        }
                    }
                },
                series: [{
                    name: 'Partidas',
                    data: [
                        { name: 'Ganadas', y: <?php $con->ganadas();?>},
                        {
                            name: 'Perdidas',
                            y: <?php $con->perdidas(); ?>,
                           
                        },
                    ]
                }]
            });
        });
        </script>
    </HEAD>


    <BODY background="img/url.jpg">
    
        <HEADER>
            <a href="menu.php"><img src="img/volver.png" width=40 height=40 style="position:absolute;"></a>
        </HEADER>

        <NAV>
        </NAV>

       <!-- <SECTION class="descripcion">-->
        	<h1 align="center">Perfil</h1>
            <center><img class='logros' src='img/linea.png' width='500px' height='25px'></center>
            <div align="center"> 
            <br>
                <table width="50%">
                    <tr>
                        <td width="10%"><h2>Usuario:</h2></td>   
                        <td ><?php echo $_SESSION['usuario']; ?></td>
                    </tr>
                    <tr>
                        <td width="10%"><h2>Correo:</h2></td>  
                        <td ><?php $con->correo(); ?></td>
                    </tr>
                    <tr>
                        <td width="10%"><h2>Partidas ganadas:</h2></td>  
                        <td ><?php $con->ganadas(); ?></td>
                    </tr>
                    <tr>
                        <td width="10%"><h2>Partidas perdidas:</h2></td>  
                        <td ><?php $con->perdidas(); ?></td>
                    </tr>
                </table>
            </div>
        <!--</SECTION>-->
        <script src="https://code.highcharts.com/highcharts.js"></script>
        <br>
        <br>
        <br>
        <div id="container" style="min-width: 310px; height: 400px;width:700px; max-width: 600px; margin: 0 auto;  margin-left: 700px; margin-right: auto; margin-top: 0px"></div>
        
    
    </BODY>

</HTML>