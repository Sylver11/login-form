<?php
require_once "conn.php";
$checkNumA = $_POST["delete"];
$param_username ="justus";
$sql="DELETE FROM list WHERE item_id = '$checkNumA' AND username ='$param_username'";
$result = mysqli_query($conn, $sql);



$before_sql = "SELECT * FROM list WHERE username='$param_username' AND item_id ='$checkNumA'";
$before_result = mysqli_query($conn, $before_sql);
$before_row = $before_result->fetch_row();
if($before_row<= 0){
    $deleteArray= array($checkNumA, 1);
}
echo json_encode($deleteArray);


$after_sql = "SELECT * FROM list WHERE username='$param_username'";
$after_result = mysqli_query($conn, $after_sql);
$tempNum=0;
while($row["id"] = mysqli_fetch_assoc($after_result)){ 
    foreach($row as $value) {
            $list_id_count = $value["id"];
            $sql_list_id = "UPDATE list SET item_id='$tempNum' WHERE id='$list_id_count'";
            if(mysqli_query($conn, $sql_list_id)){
                $tempNum++ ;
            }
    }
};

?>