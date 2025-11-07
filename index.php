<?php
$file = "users.txt";

if(isset($_POST['add']) && !isset($_POST['edit_index'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $newUser = $name . "|" . $email . "\n";
    file_put_contents($file, $newUser, FILE_APPEND);
}

if(isset($_POST['edit_index'])){
    $editIndex = (int)$_POST['edit_index'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    if(file_exists($file)){
        $lines = file($file, FILE_IGNORE_NEW_LINES);
        if(isset($lines[$editIndex])){
            $lines[$editIndex] = $name . "|" . $email;
            file_put_contents($file, implode("\n", $lines) . "\n");
        }
    }
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

$edit_user = null;
$edit_index = null;
if(isset($_GET['edit'])){
    $edit_index = (int)$_GET['edit'];
    if(isset($users[$edit_index])){
        $edit_user = $users[$edit_index];
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
        <td>
            <a href="?edit=<?= $index ?>">edit</a> | 
            <a href="?delete=<?= $index ?>" onclick="return confirm('Are you sure?')">delete</a>
        </td>
    </tr>
    <?php } ?>
</table>

<br><br>

<h3><?= $edit_user ? 'edit user' : 'add user' ?></h3>

<form method="post">
    <label>name:</label>
    <input type="text" name="name" required value="<?= $edit_user ? htmlspecialchars($edit_user[0]) : '' ?>"><br><br>
    <label>email:</label>
    <input type="email" name="email" required value="<?= $edit_user ? htmlspecialchars($edit_user[1]) : '' ?>"><br><br>

    <?php if($edit_user): ?>
        <input type="hidden" name="edit_index" value="<?= $edit_index ?>">
        <button type="submit">update</button>
        <a href="index.php"><button type="button">back to user list</button></a>
    <?php else: ?>
        <button type="submit" name="add">add</button>
    <?php endif; ?>
</form>

</body>
</html>