<?php
/* EJERCICIO 1 -------------------  
Escribe el código necesario para generar la cadena final usando el arreglo dado
Lado, ledo, lido, lodo, ludo,
decirlo al revés lo dudo.
Ludo, lodo, lido, ledo, lado,
¡Qué trabajo me ha costado!
*/
  $arreglo = [

    'keyStr1' => 'lado',
    0 => 'ledo',
    'keyStr2' => 'lido',
    1 => 'lodo',
    2 => 'ludo'
  ];

  foreach ($arreglo as $key) {
    echo "$key, ";
  }
  echo "</br>";
  echo "decirlo al revés lo dudo.";
  echo "</br>";
  $rev = array_reverse($arreglo);
  foreach ($rev as $key) {
    echo "$key, ";
  }
  echo "</br>";
  echo "¡Qué trabajo me ha costado! </br> </br>";

/* EJERCICIO 2 -------------------
Crea un arreglo que contenga como clave los nombres de 5 países y como valor otro arreglo con 3 ciudades que pertenezcan a ese país,
después utiliza un ciclo foreach,
para imprimir el nombre del país seguido de las ciudades que definiste:
*/

  $paises = [
    'Mexico' => ['CDMX','Queretaro','Guadalajara'],
    'Alemania' => ['Frankfurt', 'Múnich', 'Hamburgo'],
    'Australia' => ['Sídney', 'Melbourne', 'Perth']
  ];

  foreach ($paises as $pais => $ciudades) {
    echo"<strong>$pais:</strong> ";
    foreach ($ciudades as $ciudad) {
      echo "$ciudad  ";
    }
    echo "</br>";
  }

  echo "</br>";
  echo "</br>";

/* EJERCICIO 3 -------------------
Escribe el código necesario para encontrar los 3 números más grandes y los 3 números más bajos de la siguiente lista:
*/

  $valores = [23, 54, 32, 67, 34, 78, 98, 56, 21, 34, 57, 92, 12, 5, 61];

  sort($valores);

  echo "Los 3 numeros mas grandes son: </br>";
  $revNum = array_reverse($valores);
  for ($i=0; $i < 3; $i++) { 
    echo "$revNum[$i] ";
  }
  echo "</br>";
  echo "</br>";
  echo "Los 3 numeros mas chicos son: </br>";

  for ($i=0; $i < 3; $i++) { 
    echo "$valores[$i] ";
  }


?>