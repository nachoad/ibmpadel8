<?php
include 'calculations.php';


// Conexión con MySQL
require('dbcon.php');

// Select de la tabla de partidos
$result = mysql_query("SELECT id, fecha, e1j1, e1j2, e2j1, e2j2, s1e1, s1e2, s2e1, s2e2, s3e1, s3e2 FROM partidos", $link);

// Muestra una tabla con los partidos
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

// Cierre explícito de la conexión
mysql_close($link);

// Cálculo de Juego, Sets y Ratios
$jugadores = array("Abel","Alberto","David","Edu","Guille","Iván","Karlos","Kayser","Liher","Marcos","María","Nacho","Paloma","Santi");

foreach ($jugadores as $jactualizar) {
  rankcalc ($jactualizar);
}


?>
