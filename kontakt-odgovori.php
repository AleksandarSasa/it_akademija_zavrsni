<?php
$page="pocetna";
include("partials/header.php"); ?>
<main>
<?php include("partials/sidebar.php") ?> 
        
    <section class="center">
    <?php if(isset($_SESSION['status']) && ($_SESSION['status']=="Admin" || $_SESSION['status']=="urednik") ): ?>
        <?php 
        $poruka="";
        if(isset($_POST['idPitanja']) && isset($_POST['odgovor'])) {
           $idPitanja=$_POST['idPitanja'];
           $odgovor=$_POST['odgovor'];
           if($idPitanja!='0' && $odgovor!="") {
                $upit="UPDATE kontakt SET odgovor='{$odgovor}' WHERE id={$idPitanja}";
                $db->query($upit);
                if($db->error()) {
                    $poruka=Info::error("Greska pri upitu");
                } else {
                    $upit="SELECT * FROM kontakt WHERE id={$idPitanja}";
                    $rez=$db->query($upit);
                    $red=$db->fobject($rez);
                    $message="Odgovor na postavljeno pitanje ({$red->poruka}): {$odgovor}";
                    if(!@mail("{$red->email}", "odgovor na pitanje", $message)) {
                        $poruka=Info::error("neuspjelo slanje maila, odgovor sacuvan u bazi");
                    } else $poruka=Info::success("Mail uspjesno poslan");
                }
           } else $poruka=Info::information("Svi podaci su obavezni");
        }
        ?>
        <h2>Odgovorite na pitanje</h2>
        <form action="kontakt-odgovori.php" method="post">
        <select name="idPitanja" id="idPitanja">
            <option value="0">--Izaberite pitanje--</option>
            <?php 
                $upit="SELECT * FROM kontakt WHERE isnull (odgovor)";
                $rez=$db->query($upit);
                while($red=$db->fobject($rez)) {
                    echo "<option value='{$red->id}'>$red->poruka</option>";
                }
            ?>
        </select><br><br>
        <textarea name="odgovor" id="odgovor" cols="30" rows="10" placeholder="Unesite odgovor"></textarea><br>
        <button>Odgovori</button>
        </form>
        <?php echo $poruka; ?>
    <?php else: echo Info::error("Ovoj stranici moze pristupiti samo admin/urednik"); endif; ?>
    </section>
</main>




<?php include("partials/footer.php"); ?>
