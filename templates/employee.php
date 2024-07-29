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
        function editEmployee(id, name, last_name, job_position, pesel, phone, email, group) {
            document.getElementById('edit_id').value = id;
            document.getElementById('edit_name').value = name;
            document.getElementById('edit_last_name').value = last_name;
            document.getElementById('edit_job_position').value = job_position;
            document.getElementById('edit_pesel').value = pesel;
            document.getElementById('edit_phone').value = phone;
            document.getElementById('edit_email').value = email;
            document.getElementById('edit_group').value = group;
            document.getElementById('editForm').style.display = 'block';
        }

        function editEmployeeUngroup(id, name, last_name, job_position, pesel, phone, email) {
            document.getElementById('2edit_id').value = id;
            document.getElementById('2edit_name').value = name;
            document.getElementById('2edit_last_name').value = last_name;
            document.getElementById('2edit_job_position').value = job_position;
            document.getElementById('2edit_pesel').value = pesel;
            document.getElementById('2edit_phone').value = phone;
            document.getElementById('2edit_email').value = email;
            document.getElementById('2editForm').style.display = 'block';
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
        <?php if(!empty($elements['EmployeeShowAll'])) : ?>
        <?php foreach ($elements['EmployeeShowAll'] as $user2): ?>
        <div>
            <p><?php echo $user2['name'] . " " . $user2['last_name'] ?></p>
            <p><?php echo $user2['job_position']; ?></p>
            <p><?php echo $user2['previous_login']; ?></p>
            <p><?php echo $user2['email']; ?></p>
            <p><?php echo $user2['phone']; ?></p>
            <p>
                <form action="/employee-del" method="post" style="display:inline;">
                    <input type="hidden" name="id" value="<?php echo $user2['id_employee']; ?>">
                    <button type="submit">Delete</button>
                </form>
                <button onclick="editEmployeeUngroup(
                '<?php echo $user2['id_employee'];?>',
                '<?php echo $user2['name'];?>',
                '<?php echo $user2['last_name'];?>',
                '<?php echo $user2['job_position'];?>',
                '<?php echo $user2['pesel'];?>',
                '<?php echo $user2['phone'];?>',
                '<?php echo $user2['email'];?>'
                )">Edit</button>
            </p>
        </div>
        <?php endforeach; ?>
        <?php endif; ?>
    <div>
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
                '<?php echo $user['email'];?>',
                '<?php echo $user['name_group'];?>'
                )">Edit</button>
            </p>
        </div>
        <?php endforeach; ?>
        <?php endif; ?>
    <div>
    <div id="editForm" style="display:none;">
        <h2>Edytuj pracownika</h2>
        <form action="/employee-edit" method="post">
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
            <label for="edit_group">Grupa:</label>
            <input type="text" id="edit_group" name="employeeGroup">
            Usuń: <input type="checkbox" id="dell_group" value="checked" name="delGroup">
            <br>
            <label for="edit_pwd">Password:</label>
            <input type="text" id="edit_pwd" name="usersPwd">
            <br>
            <label for="edit_photo">Picture:</label>
            <input type="text" id="edit_photo" name="photo">

            <button type="submit">Save Changes</button>
        </form>
    </div>
    
    <div id="2editForm" style="display:none;">
        <h2>Edytuj pracownika</h2>
        <form action="/employee-edit" method="post">
            <input type="hidden" id="2edit_id" name="id">
            <label for="2edit_name">Name:</label>
            <input type="text" id="2edit_name" name="firsName">
            <br>
            <label for="2edit_last_name">Last Name:</label>
            <input type="text" id="2edit_last_name" name="lastName">
            <br>
            <label for="2edit_job_position">Job Position:</label>
            <input type="text" id="2edit_job_position" name="jobPosition">
            <br>
            <label for="2edit_pesel">PESEL:</label>
            <input type="text" id="2edit_pesel" name="PESEL">
            <br>
            <label for="2edit_phone">Phone:</label>
            <input type="text" id="2edit_phone" name="phone">
            <br>
            <label for="2edit_email">email:</label>
            <input type="text" id="2edit_email" name="usersEmail">
            <br>
            <label for="2edit_group">Grupa:</label>
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
            <label for="2edit_pwd">Password:</label>
            <input type="text" id="2edit_pwd" name="usersPwd">
            <br>
            <label for="2edit_photo">Picture:</label>
            <input type="text" id="2edit_photo" name="photo">

            <button type="submit">Save Changes</button>
        </form>
    </div>
</body>
</html>