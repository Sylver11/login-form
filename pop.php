<?php
session_start();
require_once "conn.php";

$param_username = "justus";
$sql = "SELECT * FROM list WHERE username='$param_username' ORDER BY item_id ASC";
// $result=mysqli_query($conn,$sql);
echo "<ul>";
if ($result=mysqli_query($conn,$sql)){
    // echo "this runs";
    while($row = $result->fetch_row()){
        // echo $row;
        echo "<li>" . $row[2] . "</li>";
    }
}
echo "</ul>";

?>
