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
        
        <h2>Statistika</h2>
        <form action="statistics.php" method="post" enctype="multipart/form-data">
        <select name="datoteka" id="datoteka" class="mt-3">
            <option value="0">--Izaberite statistiku--</option>
            <option value="logovanja.log">Logovanje</option>
            <option value="korisnici.log">Korisnici</option>
            <option value="proizvodi.log">Proizvodi</option>
        </select> <br>
        <button class="mt-3" name="dugme">Prikazi statistiku</button>
        </form>
        <?php 
            if(isset($_POST['datoteka']) && $_POST['datoteka']!='0') {
                $datoteka=$_POST['datoteka'];
                if(file_exists("logs/$datoteka")) {
                    $rez=file_get_contents("logs/$datoteka");
                    $rez=nl2br($rez);
                    echo $rez;
                } else echo Info::information("Nema statistike ovog tipa");
            }
        ?>
        <?php else: echo Info::error("Ovoj stranici moze pristupiti samo admin"); endif; ?>
    </section>
</main>





<?php include("partials/footer.php"); ?>
