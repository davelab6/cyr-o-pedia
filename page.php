<?php

header("Content-type: text/html; charset=utf-8"); // UTF 8
include('_functions.php');
include('fonts_list.php');
include('vars.php');

//$enc = $_GET['enc'];
//$nombre = $_GET['nombre'];
//$glifo = $signo[$nombre];
//$char = uni($glifo['char']);
//$fonts = array_merge($fuentes2, $fuentes);

foreach ($signo as $glifo) {
	$urlname = $glifo['nombre'];
	$urlname_enc = urlencode( $urlname );
	$urlname_new = str_replace('+','%20', $urlname_enc );
	$enc = $_GET['enc'];
	$url = "glyph.php?nombre=";
	$url .= "$urlname_new";
	$url .= "&enc=";
	$url .= "$enc";

	if ( $glifo['char'] != 'None' ) {
	echo '<a href="'.$url.'" ><span class="char">'.uni($glifo['char']).'</span><span class="nombre">'.$glifo['nombre'].'</span><span class="unicode">'.$glifo['char'].'</span></a>'."\n";
	}
};

?>