<?php
header("Content-type: text/html; charset=utf-8"); // UTF 8
include('_functions.php');
include('fonts_list.php');
include('vars.inc');
	
$perlname = $glifo['char'];
if ( $perlname[0] == '0' ) { 
	$perlname = substr($perlname,1);
}

foreach ($fonts as $fuente){
	$nombre_fuente=substr($fuente, 0, -4);
	$thumbsBig.='<div class="thumbBig" style="font-family:\''.$nombre_fuente.'\'">'.$char.'<label>'.$nombre_fuente.'</label></div>'."\n";
	$thumbsWord.='<div class="thumbWord" style="font-family:\''.$nombre_fuente.'\', \'UnicodeFallback\'">'.'<span class="dyntext">'.$char.'нобель</span><label>'.$nombre_fuente.'</label></div>'."\n";
}



switch ($enc) {
 	case 'basic':
 		$encname = 'Basic';
 		break;

	case 'adobe':
		$encname = 'Adobe Cyrillic Extended';
		break;

	case 'ext':
		$encname = 'Cyrillic Extended';
		break;

	case 'unicyr':
		$encname = 'Cyrillic <sup>0400-04FF</sup>';
		break;

	case 'sup':
		$encname = 'Supplement <sup>0500–052F</sup>';
		break;

	case 'ext-a':
		$encname = 'Extended-A <sup>2DE0-2DFF</sup>';
		break;

	case 'ext-b':
		$encname = 'Extended-B <sup>A640-A69F</sup>';
		break;

	case 'ext-c':
		$encname = 'Extended-C <sup>1C80-1C88</sup>';
		break;

 	default:
 		$encname = 'Cyrillic <sup>0400-04FF</sup>';
 		break;

} 


#abre diccionario
$fh = fopen('russian-dictionary.txt','r');
$wordlist=fgets($fh);
fclose($fh);

#arma array con palabras
$words = multiexplode(array(","), $wordlist);

#busca signo
$wordlist = array();
foreach($words as $word){
	$pos = strpos($word, $char);
	if ($pos == true) {
		array_push($wordlist, $word);
	}
}

#arma palabras aleatorias hasta 50
for( $i = 0; $i < 100 ; $i++ ) {
	$index=rand(0,(count($wordlist)-1));
	$textoPrueba.=$wordlist[$index].' ';
}

?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="author" content="Deva">
<title>Cyrill-o-pedia <? echo "{$nombre}"." U&plus;"."{$univalue}"." {$desc}";?></title>
<style>
<? echo $css?>
</style>
<link type="text/css" href="css/estilos.css" rel="stylesheet" charset="utf-8">
<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>
<script>

$(function() {
    $( "#slider" ).slider({
      range: "min",
      value: 100,
      min: 48,
      max: 300,
      slide: function( event, ui ) {
        $( "#font_size" ).val( ui.value + " px");
        $('.thumbWord').css('font-size', ui.value + 'px' );
      }
    });
    $( "#font_size" ).val( $( "#slider" ).slider( "value" ) );
  });


$(function() {
    $( "#sliderb" ).slider({
      range: "min",
      value: 50,
      min: 18,
      max: 150,
      slide: function( event, ui ) {
        $( "#font_sizeb" ).val( ui.value + " px");
        $('#contexto').css('font-size', ui.value + 'px' );
      }
    });
    $( "#font_sizeb" ).val( $( "#sliderb" ).slider( "value" ) );
  });

</script>
</head>

<body>

	<div id="left">
		
<?

#######
# pagination
#


// 1. создаем массив из всех страниц
$pages = array(); // array with all 128 glyphs

// signo = object со всеми всеми данными 
// $signo[$nombre] - все данные по 1 глифу
// glifo = все данные по одному глифу только 
// pages = массив только из названий для пагинации

//$id = 0;
foreach ($signo as $glifo){
	$pages[$id] = $glifo['nombre']; // 
	// набиваем массив из объекта только с названиями и ключами
	// $pages[$id] = curpage| glifo['nombre'];
	$chars[$id] = $glifo['char']; // 
	// массив из юникода
	$id++;
}


/*  тестирование массива 
foreach ($pages as $id => $nombre) {
	 echo "nombres[" . $id . "] = " . $nombre . "\n"; }
*/

$total = count($pages); // 128 всего страниц
$total--;

// nombre = название текущей страницы

$curpagenum = array_search($nombre, $pages);  // ключ текущей страницы, i.e. 153


while (key($pages) !== $curpagenum) next($pages); // rewind pages to cur pos
while (key($chars) !== $curpagenum) next($chars); // rewind chars to cur pos

$curuni = current($chars);
$curpage = current($pages);

if (!$curpagenum or !$curpage) { $curpagenum = 0; }
if ( $curpagenum != $total ) { // for all but last
$nextchar = next($chars);
$nextname = next($pages);

$prevchar = prev($chars); // pointer at current
$prevchar = prev($chars); // pointer at prev
$prevname = prev($pages);
$prevname = prev($pages);
}
?>

<span class="pagination">

<? if ( $curpagenum != "0" ): // do not show for 1st glyph

if ( $curpagenum == $total ) { // for last glyph in array
	$prevchar = prev($chars); 
	$prevname = prev($pages); 
}


?>
<a href="glyph.php?nombre=<? echo $prevname.'&enc='.$_GET['enc']; ?>"> <
[ <? echo uni($prevchar) ;?>] </a> | 

<? endif; ?>

<a href="index.php">Index </a>

