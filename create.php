

<?php

    include 'db.php';

    $db = connect();

    if($db){
        if($_SERVER["REQUEST_METHOD"] === "POST"){
            $title = $_POST["title"];
            $description = $_POST["description"];
            $priority = $_POST["priority"];
            $deadline = $_POST["date"];

            if(!empty($title) && !empty($description) && !empty($priority) && !empty($deadline)){
                $querytask = $db->prepare('INSERT INTO task_tb (title, description, priority, deadline) VALUES (:title, :description, :priority, :deadline)');

                if($querytask->execute(["title"=>$title, "description"=>$description, "priority"=>$priority, "deadline"=>$deadline])){
                    header('Location: read.php');
                    exit;
                }else{
                    echo ' error';
                }

            }else{
                echo "Error";
            }
        }
    }else{
        echo "error";
    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="create.css">
</head>
<body>
    <div>
        <form method="POST">
            <h4>Title</h4>
            <input type="text" name="title">
            <h4>Description</h4>
            <input type="text" name="description">
            <h4>Priority</h4>
            <select name="priority">Priority:
                <option value="high">Hight</option>
                <option value="medium">Medium</option>
                <option value="low">Low</option>
            </select><br><br>
            <input type="date" name="date"><br><br>
            <input class="submit" type="submit" value="Create task">
        </form>
    </div>
</body>
</html>

