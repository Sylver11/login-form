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
    <label for="">Due Date: 
    <input id="date" type="date" name="duedate">
    </label>
    <button class="button">Add</button>  
</form>
<form action="todo.php" method="POST">
    <input type="button" value="Logout" name="logout">
</form>
<div id="inputId"></div>


<script>
   
cleanUp();
function cleanUp(){
    $.ajax({
            async: true,
            type: "POST",
            url: "pop.php",
            success: function(data) {  
                $( "#inputId" ).html(data); 
                $("li").wrapInner("<p>").prepend("<button class=\"done\">Done</button><button class=\"del\">Delete</button>");
            }
    })
}
$(document).ready(function(){
    $.ajax({
        type: "POST",
        url: "renderStrike.php",
        async: true,
        data: {complete: '1'},
        success: function(strikeArr){
            console.log(strikeArr);
            var obj = JSON.parse(strikeArr);
            strikeArrLength = obj.length;
            for(i = 0; i < strikeArrLength; i++){
                if(obj[i] == 1){
                    $("li:eq(" + i + ")").find("p").css("text-decoration", "line-through");
                }else{
                    $("li:eq(" + i + ")").find("p").css("text-decoration", "none ");
                }
            }
        }
    })
    $(".button").click(function(event){
        event.preventDefault();
        var newEntry = $("#newentry").val();
        var date = $("#date").val();
        $.ajax({
            url: "add.php",
            async: true,
            method:"POST",
            dataType: "text",
            data: {
                duedate: date,
                val: newEntry
            },
            success:function(data){
                cleanUp();
            },
        })        
    })
    $(".del").click(function(){
        var checkNum = $(this).parent().index();
        $.ajax({
            async: true,
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
        var checkNum = $(this).parent().index();
        $.ajax({
            async: true,
            type: "POST",
            url: "done.php",
            data: "num=" + checkNum,
            dataType: "text",
            success: function(doneArray){
                var obj = JSON.parse(doneArray);
                console.log(obj);
                strikeArrLength = obj.length;
                for(i = 0; i < strikeArrLength; i++){
                    if(obj[i] == 1){
                        $("li:eq(" + i + ")").find("p").css("text-decoration", "line-through");
                    }
                    else{
                        $("li:eq(" + i + ")").find("p").css("text-decoration", "none");
                    }
                }
            }
        })
    })
})
</script>


</body>
</html>