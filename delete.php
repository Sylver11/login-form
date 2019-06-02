<?php
session_start();
require_once "conn.php";


$database = new Connection();
$db = $database->open(); 

$checkNumA = $_POST["delete"];
$param_username =$_SESSION['username'];
$sql="DELETE FROM list WHERE item_id = '$checkNumA' AND username ='$param_username'";
$db->exec($sql);

?>