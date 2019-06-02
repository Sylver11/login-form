<?php
session_start();
require_once "conn.php";

$database = new Connection();
$db = $database->open();


$param_username = $_SESSION['username'];
$sql = "SELECT * FROM list WHERE username='$param_username' ORDER BY id DESC";
$tempNum = 0;

foreach ($db->query($sql) as $row) {
    $list_id_count = $row['id'];
    $sql_list_id = "UPDATE list SET item_id='$tempNum' WHERE id='$list_id_count'";
    if($db->query($sql_list_id)){
                $tempNum++ ;
    }
}

?>