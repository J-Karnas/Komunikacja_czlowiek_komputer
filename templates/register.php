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
    <h1>Register</h1>

    <?php errorhand('error') ?>

    <form method="post" action="/register-now">
        <input type="text" name="firsName" placeholder="First name"><br>
        <br>
        <input type="text" name="lastName" placeholder="Last name"required><br>
        <br>
        <input type="number" name="PESEL" placeholder="PESEL"required><br>
        <br>
        <input type="number" name="phone" placeholder="Numer tel..."required><br>
        <br>
        <input type="text" name="email" placeholder="email"required><br>
        <br>
        <input type="password" name="usersPwd" placeholder="Password..."required><br>
        <br>
        <input type="password" name="pwdRepeat" placeholder="Repeat password" required><br>
        <br>
        <input type="checkbox" name="role" value="manager"> Check if you are a manager<br>
        <br>
        <button type="submit" name="submit">Register</button>
    </form>
</body>
</html>