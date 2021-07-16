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
    <?php if(isset($_SESSION['status']) && $_SESSION['status']=="Admin"): ?>
        <h2>Dodaj korisnika</h2>
        <form action="adduser.php" method="post" enctype="multipart/form-data">
        <input type="text" name="ime" placeholder="Unesite ime"><br>
        <input type="text" name="prezime" placeholder="Unesite prezime"><br>
        <input type="email" name="email" placeholder="Unesite email"><br>
        <input type="password" name="lozinka" placeholder="Unesite lozinku"><br>
        <select name="status" id="status" class="mt-3">
            <option value="0">--Status korisnika--</option>
            <option value="1">Admin</option>
            <option value="2">Urednik</option>
            <option value="3">Korisnik</option>
        </select> <br>
        <p class="mt-2">Avatar:</p>
        <input type="file" name="avatar" id="avatar" class="mt-0"> <br>
        <button class="mt-3" name="dugme">Dodaj korisnika</button>
        </form>
        <?php 
            if(isset($_POST['dugme'])) {
                if($_POST['ime']!="" && $_POST['prezime']!="" && $_POST['lozinka']!="" && $_POST['email']!="" && $_POST['status']!="0") {
                   $ime=$_POST['ime'];
                   $prezime=$_POST['prezime'];
                   $lozinka=$_POST['lozinka'];
                   $email=$_POST['email'];
                   $status=$_POST['status'];
                   $upit="INSERT INTO korisnici (ime, prezime, email, lozinka, status) VALUES ('{$ime}', '{$prezime}', '{$email}', '{$lozinka}', '{$status}')";
                   $db->query($upit);
                   if($db->error()) {
                        Statistics::log("logs/korisnici.log", "{$_SESSION['email']} greska prilikom dodavanja korisnika: ".$db->error());
                        echo Info::error("Greska: {$db->error()} ");
                   } else {
                       $id=$db->insert_id();
                       echo Info::success("Korisnik (ID: $id) dodat u bazu podataka");
                       Statistics::log("logs/korisnici.log", "{$_SESSION['email']} uspesno dodao korisnika $email");
                       if($_FILES['avatar']['name']!="") { //ako je prazno ime znaci nije poslan podatak i nema avatara i tu nista ne radimo
                           $avatarIme="images/avatars/".$id.".jpg";
                           $ekstenzije=array("jpg", "jpeg", "webp", "png");
                           $tmp=$_FILES['avatar']['tmp_name'];
                           if(in_array(pathinfo($avatarIme, PATHINFO_EXTENSION), $ekstenzije)) {
                                if(@move_uploaded_file($tmp, $avatarIme)) {
                                    echo Info::success("Avatar dodan");
                                    Statistics::log("logs/korisnici.log", "{$_SESSION['email']} : uspesan upload avatara za korisnika $email, ime avatara: $id.jpg");
                                } else echo Info::error("Neuspesno dodavanje avatara");
                           }
                       }
                   }
                } else echo Info::error("Svi podaci su obavezni");
            }
        ?>
        <?php else: echo Info::error("Ovoj stranici moze pristupiti samo admin"); endif; ?>
    </section>
</main>




</div> <!-- -----end-wrapper----- -->
<?php include("partials/footer.php"); ?>
