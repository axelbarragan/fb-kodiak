<?php

$link = mysqli_connect("localhost", "root", "", "reservacion");
$tildes = $link->query("SET NAMES 'utf8'"); //Para que se muestren las tildes
$query = "SELECT nombreCliente,titulo_habitacion FROM reservaciones, habitaciones WHERE reservaciones.id_hab = habitaciones.id_hab";
$result = mysqli_query($link, $query);
$extraido= mysqli_fetch_array($result);
echo "- Nombre: ".$extraido['id_reservacion']."<br/>";
echo "- Apellidos: ".$extraido['apellidos']."<br/>";
echo "- Dirección: ".$extraido['direccion']."<br/>";
echo "- Teléfono: ".$extraido['telefono']."<br/>";
echo "- Edad: ".$extraido['edad']."<br/>";
mysqli_free_result($result);
mysqli_close($link);

?>