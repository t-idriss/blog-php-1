<?php $articles = $bdd->query("select  id, titre, theme, containt, date, id_user, lien from articles order by date desc");
foreach ($articles as $article) :
    $cont = tronquer($article['containt']);
    $artid = $article['id'];
    $l = $bdd->prepare('SELECT id FROM likes WHERE id_article=?');
    $l->execute(array($artid));
    $l = $l->rowCount();
    $getid = intval($article['id_user']);
    $requser = $bdd->prepare('SELECT * FROM users WHERE id=?');
    $requser->execute(array($getid));
    $userinfo = $requser->fetch();

    $requser = $bdd->prepare('SELECT * FROM profilep  WHERE id_user=? ORDER BY id DESC LIMIT 1');
    $requser->execute(array($getid));
    $userpro = $requser->fetch();
?>
    <!DOCTYPE html>
    <html>

    <head>
        <link rel="stylesheet" type="text/css" href="css/styleart.css">
    </head>


    <div class="container">
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative" style="background-color: #ddd">
                    <div class="col-auto d-none d-lg-block">
                        <img class="bd-placeholder-img" width="300" height="100%" src="<?php echo $article['lien'] ?>">
                    </div>
                    <div class="col p-4 d-flex flex-column position-static">
                        <div style="z-index: 1;" class="fl-en-left-user">
                            <div>
                                <a style="z-index: 1;" href="profil.php?id=<?php echo $userinfo['id']; ?>"><img class="img-p" src="<?php echo $userpro['lien'] ?>" alt=""></a>
                            </div>
                            <div>
                                <a style="z-index: 1;" href="profil.php?id=<?php echo $userinfo['id']; ?>">
                                    <h5><?php echo $userinfo['name'] ?> <?php echo $userinfo['lastname'] ?></h5>
                                </a>
                            </div>
                        </div>
                        <h3 class="mb-0"><?php echo $article['titre'] ?></h3><strong class="d-inline-block mb-2 text-primary">(<?php echo $article['theme'] ?>)</strong>
                        <div class="mb-1 text-muted">Posted on <?php echo $article['date'] ?></div>
                        <p class="card-text mb-auto"><?php echo $cont ?></p>
                        <a href="afficheart.php?id=<?php echo $article['id'] ?>" class="stretched-link">Continue reading</a>
                        <div class="btn-group btn-group-toggle">
                            <form action="modif_art.php" method="post" style="z-index: 1;">
                                <?php if (!empty($_SESSION['id'])) {
                                ?>
                                    <div class="en-icon">
                                        <div class="icon"><a style="z-index: 1;" href="action.php?t=1&id=<?php echo $artid; ?>&id_user=<?php echo $_SESSION['id']; ?>"><i class="fa fa-heart-o like" aria-hidden="true"></i>(<?php echo $l; ?>)</i></a></div>
                                        <div class="icon"><a style="z-index: 1;" href="commentaire.php?t=3&id=<?php echo $artid; ?>&id_user=<?php echo $_SESSION['id']; ?>"><i class="fa fa-commenting" aria-hidden="true"></i></a></div>

                                        <?php if ($userinfo['id'] == $_SESSION['id']) { ?>

                                            <div class="icon" style="z-index: 1;"><a href="modifart.php?edit=<?php echo $artid; ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></div>
                                            <div class="icon"><a style="z-index: 1; color: red" href="supprimer.php?id=<?php echo $artid; ?>"><i class="fa fa-times" aria-hidden="true"></i></a></div>

                                        <?php }
                                        if ($userinfo['id'] != $_SESSION['id']) { ?>
                                            <div class="icon"><a style="z-index: 1; color: red" href="signaler.php?id=<?php echo $artid; ?>"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i></a></div>
                                    </div>
                                <?php } } else { ?>
                                <div class="en-icon">
                                    <div class="icon"><i class="fa fa-heart-o like" aria-hidden="true"></i>(<?php echo $l; ?>)</div>
                                    <div class="icon"><i class="fa fa-comment comm" aria-hidden="true"></i></div>
                                </div>
                            <?php } ?> 


                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <hr>

    </html>
<?php endforeach ?>