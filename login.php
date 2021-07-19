<?php
require_once("require.php");
if(Login::loginCheck()) header("location: index.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="Keywords" content="Online prodavnica cveca, cvecara, prodaja cveca na veliko, rasadnik, cvecara ">
    <meta name="Description" content="Cvecara ima online uslugu narucivanja cveca u svim kolicinama. Narucite cvece online ili nam pisite na mejl. Posedujemo razlicite vrste od ruza,hrizantema, semena, trava, drveca i ukrasnih grmova">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <!-- Main Font -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;0,800;1,300;1,400;1,600&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="style.css">
    <script src="js/jquery-3.6.0.min.js"></script>
    <title>Cvecara Flos</title>
</head>
<?php 
$db=new Database("localhost","root","","cvecara");
$db->connect();
if(!$db->connect()) { echo "<div style='text-align:center'>".Info::error("Neuspjesna konekcija na bazu")."</div>"; exit(); }
?>
<body>
<!-- -----wrapper----- -->


<div class="login-wrapper">
<div class="login-container">
<h2 class="text-center">PRIJAVA:</h2>
    <form action="login.php" method="post" name="forma" id="forma">
        <label for="email">Email Adresa:</label><br>
        <input type="email" name="email" placeholder="Unesite e-mail" id="email"> <br> 
        <label for="password">Lozinka:</label> <br>
        <input type="password" name="password" placeholder="Unesite lozinku" id="password">
        <input type="button" value="Nazad" onclick="window.location.href='index.php'">
        <!-- <input type="submit"  value="Prijava"> -->
        <button>Prijava</button>
    </form>
    <div id="informacija"></div>


<?php 
    if(isset($_POST["email"]) and isset($_POST["password"])) {
        $email=$_POST["email"];
        $password=$_POST["password"];
        if ($email!="" and $password!="") {
            $upit="SELECT * FROM korisnici WHERE email='$email'";
            $rez=$db->query($upit);
            if(mysqli_num_rows($rez)==1){
                $red=$db->fobject($rez);
                if($red->aktivan==1){
                    if($red->lozinka==$password)
                    {
                        $_SESSION['id']=$red->id;
                        $_SESSION['ime']=$red->ime;
                        $_SESSION['status']=$red->status;
                        $_SESSION['email']=$red->email;
                        Statistics::log("logs/logovanja.log", "$email se uspesno prijavio");
                        header("Location: index.php");
                    } else {
                        Statistics::log("logs/logovanja.log", "$email - [pokusaj logina {$_SERVER['REMOTE_ADDR']}] - pogresna lozinka");
                        echo Info::error("Pogresna lozinka");
                    } 
                } else {
                    Statistics::log("logs/logovanja.log", "$email - [pokusaj logina {$_SERVER['REMOTE_ADDR']}] - korisnik nije aktivan");
                    echo Info::information("Korisnik nije aktivan");
                } 
            } else {
                Statistics::log("logs/logovanja.log", "$email - [pokusaj logina {$_SERVER['REMOTE_ADDR']}] - korisnik ne postoji");
                echo Info::information("Korisnik ne postoji");
            } 
        } else echo Info::error("Svi podaci su obavezni");
    } 
    ?>

    


</div>


<?php include("partials/footer.php"); ?>
