<?php

    include "db.php";
    $db = connect();

    if(!$db){
        echo "Connection failed";
    }
    if(isset($_GET['id'])){
        $id = $_GET["id"];

        $queryfetch = $db->prepare("DELETE FROM task_tb WHERE id= :id");
        $delete = $queryfetch->execute(["id"=>$id]);

        if($delete){
            header('Location: read.php');
            exit;
        }else{
            echo "Error during deletion";
        }
    }else{
        echo "Invalid request";
    }

?>
