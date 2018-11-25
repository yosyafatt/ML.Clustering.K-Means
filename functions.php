<?php 
function getData($file){
    $fh = fopen($file, "r");
    $i = 0;

    while (!feof($fh)) {
        $line[$i] = fgets($fh);
        $i++;
    }
           
    fclose($fh);
    $i = 0;
    $olah = null;
    foreach ($line as $d) {
        $olah[$i] = array_map("intval", explode(",", $d));
        $i++;
    }
    return $olah;
}

function itungJarak($a, $b){
    $jarak = sqrt(pow(abs($a), 2) + pow(abs($b), 2));
    return $jarak;
}
?>