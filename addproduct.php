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
        <h2>Dodaj proizvod</h2>
        <form action="addproduct.php" method="post" enctype="multipart/form-data">
        <input type="text" name="naslov" placeholder="Naslov proizvoda"><br><br>
        <textarea name="tekst" id="tekst" cols="30" rows="10" placeholder="Unesite tekst proizvoda"></textarea><br>
        <select name="kategorija" id="kategorija" class="mt-3">
            <option value="0">--Kategorija proizvoda--</option>
            <?php $upit="SELECT * FROM kategorije";
            $rez=$db->query($upit);
            while($red=$db->fobject($rez)) {
                echo "<option value='{$red->id}'>".$red->nazivKategorije."</option>";
            }
            ?>
        </select> <br>
        <input type="text" name="cena" placeholder="Cena proizvoda"><br> 
        <p class="mt-2">Slika:</p>
        <input type="file" name="slika" class="mt-0"><br>
        <button class="mt-3" name="dugme">Dodaj proizvod</button>
        </form>
        <?php 
            if(isset($_POST['dugme'])) {
                if($_POST['naslov']!="" && $_POST['tekst']!="" && $_POST['kategorija']!="0" && $_POST['cena']!="") {
                   $naslov=$_POST['naslov'];
                   $tekst=$_POST['tekst'];
                   $kategorija=$_POST['kategorija'];
                   $cena=$_POST['cena'];
                   $upit="INSERT INTO proizvodi (naslov, tekst, autorID, kategorijaID, cena) VALUES ('$naslov', '$tekst', {$_SESSION['id']}, $kategorija, $cena)";
                   $db->query($upit);
                   if($db->error()) {
                        Statistics::log("logs/proizvodi.log", "{$_SESSION['email']} greska prilikom dodavanja proizvoda: ".$db->error());
                        echo Info::error("Greska: {$db->error()} ");
                   } else {
                       $id=$db->insert_id();
                       echo Info::success("Proizvod (ID: $id) dodat u bazu podataka");
                       Statistics::log("logs/proizvodi.log", "{$_SESSION['email']} uspesno dodao proizvod '$naslov'");
                       if($_FILES['slika']['name']!="") { //ako je prazno ime znaci nije poslan podatak i nema avatara i tu nista ne radimo
                           $slikaIme="images/".$id.".jpg";
                           $ekstenzije=array("jpg", "jpeg", "webp", "png");
                           $tmp=$_FILES['slika']['tmp_name'];
                           if(in_array(pathinfo($slikaIme, PATHINFO_EXTENSION), $ekstenzije)) {
                                if(@move_uploaded_file($tmp, $slikaIme)) {
                                    echo Info::success("Slika dodana");
                                    Statistics::log("logs/proizvodi.log", "{$_SESSION['email']} : uspesan upload slike za proizvod id: $id, ime slike: $id.jpg");
                                } else echo Info::error("Neuspesno dodavanje avatara");
                           }
                       }
                   }
                } else echo Info::error("Svi podaci su obavezni");
            }
        ?>
        <?php else: echo Info::error("Ovoj stranici moze pristupiti samo admin/urednik"); endif; ?>
    </section>
</main>




</div> <!-- -----end-wrapper----- -->
<?php include("partials/footer.php"); ?>
