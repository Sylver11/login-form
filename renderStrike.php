<?php

$sql= "SELECT * FROM list ORDER BY item_id DESC";
$result = mysqli_query($conn, $sql);
$tempNum=0;
if($result->num_rows > 0){

    $strikeArr = array();
    //utput data to
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