
<?php
require_once "conn.php";
if(empty(trim($_POST["val"]))){
    $username_err = "Please enter something you need to do.";
    echo $username_err;
} else {
    $date= trim($_POST["duedate"]);
    $todo = trim($_POST["val"]);
    // $_SESSION['username'];
    $username="justus";
    $sql ="INSERT INTO list (username, items, duedate) VALUES (?,?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $param_username, $param_todo, $param_date);
    $param_date=$date;
    $param_todo=$todo;
    $param_username = "justus";
    // $param_username=$username;
    $stmt->execute();
    // $stmt->close();
}   
?>