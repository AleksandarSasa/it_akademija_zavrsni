<?php 
class Login{
    public static function stringCheck($str) {
        // ovo sam mislio uraditi ovako kroz klasu ali radicu posle sanitizaciju
        // i uradicu provjeru emaila i passworda preko toga
    }
    public static function loginCheck(){
        if(isset($_SESSION['id'])) return true;
        else return false;
    } 
}
?>