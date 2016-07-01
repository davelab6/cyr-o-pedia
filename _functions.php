<?
error_reporting(1);
$enc = $_GET["enc"];

if ( !$enc ) {
  $enc = "basic";
}

if ( $enc === "basic") {
    $fh = fopen('subsets/cyrglyphs-basic.txt','r');
}

if ( $enc === "adobe") {
    $fh = fopen('subsets/cyrglyphs-adobe.txt','r');
}

if ( $enc === "ext") {
    $fh = fopen('subsets/cyrglyphs-ext.txt','r');
}

if ( $enc === "unicyr") {
    $fh = fopen('subsets/cyrglyphs-unicyr.txt','r');
}

if ( $enc === "sup") {
    $fh = fopen('subsets/cyrglyphs-sup.txt','r');
}

if ( $enc === "ext-a") {
    $fh = fopen('subsets/cyrglyphs-ext-a.txt','r');
}

if ( $enc === "ext-b") {
    $fh = fopen('subsets/cyrglyphs-ext-b.txt','r');
}

if ( $enc === "ext-c") {
    $fh = fopen('subsets/cyrglyphs-ext-c.txt','r');
}



$i = 0;
while ($line = fgets($fh)) {
  $values = explode("|", $line);
  $char = $values[0];
  $nombre = $values[1];
  $categoria = $values[2];
  $subcategoria = $values[3];
  $afii = $values[4];
  $afii = trim($afii, 'a');
  $description = $values[5];
  $accents = $values[6];
  $signo[$nombre] = array('char'=>$char,'nombre'=>$nombre,'categoria'=>$categoria,'subcategoria'=>$subcategoria,'afii'=>$afii,'description'=>$description,'accents'=>$accents);
  $i++;
}
fclose($fh);

function uni($value){
	if($value=='None'){
		$output='_';
	} else {
		$unicode='\u'.$value;
		$output=json_decode('"'.$unicode.'"');
	}
	return $output;
}

function multiexplode ($delimiters,$string) {
    $ready = str_replace($delimiters, $delimiters[0], $string);
    $launch = explode($delimiters[0], $ready);
    return  $launch;
}

?>