<?php

require 'models/authModel.php';

function getLogin() {
    $view = 'userlogin.php';
    return ['view' => $view];
}

function postLogin() {
    if(!connectUser()) {
        header('Location: http://homestead.app/todolist/errors/error_connect.php');
        exit;
    }

    header('Location: http://homestead.app/todolist/index.php?ressource=task&action=index');
    exit;
}

function getLogout() {
    session_destroy();
    header('Location: http://homestead.app/todolist/index.php');
}
