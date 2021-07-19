<?php require_once("../require.php");
$db=new Database("localhost","root","","cvecara");
$db->connect();
if(!$db->connect()) { echo "<div style='text-align:center'>".Info::error("Neuspjesna konekcija na bazu")."</div>"; exit(); }
if(!Login::loginCheck()) { echo "Niste prijavljeni"; exit; }
if(isset($_POST['idProizvoda'])) {
    $idProizvoda=$_POST['idProizvoda'];
    $upit="INSERT INTO korpa (korisnikID,proizvodID) VALUES ({$_SESSION['id']}, {$idProizvoda})";
    $db->query($upit);
    if($db->error()) echo $db->error();
    else echo "Proizvod dodan u korpu";
} else echo Info::information("Svi podaci su obavezni");


?>