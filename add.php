<?php
include 'functions.php';

if(isset($_POST['name'], $_POST['email'])){
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);

    $newUser = $name . "|" . $email . "\n";
    file_put_contents($file, $newUser, FILE_APPEND);
}

header("Location: index.php");
exit;