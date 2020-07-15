<?php
require("db.php");
if (isset($_GET['id']) and !empty($_GET['id'])) {
    $supp_id = htmlspecialchars($_GET['id']);
    $supp_user = $bdd->prepare('DELETE FROM users WHERE id=?');
    $supp_user->execute(array($supp_id));
    header('location: profil.php' . $_SERVER['HTTP_REFERER']);
}
