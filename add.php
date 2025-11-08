<?php
include 'functions.php';

$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    if (!empty($name) && !empty($email)) {
        if ($pdo === null) {
            $message = 'database connection failed. check functions.php.';
        } else {
            try {
                addUser($pdo, $name, $email);
                header("Location: index.php");
                exit;
            } catch (PDOException $e) {
                $message = 'error adding user: ' . $e->getMessage();
            }
        }
    } else {
        $message = 'please enter name and email.';
    }
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <title>add new user</title>
    <style>body { font-family: Arial; margin: 20px; }</style>
</head>
<body>
<h3>add new user</h3>
<?php if ($message): ?>
    <p style="color: red;"><?= $message ?></p>
<?php endif; ?>
<form method="post">
    <label>name:</label><br>
    <input type="text" name="name" required><br><br>
    <label>email:</label><br>
    <input type="email" name="email" required><br><br>
    <button type="submit">add</button>
    <a href="index.php"><button type="button">back</button></a>
</form>
</body>
</html>