
<?php
$page="pocetna";
include("partials/header.php"); ?>
<main>
<?php include("partials/sidebar.php") ?>

    <section class="center">
    <?php 
        $id=$_GET['id'];
        if(isset($_GET['id']) and filter_var($_GET['id'], FILTER_VALIDATE_INT)) $upit="SELECT * FROM proizvodiview WHERE id=".$_GET["id"];
        else { echo Info::error("Neodgovarajuci ID proizvoda"); exit(); }
        $rez=$db->query($upit);
        while($red=$db->fobject($rez)) {
            if(file_exists("images/".$red->id.".jpg")) $slika="images/".$red->id.".jpg";
            else $slika="images/default.png";
            echo "<img src='{$slika}' height='350px'>";

            echo "<div>";
            $upit="SELECT * FROM slikeproizvoda WHERE proizvodID=".$red->id;
            $rez2=$db->query($upit);
            while($red2=$db->fobject($rez2)) {
                echo "<div style='display:inline-block'><img src='images/{$red2->imeSlike}' height='100px'></div>";
            }
            echo "</div>";

            echo "<br><h3>$red->naslov </h3> $red->tekst <br>";
            echo "{$red->cena}&euro; ";
            if(Login::loginCheck()) echo "<button type='button' class='mt-2 mb-2' onclick='kupi({$red->id})'>Kupi </button>";
            else echo Info::information("Morate biti prijavljeni da bi kupili proizvod");
            echo "<br>";
            if(file_exists("images/avatars/".$red->autorID.".jpg")) $slika="images/avatars/".$red->autorID.".jpg";
            else $slika="images/avatars/default.jpg";
            echo "Autor: <img src='{$slika}' height='25px'> {$red->ime} ";
            echo "<br>";
            
            
    };
    ?>
    <br><br>
    <h2>Postavi komentar</h2>
    <?php if(Login::loginCheck()): ?>
    <input type="checkbox" class="checked" id="toggle" onclick="prikaziFormu()"> <h4 style='display:inline-block'>Cekirajte ako zelite postaviti komentar</h4> <br>
    <form action="single.php?id=<?php echo $id; ?>" method="post" id="forma" onsubmit="return proveriFormu()" style="display:none">
    <!-- <input class="mb-2" type="text" name="ime" placeholder="Unesite vase ime"><br> -->
    <textarea class="p-1" name="komentar" id="komentar" cols="30" rows="10" placeholder="Unesite komentar"></textarea><br>
    <button>Postavi komentar</button><br>
    <?php echo Info::information("<span id='informacija'></span>"); ?> <br>
    </form>
    
    <?php else: echo Info::information("Morate biti ulogovani da bi ostavili komentar"); endif; ?>
    <?php 
    echo "<h2>Komentari</h2>";
    if(isset($_GET['id']) && isset($_POST['komentar'])) {
        $id=$_GET['id'];
        $ime=$_SESSION['ime'];
        $komentar=$_POST['komentar'];
        $komentar=filter_var($komentar, FILTER_SANITIZE_STRING);
        if($id!="" && $ime!="" && $komentar!="") {
            $upit="INSERT INTO komentari (proizvodID, ime, komentar) VALUES ({$id}, '{$ime}', '{$komentar}')";
            $db->query($upit);
            if($db->error()) echo Info::error("Komentar nije snimljen u bazu:<br>".$db->error());
            else{ 
                echo Info::success("Komentar snimljen");
            }
        } else echo Info::information("Svi podaci su obavezni");
    }
    ?>
    <?php 
    $upit="SELECT * FROM komentari WHERE proizvodID={$id} AND odobren=1 ORDER BY vremeDodavanja DESC";
    $rez=$db->query($upit);
    if(mysqli_num_rows($rez)==0) echo Info::information("Nema komentara");
    else echo Info::information("Ukupno komentara: ".mysqli_num_rows($rez));
    while($red=$db->fobject($rez)) {
        echo "<div>";
        echo "<p><b>".$red->ime."</b> -- ".$red->vremeDodavanja."</p>";
        echo "<p>Komentar: ".$red->komentar."</p><br>";
        echo "</div>";
    }
    ?>
    
    </section>
</main>




<script src="js/single.js"></script>
<?php include("partials/footer.php"); ?>
