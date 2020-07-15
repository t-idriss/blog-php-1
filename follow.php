<?php
session_start();
require("db.php");
$getfollowedid = intval($_GET['followedid']);
if($getfollowedid != $_SESSION['id']){
    $df = $bdd->prepare('SELECT * FROM follow WHERRE id_follower=? AND id_following=?');
    $df->execute(array($_SESSION['id'], $getfollowedid));
    $df= $df->rowCount();
    if($df==0){
        $addfollow = $bdd->prepare('INSERT INTO follow(id_follower,id_following) VALUE(?,?)');
        $addfollow->execute(array($_SESSION['id'],$getfollowedid));
    } else{
        $d = $bdd->prepare('DELETE FROM follow WHERE id_follower=? AND id_following=?');
        $d->execute(array($_SESSION['id'], $getfollowedid));
    }
}
header('location: '.$_SERVER['HTTP_REFERER']);
?>