<?php
session_start()
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <title>Document</title>
</head>
<body>
<div class="container">

<h1 style="align-contetn: center;">Welcome to your personal To-Do-List</h1>
<h2>Please login below.</h2>
<form action="login.php" method="post">
<input type="text" name="username" placeholder="Enter Username">
<input type="password" name="password" placeholder="Enter Password">
<input type="submit" name="submit" value="Login">





</form>


<?php
require_once "connection.php";


if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true){
    header("location: todo.php");
    exit;
}
if($_POST){
    if(empty(trim($_POST['username']))){
        $username_err = "Please enter your username";
        echo $username_err;
    }
    elseif(empty(trim($_POST['password']))){
        $password_err ="Please enter your password";
        echo mysqli_error($conn);
    }
    else{
        $username = trim($_POST['username']);
        $password=trim($_POST['password']);
    $sql= "SELECT id, username, password FROM users WHERE username =?";
    if($stmt = $conn->prepare($sql)){
        $stmt->bind_param("s", $param_username);
        $param_username = $username;
        if($stmt->execute()){
            $stmt->store_result();
            if($stmt->num_rows ==1){
                $stmt->bind_result($id, $username, $hashed_password);
                if($stmt->fetch()){
                    if(password_verify($password,$hashed_password)){
                        session_start();
                        $_SESSION["loggedin"] =true;
                        $_SESSION["id"]= $id;
                        $_SESSION["username"] = $username;
                        header("location: todo.php");
                        exit;
                    }
                    else{
                        $password_err="The password you entered is invalid";
                        echo $password_err;
                    }       
                }
            }else{
            echo "Sorry your Username or Password are incorrect.";
            }
        }
    }
}
}
?>
<br>
<br>
<a href="index.php">
<h4>Not registered yet? Click here to register.</h4>
</a>
</div>

</body>
</html>