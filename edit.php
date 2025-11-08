<?php
include 'functions.php';

$users = getUsers($file);
$edit_index = null;
$edit_user = null;
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $editIndex = (int)($_POST['edit_index'] ?? -1);
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    if (!empty($name) && !empty($email) && $editIndex >= 0) {
        editUser($file, $editIndex, $name, $email);
        header("Location: index.php");
        exit;
    } else {
        $message = 'please enter name and email.';
    }
} elseif (isset($_GET['edit'])) {
    $edit_index = (int)$_GET['edit'];
    if (isset($users[$edit_index])) {
        $edit_user = $users[$edit_index];
    } else {
        die("user not found.");
    }
} else {
    die("no user specified for editing.");
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <title>edit user</title>
    <style>body { font-family: Arial; margin: 20px; }</style>
</head>
<body>
<h3>edit user</h3>
<?php if ($message): ?>
    <p style="color: red;"><?= $message ?></p>
<?php endif; ?>
<form method="post">
    <label>name:</label><br>
    <input type="text" name="name" required value="<?= htmlspecialchars($edit_user[0] ?? '') ?>"><br><br>
    <label>email:</label><br>
    <input type="email" name="email" required value="<?= htmlspecialchars($edit_user[1] ?? '') ?>"><br><br>
    <input type="hidden" name="edit_index" value="<?= $edit_index ?>">
    <button type="submit">update</button>
    <a href="index.php"><button type="button">back</button></a>
</form>
</body>
</html>