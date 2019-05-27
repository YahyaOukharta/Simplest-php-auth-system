<?php
include("db.php");

//LOGIN 
if(isset($_POST['login']))
{
    print_r($_POST);
    $username = mysqli_real_escape_string($con,$_POST['username']);
    $pwd = mysqli_real_escape_string($con,$_POST['pwd']);

    $pass = md5($pwd); //md5
    $sql= "SELECT id FROM user WHERE username = '$username' AND password = '$pass'";
    
    $result = mysqli_query($con,$sql);

    if(mysqli_num_rows($result) == 1)
        //credentials match , login succesful 
        echo "connected as ".mysqli_fetch_assoc($result)['id'];
    else 
    {
        ////
        echo "username and/or password invalid :(";
        header('location: ../index.php?err=1');
    }
}

//REGISTRATION
if(isset($_POST['register']))
{
    $min_pwd_len = 3;

    print_r($_POST);
    $username =mysqli_real_escape_string($con,$_POST['username']);
    $pwd1 =mysqli_real_escape_string($con,$_POST['pwd1']);
    $pwd2 =mysqli_real_escape_string($con,$_POST['pwd2']);
    $email =mysqli_real_escape_string($con,$_POST['email']);

    //check if username or email already exist in database 
    $sql = "SELECT id FROM user WHERE username = '$username' OR email = '$email'";
    $result = mysqli_query($con,$sql);
    if(mysqli_num_rows($result) != 0)
        header("location: ../register.php?err=1");
    else{
        //check if passwords match
        if($pwd1 != $pwd2 || strlen($pwd1) < $min_pwd_len)
            header("location: ../register.php?err=2");
        else{
            //add user data to db
            $pwd = md5($pwd1);
            $sql="INSERT INTO user(username,password,email)
                    VALUES ('$username','$pwd','$email')";
            if(mysqli_query($con,$sql))
                echo "Registered succesfully";
            else
                echo "error : ".mysqli_error($con);
        }
    }
}
