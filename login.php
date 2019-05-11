<?php
session_start()
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form action="login.php" method="post">
<input type="text" name="username" placeholder="Enter Username">
<input type="password" name="password" placeholder="Enter Password">
<input type="submit" name="submit" value="Login">




</form>


<?php
require_once "conn.php";

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
        echo $password;
        echo $username;
    }

    $sql= "SELECT id, username, password FROM users WHERE username =?";

    if($stmt = $conn->prepare($sql)){
        // $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $param_username);
        $param_username = $username;
        echo "line 51 is running";
        if($stmt->execute()){
            echo "line 53 running";
            $stmt->store_result();
            if($stmt->num_rows ==1){
                echo"line 56 running";
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
            }
        }
    }
}



?>

</body>
</html>