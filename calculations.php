<?php

function rankcalc ($jactualizar){

  // Variables para los ratios
  $jganados = 0;
  $jjugados = 0;
  $sganados = 0;
  $sjugados = 0;
  $ratioj = 0;
  $ratios = 0;

  require('dbcon.php');

  // Busca jugador a actualizar (jactualizar) y actualiza sus datos.
  $result = mysql_query("SELECT id, fecha, e1j1, e1j2, e2j1, e2j2, s1e1, s1e2, s2e1, s2e2, s3e1, s3e2 FROM partidos", $link);
  if ($row = mysql_fetch_array($result)){
    do {
      // Compruebo si está en equipo 1
      if ($row["e1j1"]==$jactualizar || $row["e1j2"]==$jactualizar){
        // Cuenta los Juegos ganados y los jugados
        $jganados = $jganados + $row["s1e1"] + $row["s2e1"] + $row["s3e1"];
        $jjugados = $jjugados + $row["s1e1"] + $row["s1e2"] + $row["s2e1"] + $row["s2e2"] + $row["s3e1"] + $row["s3e2"];

        // Cuenta los Sets Jugados
        if( ($row["s3e1"] >=6 || $row["s3e2"] >=6) && ($row["s3e1"] != $row["s3e2"]) ){
          $sjugados = $sjugados + 3;
        } elseif ( ($row["s2e1"] >=6 || $row["s2e2"] >=6) && ($row["s2e1"] != $row["s2e2"])) {
          $sjugados = $sjugados + 2;
        } elseif ( ($row["s1e1"] >=6 || $row["s1e2"] >=6) && ($row["s1e1"] != $row["s1e2"])) {
          $sjugados = $sjugados + 1;
        }

        // Cuenta los Sets Ganados
        if( $row["s3e1"] > $row["s3e2"] && $row["s3e1"] >=6 ){
          $sganados = $sganados + 1;
        }
        if( $row["s2e1"] > $row["s2e2"] && $row["s2e1"] >=6 ){
          $sganados = $sganados + 1;
        }
        if ( $row["s1e1"] > $row["s1e2"] && $row["s1e1"] >=6  ) {
          $sganados = $sganados + 1;
        }


      } //Cierre if
      // Compruebo si está en equipo 2
      elseif ($row["e2j1"]==$jactualizar || $row["e2j2"]==$jactualizar) {
        // Cuenta los Juegos ganados y los jugados
        $jganados = $jganados + $row["s1e2"] + $row["s2e2"] + $row["s3e2"];
        $jjugados = $jjugados + $row["s1e1"] + $row["s1e2"] + $row["s2e1"] + $row["s2e2"] + $row["s3e1"] + $row["s3e2"];

        // Cuenta los Sets Jugados
        if( ($row["s3e1"] >=6 || $row["s3e2"] >=6) && ($row["s3e1"] != $row["s3e2"]) ){
          $sjugados = $sjugados + 3;
        } elseif ( ($row["s2e1"] >=6 || $row["s2e2"] >=6) && ($row["s2e1"] != $row["s2e2"])) {
          $sjugados = $sjugados + 2;
        } elseif ( ($row["s1e1"] >=6 || $row["s1e2"] >=6) && ($row["s1e1"] != $row["s1e2"])) {
          $sjugados = $sjugados + 1;
        }

        // Cuenta los Sets Ganados
        if( $row["s3e1"] < $row["s3e2"] && $row["s3e1"] <=6 ){
          $sganados = $sganados + 1;
        }
        if( $row["s2e1"] < $row["s2e2"] && $row["s2e1"] <=6 ){
          $sganados = $sganados + 1;
        }
        if ( $row["s1e1"] < $row["s1e2"] && $row["s1e1"] <=6  ) {
          $sganados = $sganados + 1;
        }


      } // Cierre elseif

    } while ($row = mysql_fetch_array($result));
  } else {
    echo "No se ha encontrado ning&uacute;n registro !";
  }

  // Si han jugado alguna vez, se calculan sus Ratios
  if ($jjugados != 0){
    $ratioj = ($jganados / $jjugados)*100;
    $ratios = ($sganados / $sjugados)*100;
  }

  // Cierre explícito de la conexión
  mysql_close($link);

  // Abro conexión para hacer el UPDATE
  require('dbcon.php');

  // Hago el UPDATE
  mysql_query("UPDATE ranking SET jganados='$jganados', jjugados='$jjugados', sganados='$sganados', sjugados='$sjugados', ratioj='$ratioj', ratios='$ratios'  WHERE nombre='$jactualizar'", $link);

  // Cierre explícito de la conexión
  mysql_close($link);

  echo "<p><b>Jugador: ".$jactualizar."</b></p> <p>Juegos Ganados:".$jganados." Juegos Jugados:".$jjugados." Ratio de Juegos:".$ratioj." Sets Jugados:".$sjugados." Sets Ganados:".$sganados." Ratio Sets:".$ratios."</p>";

}


?>
