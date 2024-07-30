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


    <div class="container">

    <div class="box">
    <?php errorhand('error') ?>
    <form method="post" action="/group">
        <input type="text" name="groupName" placeholder="Nazwa grupy"><br>
        <br>
        <input type="text" name="groupDescription" placeholder="Opis..."required><br>
        <br>
        <input type="text" name="file_path" placeholder="Załącznik"required><br>
        <br>
        <button type="submit" name="submit">Dodaj</button>
    </form>
    <div id="editForm" style="display:none;">
        <h2>Edytuj grupe</h2>
        <form action="/group-edit" method="post">
            <input type="hidden" id="edit_id" name="id">
            <label for="edit_name">Nazwa:</label>
            <input type="text" id="edit_name" name="groupName">
            <br>
            <label for="edit_description">Opis..:</label>
            <input type="text" id="edit_description" name="groupDescription">
            <br>
            <label for="edit_file_path">Załącznik:</label>
            <input type="text" id="edit_file_path" name="file_path">
            <br>
            Dodaj pracownika:
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
            <br>
            <button type="submit">Zapisz</button>
        </form>
    </div>



    </div>
    <br>

    <div class="box">
        <?php if(!empty($elements['GroupShow'])) : ?>
        <?php foreach ($elements['GroupShow'] as $group): ?>
        <div style="border: solid black 1px;">
            <p><?php echo $group['id_group']; ?></p>
            <p><?php echo $group['name_group']; ?></p>
            <p><?php echo $group['description']; ?></p>
            <p><?php echo $group['file_path']; ?></p>
            <p>
                <form action="/group-del" method="post" style="display:inline;">
                    <input type="hidden" name="id" value="<?php echo $group['id_group']; ?>">
                    <button type="submit">Usuń</button>
                </form>
                <button onclick="editGroup(
                '<?php echo $group['id_group'];?>',
                '<?php echo $group['name_group'];?>',
                '<?php echo $group['description'];?>',
                '<?php echo $group['file_path'];?>'
                )">Edytuj</button>
            </p>
        </div>
        <?php endforeach; ?>
        <?php endif; ?>
        </div>
    </div>
</body>
</html>