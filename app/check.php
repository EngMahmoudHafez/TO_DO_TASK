<?php
/////////////////////////////////////////////
/////////////////////////////////////////////
/////this page for check task done or no ////
/////////////////////////////////////////////
/////////////////////////////////////////////
if(isset($_POST['id'])){

    require '../db_connection.php';

    $id=$_POST['id'];
    if(empty($id)){
        echo "error";
    }else{

        $res= new db;
        $res->updatecheck($id);


    }
}else{
    header("location: ../index.php?mess=error");
}