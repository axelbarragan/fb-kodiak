<?php
session_start();
foreach($_SESSION as $key =>$valor)
{
echo "variable : $key Valor: $valor <br>";
}

?>