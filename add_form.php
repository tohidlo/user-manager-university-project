<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add New User</title>
</head>
<body>

<h3>Add New User</h3>

<form method="post" action="add.php">
    <label>Name:</label>
    <input type="text" name="name" required><br><br>

    <label>Email:</label>
    <input type="email" name="email" required><br><br>

    <button type="submit">Add</button>
    <a href="index.php"><button type="button">Back</button></a>
</form>

</body>
</html>