<? if ( $curpagenum !== $total ): 
?>
| <a href="glyph.php?nombre=<? echo $nextname.'&enc='.$_GET['enc']; ?>">
[<? echo uni($nextchar);?>] > </a>
<br />

<? endif; ?>

</span>
<div class="container">
			
			
<? 
// задать значения снова
//$glifo = $signo[$nombre];
//$char = uni($glifo['char']);

?>

			<h1 class="index"><? echo $char;?></h1>
			<dl>
			<dt>Name</dt>
			<dd><? echo $nombre; ?></dd>
			<dt>Category</dt>
				<dd><? echo $cat;?></dd>
			<dt>Subcategory</dt>
				<dd><? echo $subcat;?></dd>
			<dt>Unicode</dt>
				<dd><? echo $univalue; ?></dd>
			<dt>Production</dt>
				<dd><? echo "uni{$univalue}";?></dd>
	
	<? if ($afii): ?>
			<dt>Afii</dt>
				<dd><? echo $afii; ?></dd>
	<? endif; ?>

			<dt>Html Hex</dt>
				<dd><? echo '&amp;#x'.$univalue.';';?></dd>

			<dt>Html Dec</dt>
				<dd><? echo '&amp;#'.hexdec($univalue).';';?></dd>

			<dt>CSS</dt>
			<dd><? echo '\00'.$univalue;?></dd>

			<dt>C/Python/Java</dt>

			<dd><? echo '\u'.$univalue;?></dd>

			<dt>Perl</dt>
			<dd><? echo '\x{'.$perlname.'}';?></dd>

			<dt>Ruby</dt>
			<dd><? echo '\u{'.$perlname.'}';?></dd>
	
	<? if ($desc): ?>
			<dt>Description</dt>
				<dd><? echo $desc; ?></dd>
	<? endif; ?>

	<? if ($glifo['accents']): ?>
			
			<dt>Accents</dt>
				<dd><? echo $glifo['accents'];?></dd>
		
	<? 
	endif; 
	?>
			</dl>		
		</div>
<div class="glyphlist-sm">
<p style="font-size: 10px;"> Encoding:

<? echo $encname; 
/*
echo '<br>';
echo 'nextchar='.$nextchar.'<br>';
echo 'nextname='.$nextname.'<br>';
echo 'current-uni='.$curuni.'<br>';
echo 'current-page='.$curpage.'<br>';
echo 'prevchar='.$prevchar.'<br>';
echo 'prevname='.$prevname.'<br>';
echo 'curpagenum='.$curpagenum.'<br>';
echo 'curpage='.$curpage.'<br>';
echo 'key($pages)='.key($pages).'<br>';
echo '$pages='.$pages[$key].'<br>';
echo '$total='.$total.'<br>';
*/
?>

</p>

<?

foreach ($signo as $glifo){
	if ( $glifo['char']!='None' && $glifo['char'] != $curuni){
	echo '<a href="glyph.php?nombre='.$glifo['nombre'].'&enc='.$_GET['enc'].'"><span class="char">'.uni($glifo['char']).'</span></a>'."\n";
	} 
	if ($glifo['char']== $curuni) { // active glyph
	echo '<span class="char active">'.uni($glifo['char']).'</span>'."\n";
	}
}
?>
	</div>
	</div>
	<div id="main">
		<div class="container">	
			<div class="thumbs">
				<? echo $thumbsBig ?>
			</div>
			
			<div id="inputtext">
				Change preview: <input id="slide" type="text" value="нон<? echo $char;?>но<? echo $char;?>обол"
				onchange="updateText(this.value);" />
			</div>

			<div id="slider" style="width: 200px; display: inline-block; margin: 0 7px 7px 0;"></div>
			<input type="text" id="font_size" style="border:0; color:#222; font-weight:bold; vertical-align: top">

			<div class="thumbs">
				<? echo $thumbsWord ?>
			</div>

	<p class="cf"></p>
		
			<h1 class="index"><? echo uni($glifo['char'])?></h1>
			
			<h2>Words containing '<? echo $char; ?>'</h2>
			<p><? echo 'Showing 100 of '.count($wordlist).' words found. ('.count($words).' total)'?></p>

			<select id="preview_font" onchange="setfont();">
				<option value="">Default</option>
				<? 
				foreach ($fonts as $fuente) {
					$nombre_fuente=substr($fuente, 0, -4);
					echo '<option value="\''.$nombre_fuente.'\',\'UnicodeFallback\'">'.$nombre_fuente.'</option>';
				}
				?>
			</select>

			<div id="sliderb" style="width: 200px; display: inline-block; margin: 0 7px 0; vertical-align: middle"></div>
			<input type="text" id="font_sizeb" style="border:0; color:#222; font-weight:bold;">

	<p class="cf"></p>

			<div class="contexto" id="contexto">
				<? echo $textoPrueba?>
			</div>

		</div>
	</div>

<script type="text/javascript">
	function setfont() {
		var e = document.getElementById("preview_font");
		var myfont = e.options[e.selectedIndex].value;
		
		var texto_ejemplo = document.querySelector('#contexto');
		texto_ejemplo.setAttribute("style","font-family: " + myfont);
	}
	// Text input for change texts
	function updateText(inputtext) {
		var tipos = document.getElementsByClassName('dyntext'),
		i = tipos.length;

		while(i--) {
			tipos[i].innerHTML =inputtext;
		}
	}
	// Drag boxes
	$(function() {
		$( ".thumbs" ).sortable();
		$( ".thumbs" ).disableSelection();
	});
</script>		
</body>
</html>