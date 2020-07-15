<table class="table table-dark">
    <thead class="">
        <tr>
            <th scope="col">ID</th>
            <th scope="col">photo</th>
            <th scope="col">Nom</th>
            <th scope="col">Prenom</th>
            <th scope="col">Email</th>
            <th scope="col">Inscription</th>
            <?php if ($userinfo['super_admin'] == "oui") { ?>
                <th scope="col">Admin</th>
            <?php } ?>
            <th scope="col">Ejecter</th>
        </tr>
    </thead>

    <tbody>
        <?php
        require('db.php');
        $utilisateur = $bdd->query("select  * from users where super_admin='non' order by id");

        foreach ($utilisateur as $user) :
            $id_user = $user['id'];
            $nom = $user['name'];
            $prenom = $user['lastname'];
            $email = $user['email'];
            $date = $user['add_date'];
            $adm = $user['adm'];
            $requser = $bdd->prepare('SELECT * FROM profilep  WHERE id_user=? ORDER BY id DESC LIMIT 1');
            $requser->execute(array($id_user));
            $userpro = $requser->fetch();
        ?>
            <tr>
                <?php if ($id_user != $_SESSION['id']) { ?>
                    <th scope="row"><?php echo $id_user ?></th>
                    <td><img class="rounded-circle" width="30px" height="30px" src="<?php echo $userpro['lien'] ?>" alt=""></td>
                    <td><?php echo $nom ?></td>
                    <td><?php echo $prenom ?></td>
                    <td><?php echo $email ?></td>
                    <td><?php echo $date ?></td>
                    <?php if ($userinfo['super_admin'] == "oui") { ?>
                        <td><a href="admin.php?id=<?php echo $id_user;?>"><?php echo $user['adm'] ?></a></td>
                    <?php } ?>
                    <td><a href="du.php?id=<?php echo $id_user; ?>">Supprimer</a></td>
                <?php } ?>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>
<br>
<br>
<br>
<br>
<br>