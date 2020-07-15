<?php
$bdd = new PDO("mysql:host=localhost; charset=utf8; dbname=maroc_idrissa_blog_deux", "idrissa", "256e8b3eMDMzMWU4Mjc5MWNhZTUwNDk5NWNiNmY058f76ecb" );
/* "mysql:host=localhost;dbname=maroc_idrissa_blog_un", "idrissa", "256e8b3eMDMzMWU4Mjc5MWNhZTUwNDk5NWNiNmY058f76ecb" */

function conexion(){
    session_start();
    $color="red";
    $error="";
    if (isset($_POST["login"])) {
    	$mailconnect = htmlspecialchars($_POST['email']);
    	$mdpconnect = sha1($_POST['pass']);
	    if (!empty($mailconnect) and !empty($mdpconnect)) {
	    	$requser = $bdd->prepare("SELECT * FROM users WHERE adress_email=? AND password=?");
	    	$requser->execute(array($mailconnect, $mdpconnect));
	       	$userexist = $requser->rowCount();
	    	if ($userexist == 1) {
                $userinfo = $requser->fetch();
			    $_SESSION['id']= $userinfo['id'];
			    $_SESSION['name']= $userinfo['name'];
			    $_SESSION['email']= $userinfo['email'];
			    header('location: profil.php?id='.$_SESSION['id']);
		    } else{
			    $error="Mauvais mail ou mots de passe!!!";
		    }
	        }else{
		        $error="Tous les champs doivent être remplis";
	    }
    }
}

function inscription(){
    $errore = "";
    $errorp = "";
    $creat = "";
    $color = 'red';
    $colore = "black";
    $color2 = "green";

    if (isset($_POST['inscription'])) {
        $n = htmlspecialchars($_POST['name']);
        $ln = htmlspecialchars($_POST['lname']);
        $e = htmlspecialchars($_POST['email']);
        $p = htmlspecialchars($_POST['pass']);
        $cp = htmlspecialchars($_POST['cpass']);
        if ($p == $cp && $p != "" && $cp != "") {
            if ($n == "" && !preg_match("/^[a-zA-Z0-9_]+$/", $n) || $ln == "" && !preg_match("/^[a-zA-Z0-9_]+$/", $ln)) {
                $errorname = "Votre nom ou prénom n'est pas valide";
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
}

function like_dislike(){
    if (isset($_GET['t']) and isset($_GET['id_user']) and isset($_GET['id']) and !empty($_GET['id']) and !empty($_GET['t']) and !empty($_GET['id_user'])) {
        $getid = (int) $_GET['id'];
        $gett = (int) $_GET['t'];
        $getuser = (int) $_GET['id_user'];

        $check = $bdd->prepare('SELECT id FROM articles WHERE id=?');
        $check->execute(array($getid));
        if ($check->rowCount() == 1) {
            if ($gett == 1) {
                $check_like = $bdd->prepare('SELECT id FROM likes WHERE id_article=? AND id_user=?');
                $check_like->execute(array($getid, $getuser));

                if ($check_like->rowCount() == 1) {
                    $del = $bdd->prepare('DELETE FROM likes(id_article,id_user) VALUES(?,?)');
                    $del->execute(array($getid, $getuser));
                } else {
                    $ins = $bdd->prepare('INSERT INTO likes(id_article, id_user) VALUES(?,?)');
                    $ins->execute(array($getid, $getuser));
                }
            } elseif ($gett == 2) {
                $check_dlike = $bdd->prepare('SELECT id FROM dislikes WHERE id_article=? AND id_user=?');
                $check_dlike->execute(array($getid, $getuser));

            if ($check_dlike->rowCount() == 1) {
                $del = $bdd->prepare('DELETE FROM dislikes(id_article,id_user) VALUES(?,?)');
                $del->execute(array($getid, $getuser));
            } else {
                $ins = $bdd->prepare('INSERT INTO dislikes(id_article, id_user) VALUES(?,?)');
                $ins->execute(array($getid, $getuser));
            }
            }
            header('location: profil.php' . $_SERVER['HTTP_REFERER']);
        }
    }
}

function insert_article(){
    session_start();
    if (isset($_GET['id']) and $_GET['id'] > 0) {
        $getid = intval($_GET['id']);
        $requser = $bdd->prepare('SELECT * FROM users WHERE id=?');
        $requser->execute(array($getid));
        $userinfo = $requser->fetch();
        if (isset($_POST['AddMore'])) {
            $titre = htmlspecialchars($_POST['titre']);
            $theme = htmlspecialchars($_POST['theme']);
            $contenu = htmlspecialchars($_POST["contenu"]);
            $requsere = $bdd->prepare("INSERT INTO articles(theme,titre,containt,id_user) VALUES (?,?,?,?)");
            $requsere->execute(array($theme,$titre, $contenu,$getid));
            header('location: profil.php?id=' . $getid);
        }
        if (isset($_POST['profil'])) {
            header('location: profil.php?id=' . $_SESSION['id']);
        }
    }
}

function deconexion(){
    session_start();
    $_SESSION = array();
    session_destroy();
    header("location: login.php");
}

Afficheur articles{
     <?php
    $articles = $bdd->query("select  id, titre, theme, containt, date from articles order by date desc");
    foreach ($articles as $article) :
         $cont = tronquer($article['containt']);
         $artid = $article['id'];
         $l = $bdd->prepare('SELECT id FROM likes WHERE id_article=?');
         $l->execute(array($artid));
         $l = $l->rowCount();
         $d = $bdd->prepare('SELECT id FROM dislikes WHERE id_article=?');
         $d->execute(array($artid));
         $d = $d->rowCount();

     ?>
     
    <?php endforeach ?>
}