<?php 
class Info{
    public static function error($str) {
        if (strlen($str)<30) {
            while (strlen($str)<30){
                $str=$str." - ";
                $str=" - ".$str;
            }
            return "<div class='classInfo classInfoError'>".$str."</div>";
        } 
        else return "<div class='classInfo classInfoError'>".$str."</div>";
    }
    public static function information($str) {
        if (strlen($str)<30) {
            while (strlen($str)<30){
                $str=$str." - ";
                $str=" - ".$str;
            }
            return "<div class='classInfo classInfoInformation'>".$str."</div>";
        } 
        else return "<div class='classInfo classInfoInformation'>".$str."</div>";
    }
    public static function success($str) {
        if (strlen($str)<30) {
            while (strlen($str)<30){
                $str=$str." - ";
                $str=" - ".$str;
            }
            return "<div class='classInfo classInfoSuccess'>".$str."</div>";
        } 
        else return "<div class='classInfo classInfoSuccess'>".$str."</div>";
    }
}
?>