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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="styles.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    
</head>
<body style="overflow-x: hidden">
<main>
    <div class="container">

<nav class="navbar"><p href="">Welcome <?php echo $_SESSION['username']?></p><form action="todo.php" method="POST">
    <input type="submit" value="Logout" name="logout">
</form></nav>
<div style="height: 140px;"><img style="width: 100%; height:130px;"src="todo-pic" alt="busy"></div>

<div>

<form>
    <div class="form-group">
        <label for="newentry">I still need to:</label>
        <input class="newentry form-control" type="text" name="newentry">
    </div>
    <div class="form-group">
    <label for="date">Due Date: 
    <input class="date form-control" type="date" name="duedate">
    </label>
    <button class="button_2">Add</button> 
    </div>
     
</form>

<div class="inputId"></div>

    </div>

    </main>


<?php
if($_POST){
if($_POST["logout"]){
    session_destroy();
    header("location: login.php");
                exit;
}
}
if(!isset($_SESSION['username'])){
    header("location: login.php");
                exit;
}
?>


<script>
cleanUp();
function cleanUp(){
    $.ajax({
        async: true,
        type: "POST",
        url: "pop.php",
        success: function(data) { 
            console.log(data); 
            $( ".inputId" ).html(data); 
            $("li").wrapInner("<p>").append("<button class=\"done\">Done</button><button class=\"del\">Delete</button><button class=\"edit\">Edit</button><br><br><div class=\"update\"><input class=\"update-item\" type=\"text\"><button class=\"update-button\">Update</button></div><br>");
            renderStrike();
        }
    })
}
refresh();
function refresh(){
    $.ajax({
        async: true,
        type: "POST",
        url: "refresh.php",
    })
}
function renderStrike(){
    $.ajax({
        type: "POST",
        url: "renderStrike.php",
        async: true,
        data: {complete: '1'},
        success: function(strikeArr){
            console.log(strikeArr);
            var obj = JSON.parse(strikeArr);
            console.log(obj);
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
}
$(document).ready(function(){
    $(".edit").click(function(event){
        event.preventDefault();
        $(this).parents("li").find(".update").css("display", "block");
    })
    $(".button_2").click(function(event){
        event.preventDefault();
        var newEntry = $(".newentry").val();
        var date = $(".date").val();
        $(this).closest('form').find("input[type=text], textarea").val("");
        $(this).closest('form').find("input[type=date], textarea").val("");
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
                refresh();
                cleanUp();
            },
        })        
    })
    $(document).on('click','.del',function(){
        var checkNum = $(this).parent().index();
        $(this).parent().addClass("none");
        refresh();
        $.ajax({
            async: true,
            type: "POST",
            url: "delete.php",
            data: "delete=" + checkNum,
            dataType: "text"
        })
    })
    $(document).on('click','.done',function(){
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
                cleanUp();
            }
        })
    })
    $(document).on('click','.update-button',function(){
        var editnum = $(this).parent().parent().index();
        var edit = $(".update-item").val();
        $.ajax({
            async: true,
            type: "POST",
            url: "edit.php",
            data: {
                edit: edit,
                editnum: editnum
            },
            dataType: "text",
            success: function(){
                cleanUp();
            }
        })
        $(".update").css("display", "none");
    })
})
</script>



</body>
</html>