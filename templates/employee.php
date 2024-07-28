<?php
require_once './core/tools/errorhan.php';

?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CheckTask</title>
    <script>
        function editEmployee(id, name, last_name, job_position, pesel, phone, email) {
            document.getElementById('edit_id').value = id;
            document.getElementById('edit_name').value = name;
            document.getElementById('edit_last_name').value = last_name;
            document.getElementById('edit_job_position').value = job_position;
            document.getElementById('edit_pesel').value = pesel;
            document.getElementById('edit_phone').value = phone;
            document.getElementById('edit_email').value = email;
            document.getElementById('editForm').style.display = 'block';
        }
    </script>
</head>
<body>
    <h1>Register</h1>

    <?php errorhand('error') ?>

    <form method="post" action="/employee-now">
        <input type="text" name="firsName" placeholder="First name"><br>
        <br>
        <input type="text" name="lastName" placeholder="Last name"required><br>
        <br>
        <input type="text" name="jobPosition" placeholder="Job Position"required><br>
        <br>
        <select name="employeeGroup" id="employeeGroup">
        <?php foreach ($elements['GroupShow'] as $Group): ?>
            <option value="<?php echo $Group['id_group']; ?>">
                <?php echo $Group['name_group']; ?>
            </option>   
        <?php endforeach; ?>
            <option value="BRAK" selected>
                NULL
            </option>  
        </select>
        <br>
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
    <br>

    <div>
        <?php if(!empty($elements['EmployeeShow'])) : ?>
        <?php foreach ($elements['EmployeeShow'] as $user): ?>
        <div>
            <p><?php echo $user['name'] . " " . $user['last_name'] ?></p>
            <p><?php echo $user['job_position']; ?></p>
            <p><?php echo $user['previous_login']; ?></p>
            <p><?php echo $user['email']; ?></p>
            <p><?php echo $user['phone']; ?></p>
            <p><?php echo $user['name_group']; ?></p>
            <p>
                <form action="/employee-del" method="post" style="display:inline;">
                    <input type="hidden" name="id" value="<?php echo $user['id_employee']; ?>">
                    <button type="submit">Delete</button>
                </form>
                <button onclick="editEmployee(
                '<?php echo $user['id_employee'];?>',
                '<?php echo $user['name'];?>',
                '<?php echo $user['last_name'];?>',
                '<?php echo $user['job_position'];?>',
                '<?php echo $user['pesel'];?>',
                '<?php echo $user['phone'];?>',
                '<?php echo $user['email'];?>'
                )">Edit</button>
            </p>
        </div>
        <?php endforeach; ?>
        <?php endif; ?>
    <div>
    <div id="editForm" style="display:none;">
        <h2>Edytuj notatke</h2>
        <form action="/employee-del" method="post">
            <input type="hidden" id="edit_id" name="id">
            <label for="edit_name">Name:</label>
            <input type="text" id="edit_name" name="firsName">
            <br>
            <label for="edit_last_name">Last Name:</label>
            <input type="text" id="edit_last_name" name="lastName">
            <br>
            <label for="edit_job_position">Job Position:</label>
            <input type="text" id="edit_job_position" name="jobPosition">
            <br>
            <label for="edit_pesel">PESEL:</label>
            <input type="text" id="edit_pesel" name="PESEL">
            <br>
            <label for="edit_phone">Phone:</label>
            <input type="text" id="edit_phone" name="phone">
            <br>
            <label for="edit_email">email:</label>
            <input type="text" id="edit_email" name="usersEmail">
            <br>
            <label for="edit_name">Password:</label>
            <input type="text" id="edit_name" name="usersPwd">
            <br>
            <label for="edit_ontent">Picture:</label>
            <input type="text" id="edit_content" name="content">

            <button type="submit">Save Changes</button>
        </form>
    </div>

</body>
</html>