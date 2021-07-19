<?php $page="pocetna"; include("partials/header.php"); ?>
<main>

 <?php include("partials/sidebar.php") ?>

    <section class="center">
    <?php 
        if(isset($_GET['kategorija']) and filter_var($_GET['kategorija'], FILTER_VALIDATE_INT)) $upit="SELECT * FROM proizvodiview WHERE obrisan=0 AND kategorijaID=".$_GET["kategorija"]." ORDER BY id DESC";
        else $upit="SELECT * FROM proizvodiview WHERE obrisan=0 ORDER BY id DESC";
        $rez=$db->query($upit);
        echo "<div class='product-container'>";
        while($red=mysqli_fetch_object($rez)) {
            if(file_exists("images/".$red->id.".jpg")) $slika="images/".$red->id.".jpg";
            else $slika="images/default.png";
            echo "<div class='product'>";
            echo "<img src='{$slika}' height='250px' width='250px'>";
            echo "<p class='product-naslov'><a href='single.php?id=".$red->id."'>".strtoupper($red->naslov)."</a></p>";
            echo "<p class='product-tekst'>".textwrap("{$red->tekst}")."</p>";
            echo "<div class='cenaikorpa'>";
            echo "<p class='product-cena'>Cena: {$red->cena}&euro;</p>";
            echo "</div>";
            echo "<div class='komentariautor'>";
            $upit="SELECT * FROM komentari WHERE proizvodID={$red->id} AND odobren=1";
            $rez2=$db->query($upit);
            
            echo "<div><i class='fas fa-comment'></i> ".mysqli_num_rows($rez2)."</div>"; 
            if(file_exists("images/avatars/".$red->autorID.".jpg")) $slika="images/avatars/".$red->autorID.".jpg";
            else $slika="images/avatars/default.jpg";
            echo "<div><img src='{$slika}' height='20px'>{$red->ime} </div>";
            echo "</div>";
            echo "</div>";
    };
        echo "</div>";
    ?>
    
    
    </section>
</main>
<?php include("partials/footer.php"); ?>
