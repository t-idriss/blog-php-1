<?php

$errore = "";
$errorp = "";
$creat = "";
$color = 'red';
$colore = "black";
$color2 = "green";

if (isset($_POST['inscription'])) {
    $n = htmlspecialchars($_POST['name']);
    $e = htmlspecialchars($_POST['email']);
    $p = htmlspecialchars($_POST['password']);
    $cp = htmlspecialchars($_POST['re_password']);
    if ($p == $cp && $p != "" && $cp != "") {
        if ($n == "" && !preg_match("/^[a-zA-Z0-9_]+$/", $n)) {
            $errorname = "Votre pseudo n'est pas valide";
        } else {
            if (isset($_POST['agree-term'])) {
                require("function.php");
            } else {
                $colore = "red";
            }
        }
    } else {
        $errorp = "ERROR Password";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>S'inscrire</title>
    <title>Se connecter</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/scrolling-nav.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="images/icons/favicon.ico" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="css/util.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <!--===============================================================================================-->
    <!-- Font Icon -->
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">
    <link href="css/scrolling-nav.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Main css -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body style=" font-size: 14px;
  line-height: 1.8;
  color: #222;
  font-weight: 400;
  font-family: 'Montserrat';
  background-image: url('images/hero_2.jpg');
  background-repeat: no-repeat;
  background-size: cover;
  -moz-background-size: cover;
  -webkit-background-size: cover;
  -o-background-size: cover;
  -ms-background-size: cover;
  background-position: center center;
  padding: 115px 0;">
    <?php  ?>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
        <div class="container">
            <a class="navbar-brand js-scroll-trigger" href="#page-top">Start Bootstrap</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="index.php">Acceuil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="#">S'inscrire</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="login.php">Se connecter</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="main">

        <section class="signup">
            <!-- <img src="images/signup-bg.jpg" alt=""> -->
            <div class="container">
                <div class="signup-content">
                    <form method="POST" id="signup-form" class="signup-form">
                        <h2 class="form-title">Create account</h2>
                        <h3 style='color: <?php echo $color2; ?>;'><?php echo $creat; ?></h3>
                        <div class="form-group">

                            <input type="text" class="form-input" name="name" id="name" placeholder="Your UserName" required />
                        </div>
                        <div class="form-group">
                            <p style='color: <?php echo $color; ?>;'><?php echo $errore; ?></p>
                            <input type="email" class="form-input" name="email" id="email" placeholder="Your Email" required />
                        </div>
                        <div class="form-group">
                            <p style='color: <?php echo $color; ?>;'><?php echo $errorp; ?></p>
                            <input type="password" class="form-input" name="password" id="password" placeholder="Password" required />
                            <span toggle="#password" class="zmdi zmdi-eye field-icon toggle-password"></span>
                        </div>
                        <div class="form-group">
                            <p style='color: <?php echo $color; ?>;'><?php echo $errorp; ?></p>
                            <input type="password" class="form-input" name="re_password" id="re_password" placeholder="Repeat your password" />
                        </div>
                        <div class="form-group">
                            <input type="checkbox" name="agree-term" id="agree-term" class="agree-term" required />
                            <label for="agree-term" class="label-agree-term" style='color:<?php echo $colore; ?>;'><span><span></span></span>I agree all statements in <a href="#" class="term-service">Terms of service</a></label>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="inscription" id="submit" class="form-submit" value="Sign up" />
                        </div>
                    </form>
                    <p class="loginhere">
                        Have already an account ? <a href="login.php" class="loginhere-link">Login here</a>
                    </p>
                </div>
            </div>
        </section>

    </div>
    <footer>
        <?php require("footer.php"); ?>
    </footer>

    <!-- JS -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="js/main.js"></script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>