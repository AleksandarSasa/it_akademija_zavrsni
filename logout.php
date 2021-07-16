<?php 
require_once("require.php");
session_start();
Statistics::log("logs/logovanja.log", "{$_SESSION['email']} se uspesno odjavio");
session_unset();
session_destroy();
header("location: index.php"); 
?>