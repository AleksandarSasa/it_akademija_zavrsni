<?php
$page="pocetna";
include("partials/header.php"); ?>
<main>
<?php include("partials/sidebar.php") ?> 
        
    <section class="center">
    <?php if(isset($_SESSION['status']) && $_SESSION['status']=="Admin"): ?>
       <h2>Neodobreni komentari</h2>
       <?php 
        if(isset($_GET['idKomentara']) && isset($_GET['akcija'])) {
            $idKomentara=$_GET['idKomentara'];
            $akcija=$_GET['akcija'];
            if(filter_var($idKomentara, FILTER_VALIDATE_INT)) {
                if($akcija=="brisanje"){
                $upit="DELETE FROM komentari WHERE id={$idKomentara}";
                } elseif ($akcija=="dozvola") { $upit="UPDATE komentari SET odobren=1 WHERE id={$idKomentara}"; 
                    } else echo Info::error("Neispravna akcija")."<br>";
            $db->query($upit);
            } else echo Info::error("Neispravan ID komentara")."<br>";
            
        }

       $upit="SELECT *  FROM komentari WHERE odobren=0";
       $rez=$db->query($upit);
       if(mysqli_num_rows($rez)>0){
            while($red=$db->fobject($rez)) {
                echo "{$red->ime}, {$red->vremeDodavanja}<br>{$red->komentar}<br>";
                echo "<a href='odobravanje-komentara.php?idKomentara={$red->id}&akcija=brisanje'>Obrisi |</a>";
                echo "<a href='odobravanje-komentara.php?idKomentara={$red->id}&akcija=dozvola'> Dozvoli</a>";
                echo "<br><br>";
            }
       } else echo Info::information("Nema neodobrenih komentara");
       ?>
    <?php else: echo Info::error("Ovoj stranici moze pristupiti samo admin"); endif; ?>
    </section>
</main>





<?php include("partials/footer.php"); ?>
