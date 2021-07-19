<section class="sidebar">
        <h2>Kategorije</h2>
        <?php $upit="SELECT * FROM kategorije"; 
        $rez=$db->query($upit);
        while($red=mysqli_fetch_object($rez)) {
            echo "<a href='index.php?kategorija=$red->id'>$red->nazivKategorije</a>";
            echo "<br>";
        };
        ?> <br>
        
        <?php if(Login::loginCheck()) {
            if($_SESSION['status']=="Admin") {
                echo "<h2>Opcije </h2>";
                echo "<a href='adduser.php'>Dodaj korisnika</a><br>";
                echo "<a href='deleteuser.php'>Obrisi korisnika</a><br>";
                echo "<hr style='display:block;height:2px;width:80%; border-top:2px solid #000'>";
                echo "<a href='addproduct.php'>Dodaj proizvod</a><br>";
                echo "<a href='deleteproduct.php'>Obrisi proizvod</a><br>";
                echo "<hr style='display:block;height:2px;width:80%; border-top:2px solid #000'>";
                echo "<a href='kontakt-odgovori.php'>Pitanja korisnika</a><br>";
                echo "<a href='odobravanje-komentara.php'>Komentari</a><br>";
                echo "<hr style='display:block;height:2px;width:80%; border-top:2px solid #000'>";
                echo "<a href='statistics.php'>Statistika</a><br>";
            }
            if($_SESSION['status']=="urednik") {
                echo "<h2>Opcije </h2>";
                echo "<a href='addproduct.php'>Dodaj proizvod</a><br>";
                echo "<a href='deleteproduct.php'>Obrisi proizvod</a><br>";
            }
            echo "<br>";
            echo "<h2>Profil</h2>";
            echo "<script src='js/korpabroj.js'></script>";
            echo "<a href='korpa.php'>Korpa</a><br>";
            // (<span id='korpabroj'>0</span>)   ovo ide gore pored korpe
            // echo "<a href='korpa.php'>Korpa</a><br>";
            echo "<a href='podrska.php'>Podrska</a><br>";
            echo "<a href='logout.php'>Odjava</a><br><br>";
        } else echo "<h2>Profil</h2><a href='login.php'>Prijavi se</a><br> <a href='register.php'>Registracija</a>"
        
        
        
        ?>
        
    </section>