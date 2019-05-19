<?php


$result = $db_server->query("SELECT * FROM list-item ORDER BY item-id DESC");
$TempNum=0;
if($resullt->num_rows > 0){

$strikeArr = array();
//utput data to
while($row =$result -> fetch_assoc()){

    $strikeArr[$TemNum]=$row["listItemDone"];
    $tempNum++;
}
    echo json_encode($strikeArr);
    exit()
}else{
    echo "0 reuslts";
}

}


?>