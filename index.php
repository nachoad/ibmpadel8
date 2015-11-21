<!DOCTYPE html>
<html lang="en">
<head>
  <!-- <meta charset="utf-8"> -->
  <META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="IBM Padel 8 Series ranking">
    <meta name="author" content="Nacho Alonso">
    <link rel="icon" href="./favicon.ico">
    <script src="./Chart.js"></script>

    <title>IBM Padel 8 Series</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://bootswatch.com/slate/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

    <!-- Custom styles for this template -->
    <link href="starter-template.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <!-- <script src="../../assets/js/ie-emulation-modes-warning.js"></script> -->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

  </head>

  <body>

    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Navegación</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">IBM Padel 8 Series</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#">Home</a></li>
            <li><a href="#jugador"><i class="fa fa-user"></i> Datos por jugador</a></li>
            <li><a href="#grafico"><i class="fa fa-bar-chart"></i> Gráfico</a></li>
            <li><a href="#historico"><i class="fa fa-calendar"></i> Datos históricos</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container">

      <div class="starter-template">
        <h1>Torneo IBM Padel 8 Series</h1>
        <p class="lead">Puntuaciones generales individuales e histórico de partidos.</p>
        <p class="text-muted"> Las puntuaciones se reseestablecen cuando cada jugador haya tenido de pareja el resto de jugadores.</p>
        <p class="text-muted"> Los sets con juegos empatados se resuelven dando ganador a ambos equipos.</p>
        <p class="text-muted"> Para el recuento de Sets, sólo se tienen en cuenta los finalizados (no los que se quedaron a medias).</p>
      </div>



      <!-- DATOS POR JUGADOR
      ================================================== -->
      <div class="pull-right"><span><a name="jugador">∙</a></span></div>
      <div class="page-header">
        <h1><i class="fa fa-user"></i> Datos por jugador</h1>
        <p class="text-info"> Clic en el título de la columna para ordenar </p>
      </div>

      <!-- Inicio. Tabla Datos por Jugador -->
      <table id="indextable" class="table table-striped table-hover ">
        <thead>
          <tr>
            <th>#</th>
            <th><a href="javascript:SortTable(1,'T');">Nombre</a></th>
            <th><a href="javascript:SortTable(2,'N');">Juegos Ganados</a></th>
            <th><a href="javascript:SortTable(3,'N');">Juegos Jugados</a></th>
            <th><a href="javascript:SortTable(4,'N');">Sets Ganados</th>
            <th><a href="javascript:SortTable(5,'N');">Sets Jugados</th>
            <th><a href="javascript:SortTable(6,'N');">Ratio (Juegos)</th>
            <th><a href="javascript:SortTable(7,'N');">Ratio (Sets)</th>
          </tr>
        </thead>
        <tbody>
        <!-- Inicio. PHP Code -->
        <?php
                require('dbcon.php');
                $result = mysql_query("SELECT id, nombre, jganados, jjugados, sganados, sjugados, ratioj, ratios FROM ranking", $link);
                if ($row = mysql_fetch_array($result)){
                  do {
                    echo "<tr><td>".$row["id"]."</td><td>".$row["nombre"]."</td><td>".$row["jganados"]."</td><td>".$row["jjugados"]."</td><td>".$row["sganados"]."</td><td>".$row["sjugados"]."</td><td>".$row["ratioj"]." %"."</td><td>".$row["ratios"]." %</td></tr> \n";
                  } while ($row = mysql_fetch_array($result));
                } else {
                  echo "No se ha encontrado ning&uacute;n registro! ";
                }
        ?>
        <!-- Fin. PHP Code -->
        </tbody>
        </table>
        <!-- Fin. Tabla Datos por Jugador -->

        <!-- DATOS POR JUGADOR
        ================================================== -->
        <!-- Inicio. Gráfico -->
        <div class="pull-right"><span><a name="grafico">∙</a></span></div>
        <div class="page-header">
          <h1><i class="fa fa-bar-chart"></i> Gráfico</h1>
          <p class="text-info">Visualización de los ratios por jugador. </p>
        </div>

        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-12"><p class="text-right">(Valores en %)</p>
            <p class="text-right text-info"><span class="label label-info"> </span> - Ratio (Juegos) </p>
            <p class="text-right text-success"><span class="label label-success"> </span> - Ratio (Sets) </p>
          </div>
        </div>
        <div style="width: 100%">
          <canvas id="canvas" height="300" width="700"></canvas>
        </div>
        <!-- Fin. Gráfico -->




        <div class="pull-right"><span><a name="historico">∙</a></span></div>
        <div class="page-header">
          <h1><i class="fa fa-calendar"></i> Histórico</h1>
          <p class="text-info">Datos históricos de los partidos</p>
        </div>


        <!-- Inicio. Tabla Resultados Partidos -->
        <?php
        require('dbcon.php');
        $result = mysql_query("SELECT id, fecha, e1j1, e1j2, e2j1, e2j2, s1e1, s1e2, s2e1, s2e2, s3e1, s3e2 FROM partidos", $link);
        if ($row = mysql_fetch_array($result)){
          echo "<table class=\"table table-striped table-hover \"> \n <thead> \n";
          echo "<tr><th><b>#</b></th><th><b>Fecha</b></th><th><b>Equipo 1</b></th><th><b>Equipo 2</b></th><th><b>Resultado</b></th></tr> \n </thead> \n <tbody> \n";
          do {
            echo "<tr><td>".$row["id"]."</td><td>".$row["fecha"]."</td><td>".$row["e1j1"]."-".$row["e1j2"]."</td><td>".$row["e2j1"]."-".$row["e2j2"]."</td>";
            echo "<td>".$row["s1e1"]."-".$row["s1e2"].", ".$row["s2e1"]."-".$row["s2e2"];
            if ($row["s3e1"] != 0){
              echo ", ".$row["s3e1"]."-".$row["s3e2"]."</td></tr> \n";
            }

          } while ($row = mysql_fetch_array($result));
          echo "</tbody> \n </table> \n";
        } else {
          echo "No se ha encontrado ning&uacute;n registro! ";
        }
        ?>
        <!-- Fin. Tabla Resultados Partidos -->


        <br />
        <br />
        <br />

        <!-- Footer
        ================================================== -->
        <footer>
          <div class="row">
            <div class="well">
              <div class="panel-body">
                <p class="text-muted">Made by <a href="http://twitter.com/nachoad">@nachoad <i class="fa fa-twitter"></i></a>.</p>
                <p class="text-muted">Based on <a href="http://getbootstrap.com" rel="nofollow">Bootstrap</a>. Icons from <a href="http://fortawesome.github.io/Font-Awesome/" rel="nofollow">Font Awesome</a>. Web fonts from <a href="http://www.google.com/webfonts" rel="nofollow">Google</a>. Oct. 2015.</p>
                <p class="text-muted">Code at <a href="https://github.com/nachoad/ibmpadel8"><i class="fa fa-github"></i> Github</a>  (Please, let me know if this code helps you)</p>

              </div>
            </div>
          </footer>

        </div><!-- /.container -->




        <!-- Scripts
        ================================================== -->
        <!-- grafica -->
        <script>
        var barChartData = {
          labels : ["Abel","Alberto","David","Edu","Guille","Iván","Karlos","Kayser","Liher","Marcos","Maria","Nacho","Paloma","Santi"],
          datasets : [
            {
              fillColor : "rgba(91, 192, 222, 0.8)",
              strokeColor : "rgba(91, 192, 220, 0.9)",
              highlightFill: "rgba(33, 150, 185, 0.75)",
              highlightStroke: "rgba(33, 150, 185, 1)",
              data : [50,45.45,54.55,0,46.77,52.76,43.12,44.87,71.74,0,27.27,52.67,61.90,48.15]
            },
            {
              fillColor : "rgba(54,204,54, 0.8)",
              strokeColor : "rgba(54,204,54, 0.9)",
              highlightFill : "rgba(37, 160, 37, 0.75)",
              highlightStroke : "rgba(37, 160, 37, 1)",
              data : [58.33,25,66.67,0,45.45,58.33,33.33,33.33,100,0,0,53.85,71.43,33.33]
            }
          ]
        }
        window.onload = function(){
          var ctx = document.getElementById("canvas").getContext("2d");
          window.myBar = new Chart(ctx).Bar(barChartData, {
            responsive : true,
            animationSteps: 200,
            scaleFontFamily: 'sans-serif',
            scaleFontSize: 12,
            barValueSpacing: 5,
          });
        }
        </script>


        <!-- Script para ordenar tabla -->
        <script type="text/javascript">
        /*
        Willmaster Table Sort
        Version 1.0
        July 3, 2011

        Will Bontrager
        http://www.willmaster.com/
        Copyright 2011 Will Bontrager Software, LLC

        This software is provided "AS IS," without
        any warranty of any kind, without even any
        implied warranty such as merchantability
        or fitness for a particular purpose.
        Will Bontrager Software, LLC grants
        you a royalty free license to use or
        modify this software provided this
        notice appears on all copies.
        */
        //
        // One placed to customize - The id value of the table tag.

        var TableIDvalue = "indextable";

        //
        //////////////////////////////////////
        var TableLastSortedColumn = -1;
        function SortTable() {
          var sortColumn = parseInt(arguments[0]);
          var type = arguments.length > 1 ? arguments[1] : 'T';
          var dateformat = arguments.length > 2 ? arguments[2] : '';
          var table = document.getElementById(TableIDvalue);
          var tbody = table.getElementsByTagName("tbody")[0];
          var rows = tbody.getElementsByTagName("tr");
          var arrayOfRows = new Array();
          type = type.toUpperCase();
          dateformat = dateformat.toLowerCase();
          for(var i=0, len=rows.length; i<len; i++) {
            arrayOfRows[i] = new Object;
            arrayOfRows[i].oldIndex = i;
            var celltext = rows[i].getElementsByTagName("td")[sortColumn].innerHTML.replace(/<[^>]*>/g,"");
            if( type=='D' ) { arrayOfRows[i].value = GetDateSortingKey(dateformat,celltext); }
            else {
              var re = type=="N" ? /[^\.\-\+\d]/g : /[^a-zA-Z0-9]/g;
              arrayOfRows[i].value = celltext.replace(re,"").substr(0,25).toLowerCase();
            }
          }
          if (sortColumn == TableLastSortedColumn) { arrayOfRows.reverse(); }
          else {
            TableLastSortedColumn = sortColumn;
            switch(type) {
              case "N" : arrayOfRows.sort(CompareRowOfNumbers); break;
              case "D" : arrayOfRows.sort(CompareRowOfNumbers); break;
              default  : arrayOfRows.sort(CompareRowOfText);
            }
          }
          var newTableBody = document.createElement("tbody");
          for(var i=0, len=arrayOfRows.length; i<len; i++) {
            newTableBody.appendChild(rows[arrayOfRows[i].oldIndex].cloneNode(true));
          }
          table.replaceChild(newTableBody,tbody);
        } // function SortTable()

        function CompareRowOfText(a,b) {
          var aval = a.value;
          var bval = b.value;
          return( aval == bval ? 0 : (aval > bval ? 1 : -1) );
        } // function CompareRowOfText()

        function CompareRowOfNumbers(a,b) {
          var aval = /\d/.test(a.value) ? parseFloat(a.value) : 0;
          var bval = /\d/.test(b.value) ? parseFloat(b.value) : 0;
          return( aval == bval ? 0 : (aval > bval ? 1 : -1) );
        } // function CompareRowOfNumbers()

        function GetDateSortingKey(format,text) {
          if( format.length < 1 ) { return ""; }
          format = format.toLowerCase();
          text = text.toLowerCase();
          text = text.replace(/^[^a-z0-9]*/,"",text);
          text = text.replace(/[^a-z0-9]*$/,"",text);
          if( text.length < 1 ) { return ""; }
          text = text.replace(/[^a-z0-9]+/g,",",text);
          var date = text.split(",");
          if( date.length < 3 ) { return ""; }
          var d=0, m=0, y=0;
          for( var i=0; i<3; i++ ) {
            var ts = format.substr(i,1);
            if( ts == "d" ) { d = date[i]; }
            else if( ts == "m" ) { m = date[i]; }
            else if( ts == "y" ) { y = date[i]; }
          }
          if( d < 10 ) { d = "0" + d; }
          if( /[a-z]/.test(m) ) {
            m = m.substr(0,3);
            switch(m) {
              case "jan" : m = 1; break;
              case "feb" : m = 2; break;
              case "mar" : m = 3; break;
              case "apr" : m = 4; break;
              case "may" : m = 5; break;
              case "jun" : m = 6; break;
              case "jul" : m = 7; break;
              case "aug" : m = 8; break;
              case "sep" : m = 9; break;
              case "oct" : m = 10; break;
              case "nov" : m = 11; break;
              case "dec" : m = 12; break;
              default    : m = 0;
            }
          }
          if( m < 10 ) { m = "0" + m; }
          y = parseInt(y);
          if( y < 100 ) { y = parseInt(y) + 2000; }
          return "" + String(y) + "" + String(m) + "" + String(d) + "";
        } // function GetDateSortingKey()
        </script>


  <!-- Bootstrap core JavaScript
  ================================================== -->
  <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
  <!-- Placed at the end of the document so the pages load faster -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <!--  <script src="../../dist/js/bootstrap.min.js"></script> -->
  <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
  <!--  <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script> -->
</body>
</html>
