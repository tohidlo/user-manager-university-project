<?php
include 'functions.php';

$users = getUsers($file);

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
    <title>User Manager</title>
</head>
<body>

<h3>User List</h3>

<table border="1" cellpadding="8" cellspacing="0">
    <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Action</th>
    </tr>

    <?php foreach($users as $index => $user): ?>
    <tr>
        <td><?= htmlspecialchars($user[0]) ?></td>
        <td><?= htmlspecialchars($user[1]) ?></td>
        <td>
            <a href="?edit=<?= $index ?>">Edit</a> | 
            <a href="delete.php?index=<?= $index ?>" onclick="return confirm('Are you sure?')">Delete</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<br><br>

<h3><?= $edit_user ? 'Edit User' : 'Add User' ?></h3>

<form method="post" action="<?= $edit_user ? 'edit.php' : 'add.php' ?>">
    <label>Name:</label>
    <input type="text" name="name" required value="<?= $edit_user ? htmlspecialchars($edit_user[0]) : '' ?>"><br><br>

    <label>Email:</label>
    <input type="email" name="email" required value="<?= $edit_user ? htmlspecialchars($edit_user[1]) : '' ?>"><br><br>

    <?php if($edit_user): ?>
        <input type="hidden" name="edit_index" value="<?= $edit_index ?>">
        <button type="submit">Update</button>
        <a href="index.php"><button type="button">Back</button></a>
    <?php else: ?>
        <button type="submit">Add</button>
    <?php endif; ?>
</form>

</body>
</html>