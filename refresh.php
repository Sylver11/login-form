<?php
require_once "conn.php";
$tempNum = 0;
$param_username = "justus";
$sql = "SELECT * FROM list WHERE username='$param_username' ORDER BY id DESC";
$result = mysqli_query($conn, $sql);
$todoitem = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_free_result($result);
    foreach($todoitem as $value) {
            $list_id_count = $value["id"];
            $sql_list_id = "UPDATE list SET item_id='$tempNum' WHERE id='$list_id_count'";
            if(mysqli_query($conn, $sql_list_id)){
                $tempNum++ ;
            }
    }
?>