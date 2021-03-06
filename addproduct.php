<?php
$page="pocetna";
include("partials/header.php"); ?>
<main>
<?php include("partials/sidebar.php") ?>
        
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
        <p class="mt-2">Naslovna slika:</p>
        <input type="file" name="slika" class="mt-0" required><br>
        <p class="mt-2">Ostale slike:</p>
        <input type="file" name="slike[]" class="mt-0" multiple><br>
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
                                } else echo Info::error("Neuspesno dodavanje naslovne slike");
                           }
                       }
                       for ($i=0; $i<count($_FILES['slike']['name']); $i++) {
                           $slikeIme=microtime(true).".jpg";
                           if(@move_uploaded_file($_FILES['slike']['tmp_name'][$i], "images/".$slikeIme)) {
                                $upit="INSERT INTO slikeproizvoda (proizvodID, imeSlike) VALUES ($id, '{$slikeIme}')";
                                $db->query($upit);
                           }
                       }
                   }
                } else echo Info::error("Svi podaci su obavezni");
            }
        ?>
        <?php else: echo Info::error("Ovoj stranici moze pristupiti samo admin/urednik"); endif; ?>
    </section>
</main>





<?php include("partials/footer.php"); ?>
