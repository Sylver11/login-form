
<?php


require_once "conn.php";

$checkNumA = $_POST["num"];
$sql= "SELECT * FROM list WHERE username = 'justus' AND item_id='$checkNumA'";
$result = mysqli_query($conn, $sql);

// $myJSON = json_encode(array('data' =>

// update row
$row = $result->fetch_row();
    if($row[3] <= 0){
        $sql = "UPDATE list SET complete ='1' WHERE item_id='$checkNumA'";
           

            // $myJSON = json_encode(array('data' => 1));
            // echo 1;
            // unset($sql);
    }else{
        $sql = "UPDATE list SET complete ='0' WHERE item_id='$checkNumA'";
        // echo 0;
        
    }
    mysqli_query($conn, $sql);

// form result json    
$doneArray = array();
$tempNum = 0;

$after_sql= "SELECT * FROM list WHERE username = 'justus'";
$after_result = mysqli_query($conn, $after_sql);
while($row = $after_result->fetch_row()){
    // var_dump($row[3]);
    $doneArray[$tempNum] = $row[3];
    $tempNum++;
}

echo json_encode($doneArray);


// echo($myJSON);

// echo "{";
// for(...) {
//     echo "{inner_data: 'stuff'},"
// }
// echo "}";

// "{
//     {inner_data: 'stuff'},
//     {inner_data: 'stuff'},
// }"

// json_encode()
    ?>