<?php
require_once("require.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <!-- <script src="js/jquery-3.6.0.min.js"></script> -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
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
    <script src="js/single.js"></script>
    <title>Cvecara Flos</title>
</head>
<?php 
$db=new Database("localhost","root","","cvecara");
$db->connect();
if(!$db->connect()) { echo "<div style='text-align:center'>".Info::error("Neuspjesna konekcija na bazu")."</div>"; exit(); }
?>
<body>
    <!-- -----wrapper----- -->
    <div class="wrapper">
        <header>
            <!-- -----header----- -->
            <section class="topBar">
                <?php $last=$_SERVER['REQUEST_URI']; ?>
                <!-- ----------section-topBar---------- -->
                <article>
                <p>
                 <?php 
                 if(isset($_SESSION['id'])) {
                     if(file_exists("images/avatars/".$_SESSION['id'].".jpg")) { $slika="images/avatars/".$_SESSION['id'].".jpg"; }
                     else $slika="images/avatars/default.jpg";
                 }
                 
                    if(Login::loginCheck()) { echo "<span style='color:#77f'><img src='{$slika}' height='20px' style='margin-top:-2px;'>&nbsp;{$_SESSION['ime']}</span> ({$_SESSION['status']})"; 
                    }
                        else echo "<a href='login.php'><i class='fas fa-user'></i>&nbsp;Prijava</a>&nbsp;";
                 ?>   
                
            
                </p>
                </article>
                <article>
                   <p></p>
                    <!-- <p>&nbsp;<i class="fas fa-shopping-cart"></i>&nbsp<span>0</span> </p> -->
                </article>
            </section>
            <hr> <!-- ----------end-section-topBar---------- -->
            <section class="navigation">
                <!-- ----------section-navigation---------- -->
                <article>
                    <nav class="navbar navbar-expand-lg navbar-light">
                        <div class="container-fluid">
                            <a class="navbar-brand" href="index.php">Cve??ara</a>
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarNav">
                                <ul class="navbar-nav ms-auto">
                                    <li class="nav-item">
                                        <a class="nav-link <?php if($page=='pocetna') echo 'active' ?>" href="index.php">Pocetna</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link <?php if($page=='onama') echo 'active' ?>" href="onama.php">O nama</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link <?php if($page=='kontakt') echo 'active' ?>" href="kontakt.php">Kontakt</a>
                                    </li>
                                   
                                </ul>
                            </div>
                        </div>
                    </nav>
                </article>
            
            </section> <!-- ----------end-section-navigation---------- -->
        </header> <!-- -----end-header----- -->
    