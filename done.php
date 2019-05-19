
<?php
$checkNumA =$_POST["val"];
select lstutemdone from list items where listud='checkNumA'");
$row -result->fetch_row;
if($row[0]==0){
    $sql = udate list items set listeimtemdone='1' where listid='$checkNuma'";

    if($db_server->query($sql)){
        unset($sql);
        echo 1;


    }else{
        $sql = udate list items set listeimtemdone='0' where listid='$checkNuma'";
        echo 0;
        echo "error: "
    }
