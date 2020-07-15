<?php
session_start();
require("db.php");
if (isset($_GET['id']) and !empty($_GET['id'])) {
    $getid = $_GET['id'];
    $articles = $bdd->prepare("select * from articles where id=?");
    $articles->execute(array($getid));
    $articles = $articles->fetch();
    $artid = $articles['id'];
    $l = $bdd->prepare('SELECT id FROM likes WHERE id_article=?');
    $l->execute(array($artid));
    $l = $l->rowCount();
}
if (isset($_POST['acc'])) {
    echo $id;
    header('location: index.php?id=' . $_SESSION['id']);
}
if (isset($_POST['modif'])) {
    $requser = $bdd->prepare('SELECT * FROM articles WHERE id=?');
    $requser->execute(array($article['id']));
    $art_info = $requser->fetch();
    header('location: modifart.php?id=' . $art_info['id']);
}

if (isset($_GET['sup'])) {
    $requser = $bdd->prepare('DELETE  articles WHERE id=?');
    $requser->execute(array($article['id']));
}
if (isset($_POST['envoyer'])) {
    $idm = $_GET['id'];
    $requser = $bdd->prepare('SELECT * FROM articles where id=?');
    $requser->execute(array($_GET['id']));
    $art_info = $requser->fetch();
    $conte = $_POST['commentaire'];
    $ins = $bdd->prepare('INSERT INTO comment(id_article, id_user,containt) VALUE(?,?,?)');
    $ins->execute(array($art_info['id'], $art_info['id_user'], $conte));
}
if (isset($_POST['answ'])) {
    $conte = $_POST['ans'];
    $ins = $bdd->prepare('INSERT INTO answers(id_com, id_user,cont) VALUE(?,?,?)');
    $ins->execute(array($comment['id'], $SESSION['id'], $conte));
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
    <link href="css/stylesing.css" rel='stylesheet' type='text/css' />
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
    <link rel="stylesheet" href="css/single.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link href="//fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800" rel="stylesheet">
    <script>
        addEventListener("load", function() {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>
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
    <section class="banner-bottom bg-white">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 left-blog-info-enlayouts-agileits text-left mx-auto">
                    <div class="blog-grid-top">
                        <div class="b-grid-top">
                            <div class="blog_info_left_grid">
                                <a href="single.html">
                                    <img src="<?php echo $articles['lien']; ?>" class="col-12 h-50" alt="">
                                </a>
                            </div>
                            <div class="blog-info-middle">
                                <ul>
                                    <?php if (!empty($_SESSION['id'])) {
                                        $getid = intval($_SESSION['id']);
                                        $requser = $bdd->prepare('SELECT * FROM users WHERE id=?');
                                        $requser->execute(array($getid));
                                        $userinfo = $requser->fetch(); ?>
                                        <li>
                                            <a href="#">
                                                <i class="far fa-calendar-alt"></i> <?php echo $articles['date']; ?></a>
                                        </li>
                                        <li class="mx-2">
                                            <a style="z-index: 1;" href="action.php?t=1&id=<?php echo $artid; ?>&id_user=<?php echo $_SESSION['id']; ?>"><i class="fa fa-heart-o like" aria-hidden="true"></i> (<?php echo $l; ?>)</i></a>
                                        </li>
                                        <li>
                                            <a style="z-index: 1;" href="commentaire.php?t=3&id=<?php echo $artid; ?>&id_user=<?php echo $_SESSION['id']; ?>"><i class="fa fa-commenting" aria-hidden="true">Commentaires</i></a>
                                        </li>
                                        <?php if ($userinfo['id'] == $_SESSION['id']) { ?>
                                            <li>
                                                <a style="z-index: 1;" href="modifart.php?edit=<?php echo $artid; ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"> Editer</i></a>
                                            </li>
                                            <li>
                                                <a style="z-index: 1; color: red" href="supprimer.php?id=<?php echo $artid; ?>"><i class="fa fa-times" aria-hidden="true"> Supprimer</i></a>
                                            </li>
                                    <?php }
                                    } ?>

                                </ul>
                            </div>
                        </div>

                        <h3>
                            <a href="single.html"><?php echo $articles['titre']; ?></a>
                        </h3>
                        <p><?php echo $articles['containt']; ?></p>
                    </div>

                    <div class="comment-top">
                        <h4>Commentaires</h4>
                        <?php if (!empty($_SESSION['id'])) { ?>
                            <div class="comment-top">
                                <div class="comment-bottom ">
                                    <form action="#" method="post">
                                        <input style="color: black;" class="form-control bg-black" id="validationDefault03" type="text" name="commentaire" placeholder="Ton commentaire" required="">
                                        <button type="submit" name="envoyer" class="btn btn-primary submit">Envoyer</button>
                                    </form>
                                </div>
                            </div>
                        <?php } ?>
                        <br>
                        <?php
                        //$comments = $bdd->query("select  * from comment where id_article=$articles['id'] order by date desc LIMIT 2");
                        $comments = $bdd->prepare('select  * from comment where id_article=? order by date desc LIMIT 2');
                        $comments->execute(array($articles['id']));
                        foreach ($comments as $comment) :
                            $ui = intval($comment['id_user']);
                            $requser = $bdd->prepare('SELECT * FROM users WHERE id=?');
                            $requser->execute(array($comment['id_user']));
                            $userinfo = $requser->fetch($ui);

                            $requser = $bdd->prepare('SELECT * FROM profilep  WHERE id_user=? ORDER BY id DESC LIMIT 2');
                            $requser->execute(array($comment['id_user']));
                            $userpro = $requser->fetch();
                        ?>
                            <div class="media">
                                <img width="25px" height="25px" src="<?php echo $userpro['lien']; ?>" alt="" class="img-fluid" />
                                <div class="media-body">
                                    <h5 class="mt-0"><?php echo $userinfo['name']; ?> <?php echo $userinfo['lastname']; ?></h5>
                                    <p><?php echo $comment['containt']; ?></p>

                                    <form action="post">
                                        <div class="row">
                                            <div class="col-8"><input type="text" name="ans" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" placeholder="Repondre"></div>
                                            <div class="col-3"><input class="btn btn-info" name="answ" type="submit" value="Envoyer"></div>
                                        </div>
                                    </form>
                                    <?php
                                    //$comments = $bdd->query("select  * from comment where id_article=$articles['id'] order by date desc LIMIT 2");
                                    $reps = $bdd->prepare('select  * from answers where id_com=? order by date desc LIMIT 2');
                                    $reps->execute(array($comment['id']));
                                    foreach ($reps as $rep) :
                                        $ui = intval($rep['id_user']);
                                        $requser = $bdd->prepare('SELECT * FROM users WHERE id=?');
                                        $requser->execute(array($rep['id_user']));
                                        $userinfo = $requser->fetch($ui);

                                        $requser = $bdd->prepare('SELECT * FROM profilep  WHERE id_user=? ORDER BY id DESC LIMIT 2');
                                        $requser->execute(array($rep['id_user']));
                                        $userpro = $requser->fetch();
                                    ?>
                                        <div class="media mt-3">
                                            <a class="d-flex pr-3" href="#">
                                                <img src="<?php echo $userpro['lien']; ?>" alt="" class="img-fluid" />
                                            </a>
                                            <div class="media-body">
                                                <h5 class="mt-0"><?php echo $userinfo['name']; ?> <?php echo $userinfo['lastname']; ?></h5>
                                                <p><?php echo $rep['cont']; ?></p>
                                            </div>
                                        </div>
                                    <?php endforeach ?>
                                </div>
                            <?php endforeach ?>

                            </div>
                            <br>
                            <a href="single.php" class="btn btn-primary read-m">Voir toute les commentaires</a>
                    </div>
                </div>

                <!--//left-->
                <!--right-->
                <!--//right-->
            </div>
        </div>
    </section>

    <?php require("footer.php"); ?>

    <!-- js -->
    <script src="js/jquery-2.2.3.min.js"></script>
    <!-- //js -->
    <!--/ start-smoth-scrolling -->
    <script src="js/move-top.js"></script>
    <script src="js/easing.js"></script>
    <script>
        jQuery(document).ready(function($) {
            $(".scroll").click(function(event) {
                event.preventDefault();
                $('html,body').animate({
                    scrollTop: $(this.hash).offset().top
                }, 900);
            });
        });
    </script>
    <!--// end-smoth-scrolling -->

    <script>
        $(document).ready(function() {
            /*
            						var defaults = {
            				  			containerID: 'toTop', // fading element id
            							containerHoverID: 'toTopHover', // fading element hover id
            							scrollSpeed: 1200,
            							easingType: 'linear' 
            				 		};
            						*/

            $().UItoTop({
                easingType: 'easeOutQuart'
            });

        });
    </script>
    <a href="#home" class="scroll" id="toTop" style="display: block;">
        <span id="toTopHover" style="opacity: 1;"> </span>
    </a>

    <!-- //Custom-JavaScript-File-Links -->
    <script src="js/bootstrap.js"></script>
</body>