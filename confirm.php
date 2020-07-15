<?php
$user_id = $_GET['id'];
$token = $_GET['token'];
require("db.php");

$req = $bdd->prepare('SELECT confirmation_token FROM users WHERE id=?');
$req->execute([$user_id]);
$user = $req->fetch();
session_start();
if($user && $user->confirmation_token == $token){
   
    $req = $bdd->prepare('UPDATE users SET confirmation_token=NULL, confirmed_at=NOW(), WHERE id =?')->execute([$user_id]);

    $_SESSION['auth']= $user;
    header('location: account.php');
} else{
    $_SESSION['flash']['dabger']="Ce token n'est plus valide";
    header('location: login.php');
}
