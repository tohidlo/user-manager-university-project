<?php
$file = "users.txt";

if(isset($_POST['add'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $newUser = $name . "|" . $email . "\n";
    file_put_contents($file, $newUser, FILE_APPEND);
}

if(isset($_GET['delete'])){
    $deleteIndex = (int)$_GET['delete'];
    if(file_exists($file)){
        $lines = file($file, FILE_IGNORE_NEW_LINES);
        if(isset($lines[$deleteIndex])){
            unset($lines[$deleteIndex]);
            file_put_contents($file, implode("\n", $lines) . "\n");
        }
    }
}

$users = [];
if(file_exists($file)){
    $lines = file($file, FILE_IGNORE_NEW_LINES);
    foreach($lines as $line){
        $parts = explode("|", $line);
        if(count($parts) == 2){
            $users[] = $parts;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>user manager</title>
</head>
<body>

<h3>user list</h3>

<table border="1" cellpadding="8" cellspacing="0">
    <tr>
        <th>name</th>
        <th>email</th>
        <th>action</th>
    </tr>

    <?php foreach($users as $index => $user) { ?>
    <tr>
        <td><?= htmlspecialchars($user[0]) ?></td>
        <td><?= htmlspecialchars($user[1]) ?></td>
        <td><a href="?delete=<?= $index ?>" onclick="return confirm('Are you sure?')">delete</a></td>
    </tr>
    <?php } ?>
</table>

<br><br>

<h3>add user</h3>

<form method="post">
    <label>name:</label>
    <input type="text" name="name" required><br><br>
    <label>email:</label>
    <input type="email" name="email" required><br><br>
    <button type="submit" name="add">add</button>
</form>

</body>
</html>