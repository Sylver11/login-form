
<?php
session_start();
require_once "conn.php";
$checkNumA = $_POST["num"];
$param_username=$_SESSION['username'];


$database = new Connection();
$db = $database->open();

try{


    $stmt = $db->prepare("SELECT * FROM list WHERE username = '$param_username' AND item_id='$checkNumA'");
    $stmt->execute();
    $row = $stmt->fetch();
            if($row['complete'] <= 0){
                $sql = "UPDATE list SET complete ='1' WHERE item_id='$checkNumA'";
            }else{
                $sql = "UPDATE list SET complete ='0' WHERE item_id='$checkNumA'";
            }
        $db->exec($sql);
        $doneArray = array();
        $tempNum = 0;

        $after_sql = "SELECT * FROM list WHERE username = 'justus' ORDER BY item_id ASC";
        foreach ($db->query($after_sql) as $row) {
                $doneArray[$tempNum] = $row['complete'];
                $tempNum++;
            }
    }

catch(PDOException $e){
		$doneArray['message'] = $e->getMessage();

}

echo json_encode($doneArray);
?>