<?php
session_start();
require_once "conn.php";
$database = new Connection();
$db = $database->open();
$param_username=$_SESSION['username'];
$sql="SELECT * FROM list WHERE username = '$param_username' ORDER BY item_id ASC";
$tempNum=0;
$strikeArr = array();
foreach ($db->query($sql) as $row) {
    $strikeArr[$tempNum]= $row["complete"];
    $tempNum++;
}
echo json_encode($strikeArr);
exit();


?>