
<?php
session_start();
require_once "conn.php";

$database = new Connection();
$db = $database->open();


// $sql2 ="CREATE TABLE list(
//     id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
//     username VARCHAR(120),
//     items VARCHAR(255),
//     complete int NOT NULL DEFAULT 0,
//     item_id int NOT NULL DEFAULT 0,
//     duedate VARCHAR(60))";
// //passing the query to the established connection 


// $conn->query($sql2);

if(empty(trim($_POST["val"]))){
    $username_err = "Please enter something you need to do.";
    echo $username_err;
} else {
    $stmt = $db->prepare("INSERT INTO list (username, items, duedate) VALUES (:username, :items, :duedate)");
    $stmt->execute(array(':username' => $_SESSION['username'] , ':items' => $_POST['val'] , ':duedate' => $_POST['duedate'])); 
}












?>