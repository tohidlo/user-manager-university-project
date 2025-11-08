<?php
include 'functions.php';

$users = getUsers($pdo);
$edit_id = null;
$edit_user = null;
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $editId = (int)($_POST['edit_id'] ?? -1);
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    if (!empty($name) && !empty($email) && $editId > 0) {
        if ($pdo === null) {
            $message = 'database connection failed. check functions.php.';
        } else {
            try {
                editUser($pdo, $editId, $name, $email);  // $pdo نه $file
                header("Location: index.php");
                exit;
            } catch (PDOException $e) {
                $message = 'error updating user: ' . $e->getMessage();
            }
        }
    } else {
        $message = 'please enter name and email.';
    }
} elseif (isset($_GET['edit'])) {
    $edit_id = (int)$_GET['edit'];
    if ($pdo === null) {
        die("database connection failed.");
    }
    $stmt = $pdo->prepare("SELECT name, email FROM users WHERE id = ?");
    $stmt->execute([$edit_id]);
    $edit_user = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$edit_user) {
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
    <input type="text" name="name" required value="<?= htmlspecialchars($edit_user['name'] ?? '') ?>"><br><br>
    <label>email:</label><br>
    <input type="email" name="email" required value="<?= htmlspecialchars($edit_user['email'] ?? '') ?>"><br><br>
    <input type="hidden" name="edit_id" value="<?= $edit_id ?>">
    <button type="submit">update</button>
    <a href="index.php"><button type="button">back</button></a>
</form>
</body>
</html>