<?php
session_start();
require("db.php");
if (isset($_GET['edit']) and !empty($_GET['edit'])) {
    $edit_id = htmlspecialchars($_GET['edit']);
    $edit_article = $bdd->prepare('SELECT * FROM articles WHERE id=?');
    $edit_article->execute(array($edit_id));

    if ($edit_article->rowCount() == 1) {
        $edit_article = $edit_article->fetch();
        $edit_titre = $edit_article['titre'];
        $edit_theme = $edit_article['theme'];
        $edit_contenu = $edit_article['containt'];
        if (isset($_POST['modifier'])) {
            $titre = htmlspecialchars($_POST['titre']);
            $theme = htmlspecialchars($_POST['theme']);
            $contenu = htmlspecialchars($_POST["contenu"]);
            $requsere = $bdd->prepare("UPDATE articles SET theme=?,titre=?,containt=?, datemod=NOW() WHERE id=$edit_id");
            $requsere->execute(array($theme, $titre, $contenu));
            header('location: profil.php?id=' . $edit_article['id_user']);
        }
    } else {
        die('Erreur');
    }
}
if (isset($_POST['acc'])) {
    echo $id;
    header('location: index.php?id=' . $_SESSION['id']);
}

?>
<!DOCTYPE html>
<html>

<head>
    <title>Poster un article</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/scrolling-nav.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="vendor/jquery/jquery.min.js"></script>
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
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
        <div class="container">
            <a class="navbar-brand js-scroll-trigger" href="#page-top">Mon blog</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">

                    <?php if (empty($_SESSION['id'])) { ?>
                        <li class="nav-item">
                            <a class="btn btn-outline-success my-2 my-sm-0" href="index.php">Acceuil</a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-outline-success my-2 my-sm-0" href="register.php">S'inscrire</a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-outline-success my-2 my-sm-0" href="login.php">Se Connecter</a>
                        </li>
                    <?php } else { ?>
                        <li class="nav-item">
                            <form action="" method="post">
                                <input class="btn btn-outline-success my-2 my-sm-0" type="submit" name="acc" class="nav-link js-scroll-trigger" value="File d'actualités" />
                            </form>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-outline-success my-2 my-sm-0" href="deconnexion.php">Se déconnecter</a>
                        </li>
                    <?php }  ?>
                </ul>
            </div>
        </div>
    </nav>
    <br>
    <br>
    <br>
    <br>
    <div class="container emp-profile" style="background-color: #343a40; color: white;padding: 30px">
        <form method="post">
            <div class="form-group">
                <input type="text" class="form-control" rows="5" name="titre" value="<?php echo $edit_titre; ?>" required>
            </div>
            <br>
            <br>
            <div class="form-group">
                <input type="text" class="form-control" rows="5" name="theme" value="<?php echo $edit_theme; ?>" required>
            </div>
            <br>
            <br>
            <div class="form-group">
                <textarea name="contenu" class="form-control" rows="5" value="" required><?php echo $edit_contenu; ?></textarea>
            </div>
            <br>
            <br>
            <div class="form-group">
                <input type="submit" class="login100-form-btn" name="modifier" value="Modifier l'article" />
            </div>
        </form>
    </div>

    </div>
    <br>
    <br>
    <br>
    <br>
    <footer>
        <?php require("footer.php"); ?>
    </footer>

    <!--===============================================================================================-->
    <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/animsition/js/animsition.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/bootstrap/js/popper.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/select2/select2.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/daterangepicker/moment.min.js"></script>
    <script src="vendor/daterangepicker/daterangepicker.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/countdowntime/countdowntime.js"></script>
    <!--===============================================================================================-->
    <script src="js/main.js"></script>

</body>

</html>
<?php

?>