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
        function editGroup(id, name, description, file_path) {
            document.getElementById('edit_id').value = id;
            document.getElementById('edit_name').value = name;
            document.getElementById('edit_description').value = description;
            document.getElementById('edit_file_path').value = file_path;
            document.getElementById('editForm').style.display = 'block';
        }
    </script>
    <style>
       body {
    font-family: Arial, sans-serif;
    }

    .container {
        display: flex;
        justify-content: space-between;
    }

    .box {
        width: 30%;
        padding: 20px;
        margin: 10px;
        background-color: #f0f0f0;
        border: 1px solid #ccc;
        box-shadow: 2px 2px 12px rgba(0, 0, 0, 0.1);
    }
    </style>
</head>
<body>
    <h1>Grupy</h1>

    <?php errorhand('error') ?>

    <form method="post" action="/task">
        <input type="text" name="title" placeholder="Tytuł:"><br>
        <br>
        <input type="text" name="description" placeholder="Opis..."required><br>
        <select id="priority" name="priority">
            <option value="I">I</option>
            <option value="II">II</option>
            <option value="III">III</option>
            <option value="IV">IV</option>
            <option value="V">V</option>
        </select>
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
        <select name="employee" id="employee">
        <?php foreach ($elements['EmployeShow'] as $employee): ?>
            <option value="<?php echo $employee['id_employee']; ?>">
                <?php echo $employee['name'] . " " . $employee['last_name'];  ?>
            </option>   
        <?php endforeach; ?>
            <option value="BRAK" selected>
                NULL
            </option>  
        </select>
        <br>
        Data rozpoczęcia:
        <input type="datetime-local" name="startData" placeholder="Data rozpoczęcia"required><br>
        <br>
        Deadline:
        <input type="datetime-local" name="stopData" placeholder="Deadline"required><br>
        <br>
        <input type="text" name="file_path" placeholder="Załącznik"><br>
        <button type="submit" name="submit">Dodaj</button>
    </form>
    <br>

    <div class="container">
        <div class="box">
            <h3>Nierozpoczęte</h3>
            <?php if(!empty($elements['TaskShowNotStarted'])) : ?>
            <?php foreach ($elements['TaskShowNotStarted'] as $task): ?>
            <div style="border: solid black 1px;">
                <p><?php echo $task['title']; ?></p>
                <p><?php echo $task['description']; ?></p>
                <p><?php echo $task['start_date']; ?></p>
                <p><?php echo $task['stop_date']; ?></p>
                <p><?php echo $task['priority']; ?></p>
                <p><?php echo $task['last_edit']; ?></p>
                <p>
                    <form action="/group-del" method="post" style="display:inline;">
                        <input type="hidden" name="id" value="<?php echo $task['id_task']; ?>">
                        <button type="submit">Delete</button>
                    </form>
                    <button onclick="editGroup(
                    '<?php echo $task['id_task'];?>',
                    '<?php echo $task['title'];?>',
                    '<?php echo $task['description'];?>',
                    '<?php echo $task['priority'];?>',
                    '<?php echo $task['start_date'];?>',
                    '<?php echo $task['stop_date'];?>'
                    )">Edit</button>
                </p>
            </div>
            <?php endforeach; ?>
            <?php endif; ?>
        </div>
        <div class="box">
            <h3>W trakcie</h3>
            <?php if(!empty($elements['TaskShowDuring'])) : ?>
            <?php foreach ($elements['TaskShowDuring'] as $task): ?>
            <div style="border: solid black 1px;">
                <p><?php echo $task['title']; ?></p>
                <p><?php echo $task['description']; ?></p>
                <p><?php echo $task['start_date']; ?></p>
                <p><?php echo $task['stop_date']; ?></p>
                <p><?php echo $task['priority']; ?></p>
                <p><?php echo $task['last_edit']; ?></p>
                <p>
                    <form action="/group-del" method="post" style="display:inline;">
                        <input type="hidden" name="id" value="<?php echo $task['id_task']; ?>">
                        <button type="submit">Delete</button>
                    </form>
                    <button onclick="editGroup(
                    '<?php echo $task['id_task'];?>',
                    '<?php echo $task['title'];?>',
                    '<?php echo $task['description'];?>',
                    '<?php echo $task['priority'];?>',
                    '<?php echo $task['start_date'];?>',
                    '<?php echo $task['stop_date'];?>'
                    )">Edit</button>
                </p>
            </div>
            <?php endforeach; ?>
            <?php endif; ?>
        </div>
        <div class="box">
            <h3>Zakończone</h3>
            <?php if(!empty($elements['TaskShowEnded'])) : ?>
            <?php foreach ($elements['TaskShowEnded'] as $task): ?>
            <div style="border: solid black 1px;">
                <p><?php echo $task['title']; ?></p>
                <p><?php echo $task['description']; ?></p>
                <p><?php echo $task['start_date']; ?></p>
                <p><?php echo $task['stop_date']; ?></p>
                <p><?php echo $task['priority']; ?></p>
                <p><?php echo $task['last_edit']; ?></p>
                <p>
                    <form action="/group-del" method="post" style="display:inline;">
                        <input type="hidden" name="id" value="<?php echo $task['id_task']; ?>">
                        <button type="submit">Delete</button>
                    </form>
                    <button onclick="editGroup(
                    '<?php echo $task['id_task'];?>',
                    '<?php echo $task['title'];?>',
                    '<?php echo $task['description'];?>',
                    '<?php echo $task['priority'];?>',
                    '<?php echo $task['start_date'];?>',
                    '<?php echo $task['stop_date'];?>'
                    )">Edit</button>
                </p>
            </div>
            <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
    <div>
        
    <div>
    <div id="editForm" style="display:none;">
        <h2>Edytuj notatke</h2>
        <form action="/group-edit" method="post">
            <input type="hidden" id="edit_id" name="id">
            <label for="edit_name">Nazwa:</label>
            <input type="text" id="edit_name" name="groupName">
            <br>
            <label for="edit_description">Opis..:</label>
            <input type="text" id="edit_description" name="groupDescription">
            <br>
            <label for="edit_file_path">Picture:</label>
            <select name="employeeGroupEmploye" id="employeeGroupEmploye">
            <?php foreach ($elements['GroupShowEmploye'] as $GroupEmploye): ?>
                <option value="<?php echo $GroupEmploye['id_employee']; ?>">
                    <?php echo $GroupEmploye['name'] . " " . $GroupEmploye['last_name']; ?>
                </option>   
            <?php endforeach; ?>
                <option value="BRAK" selected>
                    NULL
                </option>  
            </select>
            <input type="text" id="edit_file_path" name="file_path">

            <button type="submit">Save Changes</button>
        </form>
    </div>

</body>
</html>