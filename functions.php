<?php 
function textwrap($string) {
    $wrapped="";
    $allWords = explode(" ", $string);
    for($i=0; $i<=15; $i++) {
        if(count($allWords)<=15) return $string;
        $wrapped=$wrapped." ".$allWords[$i];
        if(strlen($wrapped)>=100) break;
    }
    return $wrapped."...";
 }
?>