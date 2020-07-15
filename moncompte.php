<br>
<br>
<div class="container emp-profile">
    <form method="post">
        <div class="row">
            <div class="col-md-4">
                <div class="profile-img">
                    <img class="img-thumbnail rounded-circle" src="<?php echo $pro; ?>" alt="" width="150" height="200" />
                </div>
            </div>
            <div class="col-md-6">
                <div class="profile-head">
                    <h5>
                        <?php echo $userinfo['name'] . " " . $userinfo['lastname']; ?>
                    </h5>
                    <h6>
                        <p><?php echo $userinfo['profession']; ?></p>
                    </h6>
                    <p class="proile-rating">RANKINGS : <span>8/10</span></p>
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Timeline</a>
                        </li>
                    </ul>
                </div>
            </div>
            <?php if ($userinfo['id'] == $_SESSION['id']) { ?>

            <?php } ?>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="profile-work">
                    <!-- <p>WORK LINK</p>
                     <a href="">Website Link</a><br />
                     <a href="">Bootsnipp Profile</a><br />
                     <a href="">Bootply Profile</a>
                     <p>SKILLS</p>
                     <a href="">Web Designer</a><br />
                     <a href="">Web Developer</a><br />
                     <a href="">WordPress</a><br />
                     <a href="">WooCommerce</a><br />
                     <a href="">PHP, .Net</a><br />-->
                </div>
            </div>
            <div class="col-md-8">
                <div class="tab-content profile-tab" id="myTabContent">
                    <div class="tab-pane fade active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <!--<div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">-->
                        <div class="row">
                            <div class="col-md-6">
                                <label>User Id</label>
                            </div>
                            <div class="col-md-6">
                                <p><?php echo $userinfo['id']; ?></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Name</label>
                            </div>
                            <div class="col-md-6">
                                <p><?php echo $userinfo['username']; ?></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Email</label>
                            </div>
                            <div class="col-md-6">
                                <p><?php echo $userinfo['email']; ?></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Phone</label>
                            </div>
                            <div class="col-md-6">
                                <p><?php echo $userinfo['phonenumber']; ?></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Profession</label>
                            </div>
                            <div class="col-md-6">
                                <p>
                                    <p><?php echo $userinfo['profession']; ?></p>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="row">
                            <div class="col-md-6">
                                <label>Experience</label>
                            </div>
                            <div class="col-md-6">
                                <p>......</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Hourly Rate</label>
                            </div>
                            <div class="col-md-6">
                                <p>.........</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Total Projects</label>
                            </div>
                            <div class="col-md-6">
                                <p>........</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>English Level</label>
                            </div>
                            <div class="col-md-6">
                                <p>........</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Availability</label>
                            </div>
                            <div class="col-md-6">
                                <p>.......</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label>Your Bio</label><br />
                                <p>Your detail description</p>
                            </div>
                        </div>
                    </div>
                    <?php if (isset($_SESSION['id']) and $_SESSION['id'] != $getid) { ?>

                        <a class="btn btn-primary" style="color: white;" href="follow.php?followedid=<?php echo $getid; ?>">
                            follow
                        </a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </form>
</div>
<br>
<br>

<?php
$articles = $bdd->query("select * from articles where id_user='$getid'order by date desc");

foreach ($articles as $article) :
    $cont = tronquer($article['containt']);
    $artid = $article['id'];
    $l = $bdd->prepare('SELECT id FROM likes WHERE id_article=?');
    $l->execute(array($artid));
    $l = $l->rowCount();

?>
    <article style="width: 100%; font-size: 14px;
  line-height: 100%;
  color: #222;
  font-weight: 100%;
  font-family: 'Montserrat';
  background-image: url('images/font_art.jpg');
  color: black;
  background-repeat: no-repeat;
  background-size: cover;
  -moz-background-size: cover;
  -webkit-background-size: cover;
  -o-background-size: cover;
  -ms-background-size: cover;
  background-position: center center; margin-left: auto; margin-right: auto;">
        <br>
        <br>
        <br>
        <div class="container">
            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative" style="background-color: #ddd">
                        <div class="col-auto d-none d-lg-block">
                            <img class="bd-placeholder-img" width="300" height="100%" src="<?php echo $article['lien'] ?>">
                            <?php if ($userinfo['id'] == $_SESSION['id']) { ?>
                            <?php } ?>
                        </div>
                        <div class="col p-4 d-flex flex-column position-static">
                            <div class="fl-en-left-user">
                                <div>
                                    <img class="img-p" src="<?php echo $userpro['lien'] ?>" alt="">
                                </div>
                                <div>
                                    <h5><?php echo $userinfo['name'] ?> <?php echo $userinfo['lastname'] ?></h5>
                                </div>
                            </div>
                            <strong class="d-inline-block mb-2 text-primary"><?php echo $article['theme'] ?></strong>
                            <h3 class="mb-0"><?php echo $article['titre'] ?></h3>
                            <div class="mb-1 text-muted">Posted on <?php echo $article['date'] ?></div>
                            <p class="card-text mb-auto"><?php echo $cont ?></p>
                            <a href="afficheart.php?id=<?php echo $article['id'] ?>" class="stretched-link">Continue reading</a>
                            <div class="btn-group btn-group-toggle">
                                <form action="modif_art.php" method="post" style="z-index: 1;">
                                    <?php if (!empty($_SESSION['id'])) { ?>
                                        <!--$getid = intval($_SESSION['id']);
                                      $requser = $bdd->prepare('SELECT * FROM users WHERE id=?');
                                      $requser->execute(array($getid));
                                      $userinfo = $requser->fetch();-->

                                        <a style="z-index: 1;" href="action.php?t=1&id=<?php echo $artid; ?>&id_user=<?php echo $_SESSION['id']; ?>"><i class="fa fa-thumbs-up" aria-hidden="true"></i> Liker(<?php echo $l; ?>)</i></a>
                                        <a style="z-index: 1;" href="commentaire.php?t=3&id=<?php echo $artid; ?>&id_user=<?php echo $_SESSION['id']; ?>"><i class="fa fa-commenting" aria-hidden="true"> Commenter</i></a>

                                        <?php if ($userinfo['id'] == $_SESSION['id']) { ?>

                                            <a style="z-index: 1;" href="modifart.php?edit=<?php echo $artid; ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"> Editer</i></a>
                                            <a style="z-index: 1; color: red" href="supprimer.php?id=<?php echo $artid; ?>"><i class="fa fa-times" aria-hidden="true"> Supprimer</i></a>
                                    <?php }
                                    } ?>

                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr>
    </article>

<?php endforeach ?>
<br>
<br>
<br>
<br>
<br>