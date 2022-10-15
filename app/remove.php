<?php 
if(isset($_POST['id'])){
    require '../db_connection.php';

    $id=$_POST['id'];
    if(empty($id)){
        header("location: ../index.php?mess=error");;
    }else{
        $delettask=new db;

        $addqu=$delettask->deltask($id) ;
        if($addqu){
            echo 1;
        }else{
            echo 0;
        }

    }
}else{
    header("location: ../index.php?mess=error");
}