<?php
require_once "conn.php";
$tempNum = 0;
$param_username = "justus";
$sql = "SELECT * FROM list WHERE username='$param_username'";
$result = mysqli_query($conn, $sql);
echo "<ul>";
while(($row['items'] = mysqli_fetch_assoc($result)) && ($row['id'] = mysqli_fetch_assoc($result))){ 
    foreach($row as $value) {
            echo "<li class=\"panel\">" . $value["items"] . "</li>";
            $list_id_count = $value["id"];
            $sql_list_id = "UPDATE list SET item_id='$tempNum' WHERE id='$list_id_count'";
            if(mysqli_query($conn, $sql_list_id)){
                $tempNum++ ;
            }
    }
};
echo "</ul>";
?>