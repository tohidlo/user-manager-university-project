<?php
include 'functions.php';
$users = getUsers($file);
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
            <a href="edit_form.php?edit=<?= $index ?>">Edit</a> | 
            <a href="delete.php?index=<?= $index ?>" onclick="return confirm('Are you sure?')">Delete</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<br><br>

<a href="add_form.php"><button>Add New User</button></a>

</body>
</html>