<?php
require("db.php");
if (isset($_GET['id']) and !empty($_GET['id'])) {
    $edit_id = htmlspecialchars($_GET['id']);
    $edit_article = $bdd->prepare('SELECT * FROM articles WHERE id=?');
    $edit_article->execute(array($edit_id));
    $edit_article = $edit_article->fetch();
    $useid = $edit_article['id_user'];
    $supp_id = htmlspecialchars($_GET['id']);
    $supp_article = $bdd->prepare('DELETE FROM articles WHERE id=?');
    $supp_article->execute(array($supp_id));
    header('location: profil.php?id=' . $useid);
}