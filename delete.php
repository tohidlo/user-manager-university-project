<?php
include 'functions.php';

if(isset($_GET['index'])){
    $index = (int)$_GET['index'];
    $users = getUsers($file);

    if(isset($users[$index])){
        unset($users[$index]);
        saveUsers($file, $users);
    }
}

header("Location: index.php");
exit;