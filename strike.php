<?php
require_once "conn.php";
$doneArray = array();
$tempNum = 0;
$after_sql= "SELECT * FROM list WHERE username = 'justus'";
$after_result = mysqli_query($conn, $after_sql);
while($row = $after_result->fetch_row()){
    // var_dump($row[3]);
    $doneArray[$tempNum] = $row[3];
    $tempNum++;
}
echo json_encode($strikeArray);

?>