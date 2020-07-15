<?php
try {
    require("db.php");
    // set the PDO error mode to exception
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = $bdd->prepare('SELECT COUNT(email) AS EmailCount FROM users WHERE email = :email');
    $sql->execute(array('email' => $_POST['email']));
    $result = $sql->fetch(PDO::FETCH_ASSOC);

    if ($result['EmailCount'] == 0) {
        $password = sha1($_POST['password']);
        //$token = str_random(60);
        $sql = "INSERT INTO users(username,email,pass,adm,super_admin)
        VALUES ('$n', '$e', '$password','non','non')";
        $bdd->exec($sql);
        /*$user_id = $conn->lastInsertId();
            mail($_POST['email'], 'Confirmation de votre compte', "Afin de valider votre compte merci de cliquer sur ce lien\n\nhttp://localhost/blog1/confirm.php?id=$user_id&token=$token");
            header('location: login.php');
            exit();*/
        // use exec() because no results are returned

        $creat = "New record created successfully";
        header('location: login.php');
    } else {
        $errore = "Cet email existe déja!!!";
    }
} catch (PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}

$bdd = null;
/*if (isset($_POST['inscription'])) {
    $n = $_POST['name'];
    $e = $_POST['email'];
    $p = $_POST['password'];
    $cp = $_POST['re_password'];
    if (empty($_POST)) {
        $errors = array();
        if (empty($n) || !preg_match("/^[a-zA-Z0-9_]+$/", $n)) {
            $errors['name'] = "Votre pseudo n'est pas valide";
        } elseif (empty($e) || !filter_var($e, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "Votre email n'est pas valide";
        } elseif (empty($p) || $p != $cp) {
            $errors['password'] = "Vous devez renter un mot de passe valide";
        } else{ getUsers($n, $e);}
        
        
    }
    
}*/

/*function generate_unique_username($firstname, $lastname, $id){    
    $userNamesList = array();
    $firstChar = str_split($firstname, 1)[0];
    $firstTwoChar = str_split($firstname, 2)[0];
    
    $numSufix = explode('-', date('Y-m-d-H')); 

    // create an array of nice possible user names from the first name and last name
    array_push($userNamesList, 
        $firstname,                 //james
        $lastname,                 // oduro
        $firstname.$lastname,       //jamesoduro
        $firstname.'.'.$lastname,   //james.oduro
        $firstname.'-'.$lastname,   //james-oduro
        $firstChar.$lastname,       //joduro
        $firstTwoChar.$lastname,    //jaoduro,
        $firstname.$numSufix[0],    //james2019
        $firstname.$numSufix[1],    //james12 i.e the month of reg
        $firstname.$numSufix[2],    //james28 i.e the day of reg
        $firstname.$numSufix[3]     //james13 i.e the hour of day of reg
    );


    $isAvailable = false; 
    $index = 0;
    $maxIndex = count($userNamesList) - 1;

    
    do {
        $availableUserName = $userNamesList[$index];
        $isAvailable = isAvailable($availableUserName);
        $limit =  $index >= $maxIndex;
        $index += 1;
        if($limit){
        break;
        }
    } while (!$isAvailable );

    /
    if(!$isAvailable){
        return $firstname.$userId;
    }
    return $availableUserName;
}*/
function str_random($lenght)
{
    $alphabet = "0123456789azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN";
    return substr(str_shuffle(str_repeat($alphabet, $lenght)), 0, $lenght);
}
