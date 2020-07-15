<?php
session_start();
require("db.php");
$id = $_SESSION['id'];
if (isset($_POST['Ad'])) {
   $titre = htmlspecialchars($_POST['titre']);
   $theme = htmlspecialchars($_POST['theme']);
   $contenu = htmlspecialchars($_POST["contenu"]);
   $maxsize = 50000;
   $validext = array(".jpg", ".jpeg", ".JPG", ".JPEG");
   if ($_FILES["img"]["error"] > 0) {

      echo 'Une erreur est survenue lors du chargement';
      die;
   }
   $filesize = $_FILES['img']['size'];
   if ($filesize > $maxsize) {
      $er = 'La taille de ce fichier est trop grand!!';
   }

   $filename = $_FILES['img']['name'];
   $fileext = "." . strtolower(substr(strrchr($filename, "."), 1));

   if (!in_array($fileext, $validext)) {
      $er = "Ce fichier n'est pas un document image";
   }
   $tmpname = $_FILES['img']['tmp_name'];
   $uname = md5(uniqid(rand(), true));
   $filename = "images/art/" . $uname . $fileext;
   if (move_uploaded_file($tmpname, $filename)) {
      $requser = $bdd->prepare('INSERT INTO articles(theme,titre,containt,id_user,lien) VALUES (?,?,?,?,?)');
      $requser->execute(array($theme, $titre, $contenu, $id, $filename));
      //header('location: profil.php?id=' . $_SESSION['id']);
      // echo "<script>alert('Article creer')</script>";
   }
}

if (isset($_GET['id']) and $_GET['id'] > 0) {
   $getid = intval($_GET['id']);
   $requser = $bdd->prepare('SELECT * FROM users WHERE id=?');
   $requser->execute(array($getid));
   $userinfo = $requser->fetch();
   $requser = $bdd->prepare('SELECT * FROM profilep  WHERE id_user=? ORDER BY id DESC LIMIT 1');
   $requser->execute(array($getid));
   $userpro = $requser->fetch();
   $pro= $userpro['lien'];
   if($pro==""){
      $pro= "images/p1.png";
   }
   $id = $_SESSION['id'];
   if ($userinfo['id'] == $_SESSION['id']) {
   }
   if (isset($_POST['btnAddMore'])) {
      header('location: modifier.php?id=' . $_SESSION['id']);
   }
   if (isset($_POST['decon'])) {
      header('location: article.php?id=' . $_SESSION['id']);
   }
   if (isset($_POST['acc'])) {
      echo $id;
      header('location: index.php?id=' . $id);
   }
   if (isset($_POST['modif'])) {
      $requser = $bdd->prepare('SELECT *  articles WHERE id=?');
      $requser->execute(array($article['id']));
      $art_info = $requser->fetch();
      header('location: modifart.php?id=' . $art_info['id']);
   }

   if (isset($_GET['sup'])) {
      $requser = $bdd->prepare('DELETE  articles WHERE id=?');
      $requser->execute(array($article['id']));
   }
   function tronquer($description)
   {
      //nombre de caractères à afficher
      $max_caracteres = 200;
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
      <title>Profil de <?php echo $userinfo['name'] . " " . $userinfo['lastname']; ?></title>
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
      <link rel="stylesheet" type="text/css" href="css/styleart.css">
      <!--===============================================================================================-->
   </head>

   <body style="color: #3f80c1; background-color: #1b1e21; ">
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
         <div class="container">
            <a class="navbar-brand js-scroll-trigger" href="#page-top">Mon Blog</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
               <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
               <ul class="navbar-nav ml-auto">
                  <li class="nav-item">
                     <form action="" method="post">
                        <input class="btn btn-outline-success my-2 my-sm-0" type="submit" name="acc" class="nav-link js-scroll-trigger" value="File d'actualités" />
                     </form>
                  </li>
                  <li class="nav-item">
                     <a class="btn btn-outline-success my-2 my-sm-0" class="nav-link js-scroll-trigger " href="deconnexion.php">Se déconnecter</a>
                  </li>
                  </form>
               </ul>
            </div>
         </div>
      </nav>
      <br>
      <br>
      <br>
      <br>
      <div>
         <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Mon compte</a>
            <a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Edité mon profil</a>
            <a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-new" role="tab" aria-controls="v-pills-new" aria-selected="false">Nouvelle articles</a>
            <?php
            if ($userinfo['adm'] == "oui") {
            ?>
               <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-users" role="tab" aria-controls="v-pills-users" aria-selected="false">Utilisateurs</a>
               <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-pubs" role="tab" aria-controls="v-pills-pub" aria-selected="false">Publication</a>
            <?php } ?>
            <!--<a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-th" role="tab" aria-controls="v-pills-th" aria-selected="false">Mes photos</a>-->
         </div>
         <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab"> <?php require('moncompte.php'); ?></div>
            <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
               <br>
               <br>
               <?php require('modifier.php'); ?></div>
            <div class="tab-pane fade" id="v-pills-new" role="tabpanel" aria-labelledby="v-pills-new-tab">
               <br>
               <br>
               <?php require('article.php'); ?></div>
            <div class="tab-pane fade" id="v-pills-users" role="tabpanel" aria-labelledby="v-pills-users-tab">
               <br>
               <br>
               <?php require('utilisateur.php'); ?></div>
            <div class="tab-pane fade" id="v-pills-pubs" role="tabpanel" aria-labelledby="v-pills-pub-tab">
               <br>
               <br>
               <?php require('publication.php'); ?></div>
            <!--<div class="tab-pane fade" id="v-pills-th" role="tabpanel" aria-labelledby="v-pills-th-tab">
               <?php //require('gal.php'); ?>
            </div>-->
         </div>
      </div>

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
      <script>
         $('#myTab a').on('click', function(e) {
            e.preventDefault()
            $(this).tab('show')
         })
      </script>

   </body>

   </html>
<?php
}
?>