<?php
require_once './core/tools/errorhan.php';

?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CheckTask</title>
</head>
<body>
    <h1>Login</h1>

    <?php errorhand('error') ?>

    <form method="post" action="/login-now">
        <input type="text" name="email" placeholder="Email" required>
        <input type="password" name="pwd" placeholder="Password" required>
        <button type="submit" name="submit">Login</button>
    </form>
</body>
</html>