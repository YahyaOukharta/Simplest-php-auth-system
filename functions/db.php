<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "chat_app";

if($con = mysqli_connect($servername,$username,$password,$dbname))
    echo "succesfully connected";
else
    die("error connecting to db : " . mysqli_connect_error());
