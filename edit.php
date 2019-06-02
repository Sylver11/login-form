<?php
session_start();
require_once "conn.php";


$database = new Connection();
$db = $database->open();

$editnum =trim($_POST["editnum"]);
$edit = trim($_POST["edit"]);
$param_username=$_SESSION["username"];
$param_edit = $edit;
$param_editnum=$editnum;


$sql = "UPDATE list SET items = '$param_edit' WHERE item_id = '$param_editnum' AND username='$param_username'";
$db->exec($sql); 


?>