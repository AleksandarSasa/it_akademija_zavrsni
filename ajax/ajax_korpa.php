<?php require_once("../require.php");
$db=new Database("localhost","root","","cvecara");
$db->connect();
if(!$db->connect()) { echo "<div style='text-align:center'>".Info::error("Neuspjesna konekcija na bazu")."</div>"; exit(); }
if(!Login::loginCheck()) { echo "Niste prijavljeni"; exit; }

$funkcija=$_GET['funkcija'];
if($funkcija=="napraviKorpu") {
    $upit="SELECT * FROM korpaview WHERE korisnikID={$_SESSION['id']} AND kupljen=0";
    $rez=$db->query($upit);
    if(mysqli_num_rows($rez)==0) echo Info::information("Nemate proizvoda u korpi");
    else {
        while($red=$db->fobject($rez)) {
        echo "{$red->naslov}({$red->cena}&euro;)<br>";

        echo "<button type='button' onclick='kupi({$red->id})'>Kupi</button>";
        echo "<button type='button' onclick='obrisi({$red->id})'>Obrisi</button>";
        echo "<br>";
    }
    echo "<br><button type='button' onclick='kupiSve()'>Kupi sve</button>";
    }
    
}

if($funkcija=="napraviKupljene") {
    $upit="SELECT * FROM korpaview WHERE korisnikID={$_SESSION['id']} AND kupljen=1";
    $rez=$db->query($upit);
    if(mysqli_num_rows($rez)==0) echo Info::information("Nema istorije kupovine");
    else {
        while($red=$db->fobject($rez)) {
            echo "{$red->naslov}({$red->cena}&euro;)<br>";
    }
    }
    
}

if($funkcija=="kupi"){
    $id=$_GET['id'];
    $upit="UPDATE korpa SET kupljen=1 WHERE id={$id}";
    $db->query($upit);
    if($db->error()) echo $db->error();
    else echo "Kupljen proizvod";
}

if($funkcija=="obrisi"){
    $id=$_GET['id'];
    $upit="DELETE FROM korpa WHERE id={$id}";
    $db->query($upit);
    if($db->error()) echo $db->error();
    else echo "Obrisan proizvod";
}

if($funkcija=="kupiSve"){
    $upit="UPDATE korpa SET kupljen=1 WHERE korisnikID={$_SESSION['id']}";
    $db->query($upit);
    if($db->error()) echo $db->error();
    else echo "Kupljen proizvod";
}

if($funkcija=="korpabroj"){
    $upit="SELECT * FROM korpa WHERE id={$_SESSION['id']} AND kupljen=0";
    $rez=$db->query($upit);
    echo mysqli_num_rows($rez);
}