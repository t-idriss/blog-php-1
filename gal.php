<html>

<head>
    <style>
        div.gallery {
            margin: 5px;
            border: 1px solid #ccc;
            float: left;
            width: 180px;
        }

        div.gallery:hover {
            border: 1px solid #777;
        }

        div.gallery img {
            width: 100%;
            height: auto;
        }

        div.desc {
            padding: 15px;
            text-align: center;
        }
    </style>
    <?php $requser = $bdd->prepare('SELECT * FROM profilep  WHERE id_user=? ORDER BY id DESC');
    $requser->execute(array($getid));
    $albums = $requser->fetch();
    foreach ($albums as $album) :
    ?>
        <div class="gallery">
            <a target="_blank" href="<?php echo $album['lien']; ?>">
                <img src="<?php echo $album['lien']; ?>" alt="Cinque Terre" width="600" height="400">
            </a>
            <div class="desc"></div>
        </div>
    <?php endforeach ?>