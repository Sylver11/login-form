<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<form action="index.php" method="post">  
<input type="text" name="username" placeholder="Enter your username">
<input type="password" name="password" placeholder="enter passwoord">
<input type="password" name="password-confirm" placeholder="confirm password">
<button name="submit">Register</button>



</form>

<a href="login.php">
<h4>Already registered? Click here to login</h4>
</a>



<?php
require_once "conn.php";

// if(!isset($_POST)){
if($_POST){
    // echo trim($_POST['username']);
    // if(!isset($_POST)){
    if(empty(trim($_POST['username']))){
        $username_err = "Please enter a username";
        echo $username_err;
    }
    else{
        $sql ="SELECT * FROM users WHERE username = ?";
            if($stmt = $conn->prepare($sql)){
                $stmt->bind_param("s", $param_username);
            }
        // $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $param_username);
        $param_username = trim($_POST['username']);
        // echo "bind thing running";
        
    
        // echo mysqli_error($conn);
        //sanitane param username here 
        //set parameter
        // $param_username = trim($_POST['username']);
        if ($stmt->execute()){
            $stmt->store_result();
                // echo "if statement on line 52 runs";
            if($stmt->num_rows ==1){
                $username_err = "this username is alredy taken";
                echo $username_err;
            }
            else{
                $username = trim($_POST['username']);
                // echo "username is being defined";
            }
        }
        else{
            echo "Oops! someting went wrong. Please try again later";
        }
        echo mysqli_error($conn);
        $stmt->close();
    }







    //validate password
    if(empty(trim($_POST['password']))){
        $password_err ="please enter password";
        echo mysqli_error($conn);
    }
    elseif(strlen(trim($_POST['password'])) <= 6){
        echo "your password is too short";
        echo mysqli_error($conn);
    }
    else{
        $password=trim($_POST['password']);
        echo mysqli_error($conn);
        echo "First Password was not empty and was not too short";
    }





    //second password validation 
    if(empty(trim($_POST['password-confirm']))){
        $confirm_password_err="Please enter second password";
        echo $confirm_password_err;
    }
    else{
        $confirm_password = trim($_POST['password-confirm']);
            if(empty($password_err) && ($password != $confirm_password)){
                $confirm_password_err = "Passwords did not match";
                echo $confirm_password_err;
            }
        }



    //check input before inseritng in database 
    if(empty(($username_err) && ($password_err) && ($confirm_password_err))){ //and so on
        $sql ="INSERT INTO users (username, password) VALUES(?,?)";
        if($stmt = $conn->prepare($sql)){
            $stmt ->bind_param("ss", $param_username, $param_password);
            $param_username =$username;
            $param_password =password_hash($password, PASSWORD_DEFAULT);
            if($stmt->execute()){
                header("location: login.php");
                exit;
            }
        }else{
            echo"Sorry, something went went wrong. Please try again later.";
        }
    }
    $stmt->close();
    $mysqli->close();
}


?>

    
</body>
</html>