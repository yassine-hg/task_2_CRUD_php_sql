<?php
    include "db.php";  

    $db = connect();  

    if(!$db){
        echo "Connection failed";
    } else {  
        $query = []; 
        if(isset($_GET['id'])){
            $id = $_GET['id'];

            $queryfetch = $db->prepare('SELECT * FROM task_tb WHERE id = :id');
            $queryfetch->execute([":id" => $id]);
            $query = $queryfetch->fetch(PDO::FETCH_ASSOC);

            if(!$query){
                echo "Error fetching data";
                $query = [];  
            }
        } else {
            echo "No id provided";
        }

        if($_SERVER["REQUEST_METHOD"] === "POST"){
            $title = $_POST["title"];
            $description = $_POST["description"];
            $priority = $_POST["priority"];
            $deadline = $_POST["deadline"];

            if(!empty($title) && !empty($description) && !empty($priority) && !empty($deadline)){
                $updatequery = $db->prepare('UPDATE task_tb SET title = :title, description = :description, priority = :priority, deadline = :deadline WHERE id = :id');
                $updatequery->execute([
                    ":title" => $title,
                    ":description" => $description,
                    ":priority" => $priority,
                    ":deadline" => $deadline,
                    ":id" => $id
                ]);

                if($updatequery){
                    header('Location: read.php');
                    exit;
                } else {
                    echo "Error updating data";
                }
            } else {
                echo "Fill all the information";
            }
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="update.css">
    <title>Update Task</title>
</head>
<body>
    <form method="post">
        <h4>Update the Title</h4>
        <input type="text" name="title" value="<?php echo isset($query['title']) ? $query['title'] : ''; ?>">

        <h4>Update Description</h4>
        <input type="text" name="description" value="<?php echo isset($query['description']) ? $query['description'] : ''; ?>">

        <h4>Update Priority</h4>
        <select name="priority">
            <option value="high" <?php echo (isset($query['priority']) && $query['priority'] == 'high') ? 'selected' : ''; ?>>High</option>
            <option value="medium" <?php echo (isset($query['priority']) && $query['priority'] == 'medium') ? 'selected' : ''; ?>>Medium</option>
            <option value="low" <?php echo (isset($query['priority']) && $query['priority'] == 'low') ? 'selected' : ''; ?>>Low</option>
        </select>

        <h4>Update the Deadline</h4>
        <input type="date" name="deadline" value="<?php echo isset($query['deadline']) ? $query['deadline'] : ''; ?>">

        <input type="submit" value="Update">
        
    </form>
</body>
</html>
