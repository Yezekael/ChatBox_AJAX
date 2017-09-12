<?php
    include('config.php');

    $nickname = trim($_GET['nickname']);
    $password = trim($_GET['password']);

    if ($nickname && $password) {
        $password = sha1($password);
        $req = $pdo->prepare("SELECT * FROM `user` WHERE nickname = :nickname AND password = :password");
        $results = $req->execute(array(':nickname' => $nickname, ':password' => $password));
        $user = $req->fetchAll();
        if ($results) {
            if (count($user) == 1) {
                echo json_encode(array('success' => 'true'));
            } else {
                echo json_encode(array('success' => 'false', 'error' => 'Username et/ou mot de passe incorrects.'));
            }
        } else {
            echo json_encode(array('success' => 'false', 'error' => 'Erreur en BDD.'));
        }
    }
?>
