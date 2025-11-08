<?php
include 'functions.php';

if (isset($_GET['delete'])) {
    $delete_id = (int)$_GET['delete'];
    if ($delete_id > 0 && $pdo !== null) {
        try {
            deleteUser($pdo, $delete_id);
        } catch (PDOException $e) {
            // log
        }
    }
    header("Location: index.php");
    exit;
}

if ($pdo === null) {
    die("database connection failed. check functions.php.");
}

$users = getUsers($pdo);
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
        <?php foreach ($users as $user): ?>
        <tr>
            <td><?= htmlspecialchars($user['name']) ?></td>
            <td><?= htmlspecialchars($user['email']) ?></td>
            <td>
                <a href="edit.php?edit=<?= $user['id'] ?>">edit</a> |
                <a href="?delete=<?= $user['id'] ?>" onclick="return confirm('are you sure?')">delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    <?php endif; ?>
</table>
<br><br>
<a href="add.php"><button>add new user</button></a>
</body>
</html>