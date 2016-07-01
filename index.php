<?php
header("Content-type: text/html; charset=utf-8"); // UTF 8
include('_functions.php');
include('fonts_list.php');

$nombre = $_GET['nombre'];
$glifo = $signo[$nombre];
$char = uni($glifo['char']);
$fonts = array_merge($fuentes2, $fuentes);

?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="author" content="Deva">
	<title>[ Cyrill-o-pedia ]</title>
	<link type="text/css" href="css/estilos.css" rel="stylesheet" charset="utf-8">
	<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
	<script src="js/ajax.js"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>
	<script src="js/url.min.js"></script>
	<script>localStorage.clear();</script>
	<script src="js/main.js"></script>
	<script src="js/fontdrag.js"></script>

	<script type="text/javascript">
	function setfont() {
		
		var e = document.getElementById("preview_font2");
		var myfont = e.options[e.selectedIndex].value;
		
		var text_sample = document.querySelector('#glyphlist');
		text_sample.setAttribute("style","font-family: " + myfont);
	    
	}
	</script>
	
</head>

<body class="signos">

	<div class="header">
		<h2>[ cyrill-o-pedia ]</h2>
<section id="top">
	<header><h2>>> Drag fonts here!</h2></header>
	<ul id="fonts"></ul>
</section>

<ul id="navigation">
	<li>Custom:</li>
    <li><a href="index.php#basic">Basic</a></li>
    <li><a href="index.php#adobe">Adobe Extended</a></li>
    <li><a href="index.php#ext">Extended</a></li>
    <br />
    <li>Unicode:</li>
    <li><a href="index.php#unicyr">Cyrillic<sup>0400-04FF</sup></a></li>
    <li><a href="index.php#sup">Supplement<sup>0500-052F</sup></a></li>
    <li><a href="index.php#ext-a">Extended-A<sup>2DE0-2DFF</sup></a></li>
    <li><a href="index.php#ext-b">Extended-B<sup>A640-A69F</sup></a></li>
    <li><a href="index.php#ext-c">Extended-C<sup>1C80-1C8F</sup></a></li>
</ul>
 
	<select id="preview_font2" onchange="setfont();">
		<option value="">Default</option>
	<? 
		foreach ($fonts as $fuente) {
			$nombre_fuente=substr($fuente, 0, -4);
			echo '<option value="' . $nombre_fuente.', AdobeBlank;">'.$nombre_fuente.'</option>';
		}
	?>
	</select>

	<div id="sliderc"></div>
	<input type="text" id="font_size_c" style="border:0; color:#222;" value="80px">

	</div>
	<section id="custom">
	<div id="glyphlist">
	
<?
	//include('page.php');

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

	</div>
	</section>
<p class="cf">&nbsp;</p>
<footer>
<p>All your Cyrillic glyphs in one place. This project is a reference on Extended Cyrillic for designers. DISCLAIMER: The information is provided for practical design purposes. I do not garauntee 100% scientific accuracy. This service is provided «as is». All fonts used are open-source. Fork or contribute to improve.</p>

<p>Cyrill-o-pedia (v0.2) is a localisation fork of <a href="http://devanaguide.huertatipografica.com/">Devanaguide</a> by Andrés Torresi at <a href="http://www.huertatipografica.com/en">Huerta Tipográfica (andres@huertatipografica.com)</a>. Coded by Alexei Vanyashin (a at cyreal.org)
View on Github.</p>

<p>FAQ: Install on your webserver(php required), and put your Cyrillic fonts in the 'fonts' folder. Glyphs lists is uploaded from a text file. Showing only unicode glyphs.</p>
</footer>
<script type="text/javascript">
	function setfont() {
		
		var e = document.getElementById("preview_font2");
		var myfont = e.options[e.selectedIndex].value;
		
		var texto_ejemplo = document.querySelector('#glyphlist');
		texto_ejemplo.setAttribute("style","font-family: " + myfont);
	    
	}
	</script>
</body>
</html>

