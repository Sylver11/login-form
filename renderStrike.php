<?php
require_once "conn.php";
// $sql= "SELECT * FROM list ORDER BY item_id DESC";
$sql="SELECT * FROM list WHERE username = 'justus'";
$result = mysqli_query($conn, $sql);
$tempNum=0;
if($result->num_rows > 0){
    $strikeArr = array();
    while($row = $result -> fetch_assoc()){
        $strikeArr[$tempNum]= $row["complete"];
        $tempNum++;
    }
        echo json_encode($strikeArr);
        exit();
}else{
    echo "0 reuslts";
}
?>