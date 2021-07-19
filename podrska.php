<?php
$page="pocetna";
include("partials/header.php"); ?>
<main>
<?php include("partials/sidebar.php") ?>
        
    <section class="center">
    <?php if(isset($_SESSION['status']) && ($_SESSION['status']=="Admin" || $_SESSION['status']=="urednik" || $_SESSION['status']=="korisnik") ): ?>
        <h2>Pitanja</h2>
        <?php 
        $upit="SELECT * FROM kontakt WHERE korisnikID={$_SESSION['id']}";
        $rez=$db->query($upit);
        if(mysqli_num_rows($rez)>0) {
            while($red=$db->fobject($rez)) {
                echo "<div>";
                echo "{$red->vremePoruke}";
                echo " pitanje: ".$red->poruka."<br>";
                if($red->odgovor=="") echo " Nije odgovoreno<br><br>";
                else {
                    echo "{$red->vremeOdgovora}";
                    echo " odgovor: ".$red->odgovor."<br><br>";
                }
                echo "</div>";
            }
        } else echo Info::information("Niste postavili pitanje administraciji");
        ?>
    <?php else: echo Info::error("Ovoj stranici moze pristupiti samo registrovan korisnik"); endif; ?>
    </section>
</main>
<?php include("partials/footer.php"); ?>
