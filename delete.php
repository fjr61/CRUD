<?php
include 'connect.php';
if(isset($_GET['deleteid'])){
    $id=$_GET['deleteid'];

    $sql="delete from `user_accounts` where id=$id";
    $result=mysqli_query($con, $sql);
    if($result){
        header('location:display.php');
    }else{
          die("Connection failed: " . $con->connect_error);
    }

}


?>