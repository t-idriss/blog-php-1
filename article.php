<?php

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Poster un article</title>
</head>

<body>
    <div class="container emp-profile" style=" text-align: center; background-color: #343a40; color: white;padding: 30px">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <input type="text" class="form-control" rows="5" name="titre" placeholder="titre" required>
            </div>
            <br>
            <br>
            <div class="form-group">
                <input type="text" class="form-control" rows="5" name="theme" placeholder="theme" required>
            </div>
            <br>
            <br>
            <div class="form-group">
                <div class="col-md-6" style="border:1">
                    <input type="file" name="img" />
                </div>
            </div>
            <br>
            <br>
            <div class="form-group">
                <textarea name="contenu" class="form-control" rows="5" placeholder="Le contenu du post" required></textarea>
            </div>
            <br>
            <br>
            <div class="row">
                <div class="col-md-6">
                    <input type="submit" class="login100-form-btn" name="Ad" value="Créer l'article" />
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

?>