<?php
$file = "users.txt";

function getUsers($file) {
    $users = [];
    if (file_exists($file)) {
        $lines = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            $parts = explode("|", $line);
            if (count($parts) == 2) {
                $users[] = $parts;
            }
        }
    }
    return $users;
}

function saveUsers($file, $users) {
    $lines = [];
    foreach ($users as $user) {
        $lines[] = implode("|", $user);
    }
    file_put_contents($file, implode("\n", $lines) . "\n");
}

function addUser($file, $name, $email) {
    $users = getUsers($file);
    $users[] = [$name, $email];
    saveUsers($file, $users);
}

function editUser($file, $index, $name, $email) {
    $users = getUsers($file);
    if (isset($users[$index])) {
        $users[$index] = [$name, $email];
        saveUsers($file, $users);
    }
}

function deleteUser($file, $index) {
    $users = getUsers($file);
    if (isset($users[$index])) {
        unset($users[$index]);
        saveUsers($file, array_values($users));
    }
}