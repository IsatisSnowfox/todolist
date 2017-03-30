<?php

require 'models/taskModel.php';

function index() {
    if(getTasksList() === false) {
        header('Location: http://homestead.app/todolist/errors/error_connect.php');
        exit;
    }
    $view = 'tasksIndex.php';
    return ['view' => $view];
}

function getUpdate() {
    $view = 'tasksGetUpdate.php';
    return ['view' => $view];
}

function postUpdate() {
    if(updateTask() === false) {
        header('Location: http://homestead.app/todolist/errors/error_connect.php');
        exit;
    }
    header('Location: http://homestead.app/todolist/index.php?ressource=task&action=index');
    exit;
}

function create() {
    if(createTask() === false) {
        header('Location: http://homestead.app/todolist/errors/error_connect.php');
        exit;
    }
    header('Location: http://homestead.app/todolist/index.php?ressource=task&action=index');
    exit;
}

function postDelete() {
    if(deleteTask() === false) {
        header('Location: http://homestead.app/todolist/errors/error_connect.php');
        exit;
    }
    header('Location: http://homestead.app/todolist/index.php?ressource=task&action=index');
    exit;
}
