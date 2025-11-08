<?php
include 'functions.php';

if(isset($_POST['edit_index'], $_POST['name'], $_POST['email'])){
    $editIndex = (int)$_POST['edit_index'];
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);

    $users = getUsers($file);
    if(isset($users[$editIndex])){
        $users[$editIndex] = [$name, $email];
        saveUsers($file, $users);
    }
}

header("Location: index.php");
exit;