<?php
$page="pocetna";
include("partials/header.php"); ?>
<main>
<?php include("partials/sidebar.php") ?> 
        
    <section class="center">
    <?php if(isset($_SESSION['status']) && $_SESSION['status']=="Admin"): ?>
        <?php 
            $poruka="";
            if(isset($_POST['dugme'])) {
                    if($_POST['idKorisnika']!='0') {
                        $upit="UPDATE korisnici SET aktivan=0 WHERE id=".$_POST['idKorisnika'];
                        $db->query($upit);
                        if($db->error()) {
                            Statistics::log("logs/korisnici.log", "{$_SESSION['email']} greska prilikom brisanja korisnika: {$db->error()}");
                            $poruka=Info::error("Greska: {$db->error()} ");
                       } else {
                           if(file_exists("images/avatars/".$_POST['idKorisnika'].".jpg")) 
                           unlink("images/avatars/".$_POST['idKorisnika'].".jpg");
                            $poruka=Info::information("Korisnik izbrisan");
                            Statistics::log("logs/korisnici.log", "{$_SESSION['email']} uspesno obrisao korisnika sa id: {$_POST['idKorisnika']}");
                        }
                    } else $poruka=Info::information("Izaberite korisnika");
                } 
        ?>
        <h2>Obrisi korisnika</h2>
        <form action="deleteuser.php" method="post" enctype="multipart/form-data">
        <select name="idKorisnika" id="idKorisnika" class="mt-3">
            <option value="0">--Izaberite korisnika--</option>
            <?php 
                $upit="SELECT * FROM korisnici WHERE aktivan=1";
                $rez=$db->query($upit);
                if($db->error()) { echo Info::error("Greska: {$db->error()} "); }
                else {
                    while($red=$db->fobject($rez)) {
                        echo "<option value='{$red->id}'>{$red->ime} {$red->prezime}</option>";
                    }
                }
            ?>
        </select> <br>
        <button class="mt-3" name="dugme">Obrisi korisnika</button>
         <?php echo "<br>".$poruka; ?>
        </form>
        <?php else: echo Info::error("Ovoj stranici moze pristupiti samo admin"); endif; ?>
    </section>
</main>




<?php include("partials/footer.php"); ?>
