<?php
session_start();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Todo list</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<nav class="navbar"><p href="">Home</p><p>About</p><p>Me</p></nav>

<form>
    <input id="newentry" type="text" name="newentry">
    <button class="button" type="submit">Add</button>  
</form>

<form action="todo.php" method="POST">
    <input type="button" value="Logout" name="logout">
</form>


<div id="inputId"></div>




<?php
require_once "conn.php";
$tempNum = 0;
$param_username = "justus";
$sql = "SELECT * FROM list WHERE username='$param_username'";
$result = mysqli_query($conn, $sql);
echo "<ul>";
while(($row['items'] = mysqli_fetch_assoc($result)) && ($row['id'] = mysqli_fetch_assoc($result))){ 
    foreach($row as $value) {
            echo "<li>" . $value["items"] . "</li>";
            $list_id_count = $value["id"];
            $sql_list_id = "UPDATE list SET item_id='$tempNum' WHERE id='$list_id_count'";
            if(mysqli_query($conn, $sql_list_id)){
                $tempNum++ ;
            }
    }
};
echo "</ul>";
?>







<script>



$(document).ready(function(){
    $("li").wrapInner("<p>").prepend("<button class=\"done\">Done</button><button class=\"del\">Delete</button>");
// cleanUp();

function cleanUp(){
    $.ajax({
            type: "POST",
            url: "todo.php",
            success: function(data) {  
                console.log(data); 
                        $( "#inputId" ).val(data); 
            }

    })
}














//  $.ajax({
//             type: "POST",
//             url: "renderStrike.php",
//             async: true,
//             data: {complete: '1'},
//             success: function(strikeArr){
//                 console.log(strikeArr);
//                 // console.log(msg);
//                 var obj = JSON.parse(strikeArr);
//                 console.log(obj);
//                 strikeArrLenght = obj.length;
//                 for(i = 0; i < strikeArrLength; i++){
//                     // console.log(msg[i]);
//                     if(msg[i] > 0){
//                         $("li:eq(" + i + ")").find("p").css("text-decoration", "line-throguh ");
//                     }else{
//                         $("li:eq(" + i + ")").find("p").css("text-decoration", "none ");
//                     }
//                 }
//                 // alert(data);
//             }
//         })




    $(".button").click(function(){
        var newEntry = $("#newentry").val();
        $.ajax({
            url: "add.php",
            method:"POST",
            data: "val=" + newEntry,
            dataType: "text",
            success:function(data){
                
                cleanUp();
            },
            error: function(jqxhr, status, exception) {
                alert('Exception:', exception)
            }
        })        
    })


    $(".del").click(function(){
        var checkNum = $(this).parent().index();
        $.ajax({
            type: "POST",
            url: "delete.php",
            data: "delete=" + checkNum,
            dataType: "text",
            success: function(deleteArray){
                var del = JSON.parse(deleteArray);
                console.log(del);
                    if(del[1]  ==1){
                        console.log("this runs");
                        $("li:eq(" + del[0] + ")").addClass("none");
                    }
                }
        })
    })

    $(".done").click(function(){
        var checkNum = $(this).parent().index();//this refers to the two buttons on the rederstrike so if any of the parents are cliced it will give the index of that entry 
        // console.log(checkNum);
        $.ajax({
            type: "POST",
            url: "done.php",
            data: "num=" + checkNum,
            dataType: "text",
            success: function(doneArray){
                var obj = JSON.parse(doneArray);
                console.log(obj);
                strikeArrLength = obj.length;
                // console.log(strikeArrLength);
                // console.log("runs");
                for(i = 0; i < strikeArrLength; i++){
                    // console.log(i);
                    // console.log("loop");
                    if(obj[i] == 1){
                        // console.log("line trough runs runs");
                        $("li:eq(" + i + ")").find("p").css("text-decoration", "line-through");

                    }
                    else{
                        $("li:eq(" + i + ")").find("p").css("text-decoration", "none");
                        // console.log("none runs");

                    }
                }
            }
        })

    })

})

// $("li").on("click,", ".del", function(){

// this parent parant fodOut("fast");
// var checkNum = $(this).parent().paraent().index();
// $.post('delete.php', 'val=' + checkNum);

// })
// // now last thing missing is deleting item ?



// })


// $checkNumA - $_POST('val');



</script>




</body>
</html>