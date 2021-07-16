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
                echo "<a href='statistics.php'>Statistika</a><br>";
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
    <?php if(isset($_SESSION['status']) && ($_SESSION['status']=="Admin" || $_SESSION['status']=="urednik") ): ?>
        <?php 
            $poruka="";
            if(isset($_POST['dugme'])) {
                    if($_POST['idProizvoda']!='0') {
                        $upit="UPDATE proizvodi SET obrisan=1 WHERE id=".$_POST['idProizvoda'];
                        $db->query($upit);
                        if($db->error()) {
                            $poruka=Info::error("Greska: {$db->error()} ");
                            Statistics::log("logs/proizvodi.log", "{$_SESSION['email']} - greska pri izvrsavanju upita: {$db->error()}");
                        }
                    //     else {
                    //        if(file_exists("images/".$_POST['idProizvoda'].".jpg")) 
                    //        unlink("images/".$_POST['idProizvoda'].".jpg");
                    //         $poruka=Info::information("Proizvod obrisan");
                    //         Statistics::log("logs/proizvodi.log", "{$_SESSION['email']} uspesno obrisao proizvod sa id: {$_POST['idProizvoda']}");
                    //     }
                    } else $poruka=Info::information("Izaberite proizvod");
                } 
        ?>
        <h2>Obrisi proizvod</h2>
        <form action="deleteproduct.php" method="post" enctype="multipart/form-data">
        <select name="idProizvoda" id="idProizvoda" class="mt-3">
            <option value="0">--Izaberite proizvod--</option>
            <?php 
                if($_SESSION['status']=="Admin") { $upit="SELECT * FROM proizvodiview WHERE obrisan=0 ORDER BY id DESC"; }
                else {
                    $upit="SELECT * FROM proizvodiview WHERE obrisan=0 AND autorID={$_SESSION['id']} ORDER BY id DESC";
                }
                
                $rez=$db->query($upit);
                if($db->error()) { 
                    echo Info::error("Greska: {$db->error()} ");
                    Statistics::log("logs/proizvodi.log", "{$_SESSION['email']} - greska pri izvrsavanju upita: {$db->error()}");
                }
                else {
                    while($red=$db->fobject($rez)) {
                        echo "<option value='{$red->id}'>{$red->naslov}</option>";
                    }
                }
            ?>
        </select> <br>
        <button class="mt-3" name="dugme">Obrisi proizvod</button>
         <?php echo "<br>".$poruka; ?>
        </form>
        <?php else: echo Info::error("Ovoj stranici moze pristupiti samo admin/urednik"); endif; ?>
    </section>
</main>




</div> <!-- -----end-wrapper----- -->
<?php include("partials/footer.php"); ?>
