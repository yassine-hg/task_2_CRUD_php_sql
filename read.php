<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="read.css">
    <title>Document</title>
</head>
<body>
    
<?php
    include "db.php";

    $db = connect();

    if(!$db){
        echo 'connection failed';
    }

    if($db){
        $query = $db->query('SELECT * FROM task_tb');
        $queryfetch = $query->fetchAll(PDO::FETCH_ASSOC);

        if($queryfetch){
            echo "<table border='3'>";
            echo "<th>id</th><th>Title</th><th>Description</th><th>Priority<th>Date</th><th>Current Date</th>";

            foreach($queryfetch as $po){
                echo '<tr>';
                echo '<td>' . $po['id'] . '</td>';
                echo '<td>' . $po['title'] . '</td>';
                echo '<td>' . $po['description'] . '</td>';
                echo '<td>' . $po['priority'] . '</td>';
                echo '<td>' . $po['deadline'] . '</td>';
                echo '<td>' . $po['date'] . '</td>';
                echo "<td><a href='update.php?id=" . $po['id'] . "'>Edit</a></td>";
                echo "<td><a href='delete.php?id=" . $po['id'] . "'>Delete</a></td>";
                echo '</tr>';
            }
            echo '</table>';
        }else{
            echo 'Error';
        }
    }else{
        echo "Error with the database";
    }

?>
<form action="create.php">
    <button type="submit" >Create</button>
</form>
</body>
</html>