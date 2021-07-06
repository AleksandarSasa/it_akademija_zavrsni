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
        ?>
    </section>

    <section class="center">
    <?php 
        if(isset($_GET['kategorija'])) $upit="SELECT * FROM proizvodi WHERE kategorijaID=".$_GET["kategorija"];
        else $upit="SELECT * FROM proizvodi";
        $rez=$db->query($upit);
        while($red=mysqli_fetch_object($rez)) {
            echo "<p>$red->naslov, $red->tekst,$red->kategorijaID</p>";
            echo "<br>";
    };
    echo Info::error("sdddddddddddddddddddff-");
    echo Info::information("sdsdsdsdsdsdsdsdsdsdssssssacija");
    echo Info::success("Ovuuusdfgtgg");
    ?>
    
    
    </section>
</main>




</div> <!-- -----end-wrapper----- -->
<?php include("partials/footer.php"); ?>
