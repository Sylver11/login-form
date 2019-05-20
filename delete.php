<?php

require_once "conn.php";
$checkNumA = $_POST["delete"];
$param_username ="justus";
$sql="DELETE FROM list WHERE item_id = '$checkNumA' AND username ='$param_username'";
$result = mysqli_query($conn, $sql);

?>