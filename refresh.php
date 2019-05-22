<?php
session_start();
require_once "conn.php";

$param_username = $_SESSION['username'];
$sql = "SELECT * FROM list WHERE username='$param_username' ORDER BY id DESC";
$result = mysqli_query($conn, $sql);
$tempNum = 0;
if ($result=mysqli_query($conn,$sql)){
    while($row = $result->fetch_row()){
        $list_id_count = $row[0];
        $sql_list_id = "UPDATE list SET item_id='$tempNum' WHERE id='$list_id_count'";
        if(mysqli_query($conn, $sql_list_id)){
                $tempNum++ ;
        }
    }
}
?>