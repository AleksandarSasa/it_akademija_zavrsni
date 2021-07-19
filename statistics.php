<?php
$page="pocetna";
include("partials/header.php"); ?>
<main>
    <section class="sidebar">
         <?php include("partials/sidebar.php") ?>
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
