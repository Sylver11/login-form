<?php
session_start();
require_once "conn.php";

$database = new Connection();
$db = $database->open();


$param_username = $_SESSION['username'];
$sql = "SELECT * FROM list WHERE username='$param_username' ORDER BY item_id ASC";
echo "<div class='row justify-content-center'><ul>";
        foreach ($db->query($sql) as $row) {
        $datetime1 = new DateTime(date('Y-m-d'));
        $datetime2 = new DateTime($row['duedate']);
        $interval= $datetime1->diff($datetime2);
        $daysBooked= $interval->format('%R%a');
        echo "<li style=\"text-decoration: none;\">" . $row['items'] . "<div id=\"duedate\"> Time left: " . $daysBooked . " Days</li>";
    }
echo "</ul></div>";
?>
