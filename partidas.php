
<?php
session_start();
function ganadas(){
            $con = mysqli_connect("localhost", "root", "", "kartenspiel");
            $consulta = mysqli_query($con, "select partidas_g from usuarios where Usuario='".  $_SESSION['usuario']  ."'");
            if ($row = mysqli_fetch_array($consulta, MYSQLI_ASSOC)){ 
               do { 
                    return "".$row["partidas_g"]."";
                } while ($row = mysqli_fetch_array($consulta, MYSQLI_ASSOC)); 
            } 
            else { 
                echo "¡ No se ha encontrado ningún registro !"; 
            } 
        }

function perdidas(){
    
    $con = mysqli_connect("localhost", "root", "", "kartenspiel"); 
            $consulta = mysqli_query($con, "select partidas_p from usuarios where Usuario='".  $_SESSION['usuario']  ."'");
            if ($row = mysqli_fetch_array($consulta, MYSQLI_ASSOC)){ 
               do { 
                    return $row["partidas_p"]; 
                } while ($row = mysqli_fetch_array($consulta, MYSQLI_ASSOC)); 
            } 
            else { 
                echo "¡ No se ha encontrado ningún registro !"; 
            }
}
$PG=ganadas();
$PP=perdidas();
?>
<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>partidas</title>

        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
        <style type="text/css">
        ${demo.css}
        </style>
        <script type="text/javascript">
    $(function () {
        
    Highcharts.setOptions({
        colors: ['#5FAD41', '#E3170A']
    });

    // Build the chart
    $('#container').highcharts({

        chart: {
            backgroundColor: "#95AFBA",
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
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || '#3F7CAC'
                    },
                    connectorColor: '#3F7CAC'
                }
            }
        },
        series: [{
            name: 'Partidas',
            data: [
                { name: 'Ganadas', y: <?php echo $PG;?>},
                {
                    name: 'Perdidas',
                    y: <?php echo $PP;?>,
                   
                },
            ]
        }]
    });
});
        </script>
    </head>
    <body background="img/url.jpg">
<script src="https://code.highcharts.com/highcharts.js"></script>

<div id="container" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>

    </body>
</html>
