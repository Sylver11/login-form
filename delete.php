<?php
session_start();
require_once "conn.php";
$checkNumA = $_POST["delete"];
$param_username =$_SESSION['username'];
$sql="DELETE FROM list WHERE item_id = '$checkNumA' AND username ='$param_username'";
$result = mysqli_query($conn, $sql);

$before_sql = "SELECT * FROM list WHERE username='$param_username' AND item_id ='$checkNumA'";
$before_result = mysqli_query($conn, $before_sql);
$before_row = $before_result->fetch_row();
if($before_row<= 0){
    $deleteArray= array($checkNumA, 1);
}
echo json_encode($deleteArray);

?>