<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register Admin</title>
</head>
<body>

<h2>Register Admin</h2>

<form method="POST" action="register_admin.php">
    <div>
        <label>Username</label><br>
        <input type="text" name="username" required>
    </div>

    <br>

    <div>
        <label>Password</label><br>
        <input type="password" name="password" required>
    </div>

    <br>

    <button type="submit" name="register">
        Daftarkan Admin
    </button>
</form>

</body>
</html>