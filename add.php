
<?php
require_once "conn.php";


$newentry=$_POST["val"];

    if(empty(trim($_POST["val"]))){
            $username_err = "Please enter something you need to do.";
            echo $username_err;
        }    

        else{
            $todo = trim($_POST["val"]);
            // $_SESSION['username'];
            $username="justus";
            $sql ="INSERT INTO list (username, items) VALUES (?,?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $param_username, $param_todo);
            $param_todo=$todo;
            $param_username = "justus";
            // $param_id = 1;
            // $param_username=$username;
            $stmt->execute();
            $stmt->close();
        }   









?>