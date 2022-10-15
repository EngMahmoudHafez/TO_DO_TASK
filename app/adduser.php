<?php
    require "../db_connection.php";

    if(isset($_POST['username'])){

        $username=$_POST['username'];
        $email=$_POST['email'];
        $phone=$_POST['phone'];
        $age=$_POST['age'];
        $password=$_POST['password'];


        $connection=new db();
        $ret=$connection->regester($username,$age,$phone,$email,$password);
        if($ret){
            header("location:../signin.php");

        }else{
            header("location:../signup.html");

        }

    }