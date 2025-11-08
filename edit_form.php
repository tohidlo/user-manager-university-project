<?php
include 'functions.php';

$users = getUsers($file);
$edit_index = null;
$edit_user = null;

if(isset($_GET['edit'])){
    $edit_index = (int)$_GET['edit'];
    if(isset($users[$edit_index])){
        $edit_user = $users[$edit_index];
    } else {
        die("User not found");
    }
} else {
    die("No user specified for editing");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit User</title>
</head>
<body>

<h3>Edit User</h3>

<form method="post" action="edit.php">
    <label>Name:</label>
    <input type="text" name="name" required value="<?= htmlspecialchars($edit_user[0]) ?>"><br><br>

    <label>Email:</label>
    <input type="email" name="email" required value="<?= htmlspecialchars($edit_user[1]) ?>"><br><br>

    <input type="hidden" name="edit_index" value="<?= $edit_index ?>">
    <button type="submit">Update</button>
    <a href="index.php"><button type="button">Back</button></a>
</form>

</body>
</html>