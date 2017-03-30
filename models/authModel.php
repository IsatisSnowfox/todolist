<?php

function connectUser() {
    $db = connectDb();
    $hashed_pw = sha1($_POST['password']);
    try {
        $statement = $db->prepare('SELECT * FROM users WHERE email = :email AND password = :password');
        $statement->bindParam(':email', $_POST['email']);
        $statement->bindParam(':password', $hashed_pw);
        $statement->execute();
        $user = $statement->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $error) {}

    if(!$user) {
        return false;
    }

    $_SESSION['user'] = $user;

    return true;
}
