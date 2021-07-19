<?php $page="kontakt"; include("partials/header.php"); ?>
<main>

 <?php include("partials/sidebar.php") ?>

    <section class="center">
    <h2>Kontakt</h2>
    <p>Kontaktirajte administraciju i pitajte sta god vas interesuje:</p>
    <form action="kontakt.php" method="post">
        <?php if(!Login::loginCheck()): ?>
        <input type="text" name="email" placeholder="Unesite email"><br>
        <?php endif; ?>
        <textarea name="poruka" id="poruka" cols="30" class="mt-2" placeholder="Unesite poruku" rows="10"></textarea><br>
        <button>Posalji</button>
    </form>
    <?php 
    if(isset($_POST['email']) && isset($_POST['poruka'])) {
        $email=$_POST['email'];
        $poruka=$_POST['poruka'];
        $poruka=filter_var($poruka, FILTER_SANITIZE_STRING);
        if($email!="" && $poruka!="") {
            if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
                if(strlen($poruka)<100) {
                    $upit="INSERT INTO kontakt (email, poruka) VALUES ('$email', '$poruka')";
                    $db->query($upit);
                    if($db->error()) {
                        echo Info::error("Greska prilikom snimanja poruke");
                    } else echo Info::success("Uspesno ste kontaktirali administraciju");
                } else echo Info::information("Predugacka poruka");
                
            } else echo Info::error("Neispravna email adresa");
            
        } else echo Info::information("Svi podaci su obavezni");
    } else {
        if(isset($_POST['poruka'])) {
            $poruka=$_POST['poruka'];
            $poruka=filter_var($poruka, FILTER_SANITIZE_STRING);
            $email=$_SESSION['email'];
            if($poruka!="") {
                if(strlen($poruka)<100) {
                    $upit="INSERT INTO kontakt (korisnikID, email, poruka) VALUES ({$_SESSION['id']}, '$email', '$poruka')";
                    $db->query($upit);
                    if($db->error()) {
                        echo Info::error("Greska prilikom snimanja poruke");
                    } else echo Info::success("Uspesno ste kontaktirali administraciju");
                } else echo Info::information("Predugacka poruka, pozovite mobilnim telefonom");
                
            } else echo Info::information("Upisite poruku");
        }
    } 
    ?>
    
    </section>
</main>
<?php include("partials/footer.php"); ?>
