
<?php
session_start();
require_once "conn.php";
$checkNumA = $_POST["num"];
$param_username=$_SESSION['username'];
$sql= "SELECT * FROM list WHERE username = '$param_username' AND item_id='$checkNumA'";
$result = mysqli_query($conn, $sql);
$row = $result->fetch_row();
    if($row[3] <= 0){
        $sql = "UPDATE list SET complete ='1' WHERE item_id='$checkNumA'";
    }else{
        $sql = "UPDATE list SET complete ='0' WHERE item_id='$checkNumA'";
    }
mysqli_query($conn, $sql);
$doneArray = array();
$tempNum = 0;
$after_sql= "SELECT * FROM list WHERE username = 'justus' ORDER BY item_id ASC";
$after_result = mysqli_query($conn, $after_sql);
while($row = $after_result->fetch_row()){
    // var_dump($row[3]);
    $doneArray[$tempNum] = $row[3];
    $tempNum++;
}
echo json_encode($doneArray);
?>