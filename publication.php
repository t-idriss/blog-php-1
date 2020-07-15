<table class="table table-dark">
    <thead class="">
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Titre</th>
            <th scope="col">Theme</th>
            <th scope="col">Users</th>
            <th scope="col">Date</th>
            <th scope="col">Signalement</th>
            <th scope="col">Supprimer</th>
            <th scope="col">Afficher</th>
        </tr>
    </thead>

    <tbody>
        <?php
        require('db.php');
        $publications = $bdd->query("select *  from articles order by id");

        foreach ($publications as $publication) :
            $id = $publication['id'];
            $titre = $publication['titre'];
            $theme = $publication['theme'];
            $user = $publication['id_user'];
            $date = $publication['date'];
            /* $requser = $bdd->prepare('SELECT * FROM profilep  WHERE id_user=? ORDER BY id DESC LIMIT 1');
            $requser->execute(array($id_user));
            $userpro = $requser->fetch();*/
        ?>
            <tr>
                <th scope="row"><?php echo $id ?></th>
                <td><?php echo $titre ?></td>
                <td><?php echo $theme ?></td>
                <td><?php echo $user ?></td>
                <td><?php echo $date ?></td>
                <td>0</td>
                <td><a href="supprimer.php?id=<?php echo $id ?>">Delete</a></td>
                <td><a href="afficheart.php?id=<?php echo $id ?>">Lire</a></td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>
<br>
<br>
<br>
<br>
<br>