<?php 
class Statistics{
    public static function log($imeDat, $tekstNovi){
        $tekstStari=file_get_contents($imeDat);
        $tekstNovi=date("d.m.Y H:i:s", time())." --- ".$tekstNovi."\n".$tekstStari;
        file_put_contents($imeDat, $tekstNovi);
    }
}
?>