<?php
session_start();
require("db.php");
function tronquer($description)
{
  //nombre de caractères à afficher
  $max_caracteres = 100;
  // Test si la longueur du texte dépasse la limite
  if (strlen($description) > $max_caracteres) {
    // Séléction du maximum de caractères
    $description = substr($description, 0, $max_caracteres);
    // Récupération de la position du dernier espace (afin déviter de tronquer un mot)
    $position_espace = strrpos($description, " ");
    $description = substr($description, 0, $position_espace);
    // Ajout des "..."
    $description = $description . "...";
  }
  return $description;
}
?>
<!DOCTYPE html>
<html>

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Bienvénue sur .......</title>
  <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="scss/styleteam.css">
  <link rel="stylesheet" type="text/css" href="scss/swipebox.css">
  <link rel="icon" type="image/png" href="images/icons/ac.ico" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="keywords" content="Graphic Responsive web template, Bootstrap Web Templates, Flat Web Templates, Andriod Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" />
  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/scrolling-nav.css" rel="stylesheet">
  <script type="application/x-javascript">
    addEventListener("load", function() {
      setTimeout(hideURLbar, 0);
    }, false);

    function hideURLbar() {
      window.scrollTo(0, 1);
    }
  </script>
  <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>
  <script src="js/jquery.min.js"></script>
  <script>
    $(document).ready(function() {
      size_li = $("#myList li").size();
      x = 3;
      $('#myList li:lt(' + x + ')').show();
      $('#loadMore').click(function() {
        x = (x + 1 <= size_li) ? x + 1 : size_li;
        $('#myList li:lt(' + x + ')').show();
      });
      $('#showLess').click(function() {
        x = (x - 1 < 0) ? 1 : x - 1;
        $('#myList li').not(':lt(' + x + ')').hide();
      });
    });
  </script>
  <script>
    $("span.menu").click(function() {
      $(".head-nav ul").slideToggle(300, function() {
        // Animation complete.
      });
    });
  </script>
</head>

<body style="background-color: #ddd;" id="">
  <?php
  if (isset($_GET['id']) and $_GET['id'] > 0) {
    $getid = intval($_GET['id']);
    $requser = $bdd->prepare('SELECT * FROM users WHERE id=?');
    $requser->execute(array($getid));
    $userinfo = $requser->fetch();
    $nameus = $userinfo['name'];
    $lnameus = $userinfo['lastname'];

    if (isset($_GET['search'])) {
      $recherche = $_GET['recherche'];
      $bdd = new PDO('mysql:host=localhost;dbname=blog_un', 'root', '');
      $art = $bdd->query("SELECT * FROM articles WHERE title LIKE %$recherche% OR theme LIKE %$recherche%");
      $use = $bdd->query("SELECT * FROM users WHERE name LIKE %$recherche% OR lastname LIKE %$recherche% OR username LIKE %$recherche%");
    }
    if (isset($_POST['profil'])) {
      header('location: profil.php?id=' . $_SESSION['id']);
    }
    if (isset($_POST['fd'])) {
      header('location: profil.php?id=' . $_SESSION['id']);
    }
    if (isset($_POST['decon'])) {
      header('location: article.php?id=' . $_SESSION['id']);
    }
  ?>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
      <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="#page-top">Mon Blog</a>
        <button style="margin-left: 209;" class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" name="recherche" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" name="search" type="submit">Search</button>
          </form>
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <form action="" method="post">
                <input class="btn btn-outline-success my-2 my-sm-0" type="submit" name="profil" class="nav-link js-scroll-trigger" value="Profil" />
              </form>
            </li>
            <li class="nav-item">
              <a class="btn btn-outline-success my-2 my-sm-0" href="#about">About</a>
            </li>
            <li class="nav-item">
              <a class="btn btn-outline-success my-2 my-sm-0" href="#contact">Contact</a>
            </li>
            <li class="nav-item">
              <a class="btn btn-outline-success my-2 my-sm-0" class="nav-link js-scroll-trigger" href="deconnexion.php">Se déconnecter</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  <?php } else {
  ?>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
      <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="#page-top">Mon blog</a>
        <button class="navbar-toggler tog" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" name="recherche" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" name="search" type="submit">Search</button>
          </form>
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="register.php">S'inscrire</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="login.php">Se connecter</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#contact">About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#contact">Contact</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  <?php } ?>
  <header style=" font-size: 14px;
  line-height: 1.8;
  color: #222;
  font-weight: 400;
  font-family: 'Montserrat';
  background-image: url('images/feuille.jpg');
  color: black;
  background-repeat: no-repeat;
  background-size: cover;
  -moz-background-size: cover;
  -webkit-background-size: cover;
  -o-background-size: cover;
  -ms-background-size: cover;
  background-position: center center;
  padding: 115px 0;" class="bg-primary text-white">
    <div class="container text-center">
      <h1></h1>
      <p class="lead"></p>
    </div>
  </header>
  <br>
  <br>
  <div class="row inner-sec w-100%">
    <div class="col-lg-9 left-blog-info-enoch-agileits text-left" style="background-color: #8c939a;">
      <h1 style=" text-align: center;">Articles</h1>
      <hr>
      <?php require("aff.php"); ?>
      <article id="about" class="bg-white col-10 mx-auto p-0 m-5">
        <div class="container">
          <div class="row">
            <div class="col-lg-8 mx-auto">
              <h2>A propos de cette pages</h2>
              <p class="lead text-dark">Cette page repondont aux differents critaires du cahier de charge donnée par le clien, ces differents critaires sont:</p>
              <ul>
                <li>Blog</li>
                <li>Registration</li>
                <li>Login</li>
                <li>Page admin et page simple, dévelopée avec du php native, de l'HTML, du CSS et du JS </li>
              </ul>
            </div>
          </div>
        </div>
      </article>

      <article id="services" class="bg-white col-10 mx-auto p-0 m-5">
        <div class="container">
          <div class="row">
            <div class="col-lg-8 mx-auto">
              <h2>Services</h2>
              <p class="lead text-dark">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aut optio velit inventore, expedita quo laboriosam possimus ea consequatur vitae, doloribus consequuntur ex. Nemo assumenda laborum vel, labore ut velit dignissimos.</p>
            </div>
          </div>
        </div>
      </article>

      <article id="contact" class="bg-white col-10 mx-auto p-0 m-5">
        <div class="container">
          <div class="row">
            <div class="col-lg-8 mx-auto">
              <h2>Contact us</h2>
              <div class="col-md-8 address-right text-left">
                <p><i class="fa fa-envelope" aria-hidden="true"></i>
                  <a href="mailto:idrisstoure180@gmail.com"> idrisstoure180@gmail.com</a>
                </p>
                <p><i class="fa fa-phone-square" aria-hidden="true"></i>
                  <a href="mailto:idrisstoure180@gmail.com">+212 612345678</a>
                </p>
                <p><i class="fa fa-linkedin-square" aria-hidden="true"></i>
                  <a href="mailto:idrisstoure180@gmail.com">++++++++++++++</a>
                </p>
                <p><i class="fa fa-facebook-square" aria-hidden="true"></i>
                  <a href="mailto:idrisstoure180@gmail.com">+++++++++++</a>
                </p>
              </div>
            </div>
          </div>
        </div>
      </article>
    </div>
    <div class="col-3 p-5 pt-0">
      <?php require('right.php'); ?>
    </div>
    <!-- Footer -->
    <?php require("footer.php"); ?>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom JavaScript for this theme -->
    <script src="js/scrolling-nav.js"></script>

</body>

</html>