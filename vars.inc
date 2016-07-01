<?php 

$nombre = $_GET['nombre'];
$nombre = rawurlencode($nombre);

$glifo = $signo[$nombre];
$char = uni($glifo['char']);
$fonts = array_merge($fuentes2, $fuentes);

$cat = $glifo['categoria'];
$subcat = $glifo['subcategoria'];
$afii1 = $glifo['afii'];
$afii = trim( $afii1, '"');
$univalue = $glifo['char'];
$desc = $glifo['description'];

?>