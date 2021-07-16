<?php $page="pocetna"; include("partials/header.php"); ?>
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
    <?php 
        if(isset($_GET['kategorija'])) $upit="SELECT * FROM proizvodiview WHERE obrisan=0 AND kategorijaID=".$_GET["kategorija"]." ORDER BY id DESC";
        else $upit="SELECT * FROM proizvodiview WHERE obrisan=0 ORDER BY id DESC";
        $rez=$db->query($upit);
        while($red=mysqli_fetch_object($rez)) {
            if(file_exists("images/".$red->id.".jpg")) $slika="images/".$red->id.".jpg";
            else $slika="images/default.png";
            echo "<img src='{$slika}' height='200px' width='200px'>";
            echo "<p><a href='single.php?id=".$red->id."'>$red->naslov</a>,<br> $red->tekst $red->cena$</p>";
            if(file_exists("images/avatars/".$red->autorID.".jpg")) $slika="images/avatars/".$red->autorID.".jpg";
            else $slika="images/avatars/default.jpg";
            echo "<img src='{$slika}' height='25px'>{$red->ime}";
            
            echo "<br><br><br>";
    };
    ?>
    
    
    </section>
</main>




<?php include("partials/footer.php"); ?>
