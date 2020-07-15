<?php
if (isset($_POST["ajouter"])) {
}

if (isset($_GET['id']) and $_GET['id'] > 0) {
    $getid = intval($_GET['id']);
    $requser = $bdd->prepare('SELECT * FROM users WHERE id=?');
    $requser->execute(array($getid));
    $userinfo = $requser->fetch();
    $un = $userinfo['username'];
    $n = $userinfo['name'];
    $ln = $userinfo['lastname'];
    $numb = $userinfo['phonenumber'];
    $unam = $userinfo['username'];
    $nam = $userinfo['name'];
    $las = $userinfo['lastname'];
    $Prof = $userinfo['profession'];
    $p = $userinfo['profession'];
    if (isset($_POST['valider'])) {
        $maxsize = 500000;
        $validext = array(".jpg", ".jpeg", ".JPG", "JPEG");
        if ($_FILES["img"]["error"] > 0) {

            echo 'Une erreur est survenue lors du chargement';
            die;
        }
        $filesize = $_FILES['img']['size'];
        if ($filesize > $maxsize) {
            $er = 'La taille de ce fichier est trop grand!!';
        }

        $filename = $_FILES['img']['name'];
        $fileext = "." . strtolower(substr(strrchr($filename, "."), 1));

        if (!in_array($fileext, $validext)) {
            $er = "Ce fichier n'est pas un document image";
        }
        $tmpname = $_FILES['img']['tmp_name'];
        $uname = md5(uniqid(rand(), true));
        $filename = "images/profile/" . $uname . $fileext;
        if (move_uploaded_file($tmpname, $filename)) {
            require("db.php");
            $sql = "INSERT INTO profilep(lien,id_user)
        VALUES ('$filename','$getid')";
            $bdd->exec($sql);
            $creat = "";
        }
        $num = $_POST['num'];
        $una = $_POST['uname'];
        $na = $_POST['fname'];
        $la = $_POST['lname'];
        $prof = $_POST['pro'];
        if (isset($_FILES['avatar']) and !empty($_FILES['avatar']['name'])) {
            $taillemax = 2097152;
            $extensionsValides = array('jpg', 'jpeg', 'gif', 'png');
            if ($_FILES['avatar']['size'] <= $taillemax) {
                $extensionUpload = strtolower(substr(strrchr($_FILES['avatar']['name'], '.'), 1));
                if (in_array($extensionUpload, $extensionValides)) {
                    $chemin = "avatar/" . $_SESION['id'] . "." . $extensionUpload;
                    $resultat = move_uploaded_file($_FILES['avatar']['lmp_name'], $chemin);
                    if ($resultat) {
                        $updateavatar = $bdd->prepare('UPDATE users SET avatar= ? WHERE id= ?');
                        $updateavatar->execute(array($_SESSION['id'] . "." . $extensionUpload, $_SESSION['id']));
                    } else {
                        $msg = "Erreur durant l'importation de votre fichier";
                    }
                } else {
                    $msg = "Votre photo de profile doit être de format jpg, jpeg, gif ou png";
                }
            } else {
                $msg = "Votre photo de profile ne doit pas depasser 2Mo";
            }
        }
        $requser = $bdd->prepare("UPDATE users SET phonenumber = '$num', username = '$una', name = '$na', lastname = '$la', profession = '$prof' WHERE id=?");
        $requser->execute(array($getid));
        $numb = $num;
        $unam = $una;
        $nam = $na;
        $las = $la;
        $Prof = $prof;
    }
    if (isset($_POST['profil'])) {
        header('location: profil.php?id=' . $_SESSION['id']);
    }

?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>modifier votre profil</title>
    </head>

    <body style="width: 80%;">
        <div class="container emp-profile" style="background-color: #343a40; color: white;padding: 30px">
            <form method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-6">
                        <label>Change Photo</label>
                    </div>
                    <div class="col-md-6" style="border:1">
                        <input type="file" name="img" />
                    </div>
                </div>
                <br>
                <br>
                <div class="row">
                    <div class="col-md-6">
                        <label>Modifier le username</label>
                    </div>
                    <div class="col-md-6">
                        <input type="text" name="uname" value="<?php echo $unam; ?>" />
                    </div>
                </div>
                <br>
                <br>
                <div class="row">
                    <div class="col-md-6">
                        <label>Modifier le prénom</label>
                    </div>
                    <div class="col-md-6">
                        <input type="text" name="fname" value="<?php echo $nam; ?>" />
                    </div>
                </div>
                <br>
                <br>
                <div class="row">
                    <div class="col-md-6">
                        <label>Modifier le nom</label>
                    </div>
                    <div class="col-md-6">
                        <input type="text" name="lname" value="<?php echo $las; ?>" />
                    </div>
                </div>
                <br>
                <br>
                <div class="row">
                    <div class="col-md-6">
                        <label>Numéro de téléphone</label>
                    </div>
                    <div class="col-md-6">
                        <input type="text" name="num" value="<?php echo $numb; ?>" />
                    </div>
                </div>
                <br>
                <br>
                <div class="row">
                    <div class="col-md-6">
                        <label>Proféssion</label>
                    </div>
                    <div class="col-md-6">
                        <input type="text" name="pro" value="<?php echo $Prof; ?>" />
                    </div>
                </div>
                <br>
                <br>
                <br>
                <?php if (isset($msg)) {
                    echo $msg;
                } ?>
                <br>
                <div class="row">
                    <div class="col-md-6">
                        <input type="submit" class="login100-form-btn" name="valider" value="Enrégistrer" />
                    </div>
                </div>
            </form>
        </div>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>

    </body>

    </html>
<?php
}
?>