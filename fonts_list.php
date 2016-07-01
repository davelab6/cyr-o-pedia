<?
$dir='fonts';
$dir2='fonts/test';
$fuentes=array();
$fuentes2=array();

#lista de fuentes

if ($handle = opendir($dir)) {
    /* This is the correct way to loop over the directory. */
    while (false !== ($entry = readdir($handle))) {
        #solo si son otf o ttf
        if(strpos($entry,".otf") or strpos($entry,".ttf")){
            array_push($fuentes, $entry);
        }

    }
    closedir($handle);
}


if ($handle = opendir($dir2)) {
    /* This is the correct way to loop over the directory. */
    while (false !== ($entry = readdir($handle))) {
        #solo si son otf o ttf
        if(strpos($entry,".otf") or strpos($entry,".ttf")){
            array_push($fuentes2, $entry);
        }

    }
    closedir($handle);
}



foreach($fuentes as $fuente){
	$css.="@font-face {
        font-family: '".substr($fuente, 0, -4)."';
        src: url('fonts/$fuente');
        font-weight: normal;
        font-style: normal;
    }\n";
};
foreach($fuentes2 as $fuente){
    $css.="@font-face {
        font-family: '".substr($fuente, 0, -4)."';
        src: url('fonts/test/$fuente');
        font-weight: normal;
        font-style: normal;
    }\n";
};

foreach ($fonts as $fuente){
    $nombre_fuente=substr($fuente, 0, -4);
    $thumbsBig.='<div class="thumbBig" style="font-family:\''.$nombre_fuente.'\'">'.$char.'<label>'.$nombre_fuente.'</label></div>'."\n";
    $thumbsWord.='<div class="thumbWord" style="font-family:\''.$nombre_fuente.'\', \'UnicodeFallback\'">'.'<span class="dyntext">'.$char.'нобель</span><label>'.$nombre_fuente.'</label></div>'."\n";
}

// echo '<pre>';
// print_r(array_merge($fuentes, $fuentes2));
// echo '</pre>';

?>
