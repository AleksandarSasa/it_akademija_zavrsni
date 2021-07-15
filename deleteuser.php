<?php
$page="pocetna";
include("partials/header.php"); ?>
<main>
    <section class="sidebar">
        <h2>Kategorije</h2>
        <?php $upit="SELECT * FROM kategorije"; 
        $rez=$db->query($upit);
        while($red=mysqli_fetch_object($rez)) {
            echo "<a href='index.php?kategorija=$red->id'>$red->nazivKategorije</a>";
            echo "<br>";
        };
        ?> <br>
         <h2>Profil</h2>
        <?php if(Login::loginCheck()) {
            echo "<a href='profile.php'>Pregled profila</a><br>";
            echo "<a href='korpa.php'>Korpa</a><br>";
            echo "<a href='logout.php'>Odjava</a><br><br>";
            if($_SESSION['status']=="Admin") {
                echo "<h2>Opcije </h2>";
                echo "<a href='adduser.php'>Dodaj korisnika</a><br>";
                echo "<a href='deleteuser.php'>Obrisi korisnika</a><br>";
                echo "<a href='addproduct.php'>Dodaj proizvod</a><br>";
                echo "<a href='deleteproduct.php'>Obrisi proizvod</a><br>";
            }
            if($_SESSION['status']=="urednik") {
                echo "<h2>Opcije </h2>";
                echo "<a href='addproduct.php'>Dodaj proizvod</a><br>";
                echo "<a href='deleteproduct.php'>Obrisi proizvod</a><br>";
            }
        } else echo "<a href='login.php'>Prijavi se</a><br> <a href='register.php'>Registracija</a>"
        
        
        
        ?>
    </section> 
        
    <section class="center">
    <?php if(isset($_SESSION['status']) && $_SESSION['status']=="Admin"): ?>
        <?php 
            $poruka="";
            if(isset($_POST['dugme'])) {
                    if($_POST['idKorisnika']!='0') {
                        $upit="UPDATE korisnici SET aktivan=0 WHERE id=".$_POST['idKorisnika'];
                        $db->query($upit);
                        if($db->error()) {
                            $poruka=Info::error("Greska: {$db->error()} ");
                       } else {
                           if(file_exists("images/avatars/".$_POST['idKorisnika'].".jpg")) 
                           unlink("images/avatars/".$_POST['idKorisnika'].".jpg");
                            $poruka=Info::information("Korisnik izbrisan");
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




</div> <!-- -----end-wrapper----- -->
<?php include("partials/footer.php"); ?>
