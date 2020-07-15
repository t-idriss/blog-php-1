<?php
session_start();
require("db.php");
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
            $art = $check_like->fetch();
            $idart= $art['id'];
            if ($check_like->rowCount() == 0) {
                $ins = $bdd->prepare('INSERT INTO likes(id_article, id_user) VALUES(?,?)');
                $ins->execute(array($getid, $getuser));
            } else {
                //$ins = $bdd->prepare('DELETE FROM likes WHERE id_article=? AND id_user=?)');
                //$ins->execute(array($getid, $getuser));
                $supp_user = $bdd->prepare('DELETE FROM likes WHERE id=?');
                $supp_user->execute(array($idart));
            }
        } 
        header('location: profil.php' . $_SERVER['HTTP_REFERER']);
    }
}
