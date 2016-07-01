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
	<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>
	<script src="js/url.min.js"></script>
	<script>localStorage.clear();</script>
	<script src="js/main.js"></script>
	<script src="js/fontdrag.js"></script>
</head>

<body class="signos">

	<div class="header">
		<h1>[ cyrill-o-pedia ]</h1>
		<small>Check your fonts for Cyrillic support, or browse existing</small>
<section id="top">
	<header><h4>>> Drag fonts here!</h4></header>
	<ul id="fonts"></ul>
</section>

		<h3>Custom: <a id="basic" href="index.php?enc=basic" class="enc">Basic</a> |
		<a id="adobe" href="index.php?enc=adobe" class="enc">Adobe Extended</a> | <a href="index.php?enc=ext" id="ext" class="enc">Extended</a> 
		<br />
		Unicode: 
		<a id="full" href="index.php?enc=unicyr" class="enc">Cyrillic<sup>0400-04FF</sup> </a> | 
		<a href="index.php?enc=sup" class="enc">Supplement<sup>0500-052F</sup></a> |
		<a href="index.php?enc=ext-a" class="enc">Extended-A<sup>2DE0-2DFF</sup></a> | 
		<a href="index.php?enc=ext-b" class="enc">Extended-B<sup>A640-A69F</sup></a> |
		<a href="index.php?enc=ext-c" class="enc">Extended-C<sup>1C80-1C8F</sup></a> |
		</h3>
		<h3>Localization: <a href="index.php?enc=srb">Serbian</a> | <a href="index.php?enc=bgr">Bulgarian</a></h3>	
		<p>&nbsp;</p>
		

			<select id="preview_font2" onchange="setfont();">
				<option value="">Default</option>
				<? 
				foreach ($fonts as $fuente) {
					$nombre_fuente=substr($fuente, 0, -4);
					echo '<option value="\''.$nombre_fuente.'\', \'UnicodeFallback\';">'.$nombre_fuente.'</option>';
				}
				?>
			</select>

			<div id="sliderc"></div>
			<input type="text" id="font_size_c" style="border:0; color:#222; font-weight:bold;">

		<p>&nbsp;</p>
		<p>&nbsp;</p>

	</div>
	<section id="custom">
	<div id="glyphlist">
		<?	
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

	<div class="header">
		<p style="max-width: 750px;">All your Cyrillic glyphs in one place. This project is a reference on Extended Cyrillic for designers. DISCLAIMER: The information is provided for practical design purposes. I do not garauntee 100% scientific accuracy. This service is provided «as is». All fonts used are open-source. Fork or contribute to improve.
		</p>

		<p>Cyrill-o-pedia (v0.2) is a localisation fork of <a href="http://devanaguide.huertatipografica.com" target="_blank">Devanaguide</a> by <a href="http://www.huertatipografica.com/">Huerta Tipográfica</a> (andres@huertatipografica.com). Coded by Alexei Vanyashin (a at cyreal.org)<br />
		View on <a href="http://github.com/alexeiva/Cyrillic-guide">Github</a>
		</p>
		
		<p>
		FAQ: Install on your webserver(php required), and put your Cyrillic fonts in the 'fonts' folder.
		Glyphs lists is uploaded from a text file. Showing only unicode glyphs/
		</p>
	</div>
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