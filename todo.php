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
    <link rel="stylesheet" type="text/css" href="styles.css">
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

<?php

require_once "conn.php";




// if($_POST){

    // if(empty(trim($_POST['todo']))){
    //     $username_err = "Please enter something you need to do.";
    //     echo $username_err;
    // }    

    // else{
    //     $todo = trim($_POST['todo']);
    //     // $_SESSION['username'];
    //     $username="justus";
    //     $sql ="INSERT INTO list (username, items) VALUES (?,?)";
    //     $stmt = $conn->prepare($sql);
    //     $stmt->bind_param("ss", $param_username, $param_todo);
    //     $param_todo=$todo;
    //     $param_username=$username;
    //     $stmt->execute();
    //     $stmt->close();
    // }   
// }


$param_username = "justus";
// $sql ="SELECT * FROM list WHERE username = '$param_username'";
// $sql_complete ="SELECT * FROM list WHERE username = '$param_todo'";
        // if($stmt = $conn->prepare($sql)){
        //     $stmt->bind_param("s", $param_username);
        // };
        // $stmt->bind_param("s", $param_username);
        // $param_username = trim($_SESSION['username']);
        // $param_username = "justus";
        // $stmt->execute();

    // if(!$result = mysql_query($sql)) 
    // { 
    //    die("Couldn't run query"): 
    // } 
$sql = "SELECT * FROM list WHERE username='$param_username'";

$result = mysqli_query($conn, $sql);

$listIndex = 0;

echo "<ul>";

while(($row['items'] = mysqli_fetch_assoc($result)) && ($row['complete'] = mysqli_fetch_assoc($result))){ 

    foreach($row as $value) {
       
        if($value["complete"] == '0'){
            echo '<li onclick="showUser()" >' . $value["items"] . "</li>";
            $listIndex = $listIndex +1 ;
         
        }
        else{
            echo '<li onclick="showUser()" class="complete">' . $value["items"] . "</li>";
        }
    }
};








    
    

// catch(PDOException $e){
//     alert($e->getMessage);
// }






?>




<script>

//add antoher column that inputs the actual order of the list items of the user 
//add decending and acsedding command so that highest id number is displayed from highest to lowest. All doable in mysql
//<!-- print out everything in php and only start html part with ul and in between put the php --> just the actual submit button stays static
//check out clean up()funtion in js maybe custom function
cleanUp();

function cleanUp(){

$("li").wrapInner("<p>").prepend("<button class=\"del\">Done</button><button>Delete <class=\"done\">");


}
$(document).ready(function(){

// function addEntry(){}
$(".button").click(function(){
    var newEntry = $("#newentry").val();
    

    $.ajax({
        url: "add.php",
        method:"POST",
        data: "val=" + newEntry,
        dataType: "text",

    success:function(data){
        alert(data);
    },
    error: function(jqxhr, status, exception) {
             alert('Exception:', exception);
    }

    })

})
})







// }


// $.ajax({
//     type: "POST",
//     url: 'renderStrike.php',
//     async: true,
//     data: {complete: '1'},
//     success: function(msg){
//         strikeArrLenght = msg.lenght;
//         for(i=0; i< strikeArrLength; i++){
//             console.log(msg[i]);
//             if(msg[i]>0){
//                 $(.panel li:eq(" + i +").find("p").css("text-decoration", "line-throguh "));

//             }else{
//                 $(.panel li:eq(" + i +").find("p").css("text-decoration", "none "))
//             }
//         }
//         alert(data);
//     }
// });


// $("li")on.("click",function(){
// var checkNum = $(this).parent().parent().index();//this refers to the two buttons on the rederstrike so if any of the parents are cliced it will give the index of that entry 
// $.ajax{
//     type: "POST",
//     url: done.php,
//     data: "val=" +checkNum,
//     dataType: "text",
//     success: function(data){
//         if(data > 0){
// $(.panel li:eq(" + i +").find("p").css("text-decoration", "line-through"));
//         }
//         else{
//             $(.panel li:eq(" + i +").find("p").css("text-decoration", "none"))

//         }
//     }
// }
// $("li").on("click,", ".del", function(){

// this parent parant fodOut("fast");
// var checkNum = $(this).parent().paraent().index();
// $.post('delete.php', 'val=' + checkNum);

// })
// // now last thing missing is deleting item ?



// })


// $checkNumA - $_POST('val');


















// function showHint(str) {
//     if (str.length == 0) { 
//         document.getElementById("txtHint").innerHTML = "";
//         return;
//     } else {
//         var xmlhttp = new XMLHttpRequest();
//         xmlhttp.onreadystatechange = function() {
//             if (this.readyState == 4 && this.status == 200) {
//                 document.getElementById("txtHint").innerHTML = this.responseText;
//             }
//         };
//         xmlhttp.open("GET", "todo.php?q=" + str, true);
//         xmlhttp.send();
//     }
// }



// $(document).ready(function(){
//     var numIndex;
//     var numTick = 0;
    // $("li").click(function(){





































    //     function showUser(str){
 
    //     var xmlhttp = new XMLHttpRequest();
    //     xmlhttp.onreadystatechange = function() {
    //         if (this.readyState == 4 && this.status == 200) {
    //             $("li").css("text-decoration", "line-through");
    //             document.getElementById("txtHint").innerHTML = this.responseText;
    //         }
    //         else{console.log('erro: ' xmlhttp.status)}
    //         // $(this).css("text-decoration", "line-through");
    //     }
    //     xmlhttp.open("GET", "todo.php?q=" + str, true);
    //     xmlhttp.send();
    // }


    


</script>















            <!-- // numIndex = $(this).index();
            // if(numTick == 0){
            //     $(this).css("text-decoration", "line-through");
            //     numTick = 1; 
            //     sessionStorage.setItem(numIndex, numTick);
            // }
            // else{
            //     $(this).css("text-decoration", "none");
            //     numTick = 0;
            //     sessionStorage.setItem(numIndex, numTick);
            // } -->




<!-- <script>
    //I was struggling with 
 if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
$(document).ready(function(){
    var numIndex;
    var numTick = 0;
    $("li").click(function(){
            numIndex = $(this).index();
            if(numTick == 0){
                $(this).css("text-decoration", "line-through");
                numTick = 1; 
                sessionStorage.setItem(numIndex, numTick);
            }
            else{
                $(this).css("text-decoration", "none");
                numTick = 0;
                sessionStorage.setItem(numIndex, numTick);
            }
    })
    for(var key in sessionStorage){        
        if(sessionStorage.getItem(key) == 1){
            $('#list-item-' + key).css("text-decoration", "line-through");
        }
    }
        
    
})
</script>   -->
</div>  











<?php

// if($_POST){
//     if($_POST['logout']){
//         session_destroy();
//         header("location: login.php");
//         exit;

// }
// }
?>
</body>
</html>