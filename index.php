<?php
include 'functions.php';

if (isset($_GET['delete'])) {
    $delete_index = (int)$_GET['delete'];
    deleteUser($file, $delete_index);
    header("Location: index.php");
    exit;
}

$users = getUsers($file);
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
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
        <th>actions</th>
    </tr>
    <?php if (empty($users)): ?>
        <tr><td colspan="3">no users found.</td></tr>
    <?php else: ?>
        <?php foreach ($users as $index => $user): ?>
        <tr>
            <td><?= htmlspecialchars($user[0]) ?></td>
            <td><?= htmlspecialchars($user[1]) ?></td>
            <td>
                <a href="edit.php?edit=<?= $index ?>">edit</a> |
                <a href="?delete=<?= $index ?>" onclick="return confirm('are you sure?')">delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    <?php endif; ?>
</table>
<br><br>
<a href="add.php"><button>add new user</button></a>
</body>
</html>