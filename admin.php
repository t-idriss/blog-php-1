<?php
require("db.php");
if (isset($_GET['id']) and !empty($_GET['id'])) {
    $id = htmlspecialchars($_GET['id']);
    $supp_user = $bdd->prepare('SELECT * FROM users WHERE id=?');
    $supp_user->execute(array($id));
    $user = $supp_user->fetch();
    if ($user['adm'] == "non") {
        $supp_user = $bdd->prepare('UPDATE users SET adm="oui" WHERE id=?');
        $supp_user->execute(array($id));
    } elseif($user['adm'] == "oui") {
        $supp_user = $bdd->prepare('UPDATE users SET adm="non" WHERE id=?');
        $supp_user->execute(array($id));
    }
    header('location: profil.php' . $_SERVER['HTTP_REFERER']);
}
