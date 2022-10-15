<?php
$id=$_POST['user_id'];
if(isset($_POST['title'])){
    require '../db_connection.php';

    $title=$_POST['title'];
    $id=$_POST['user_id'];
    $start=$_POST['start_date'];
    $end=$_POST['end_date'];

    if(empty($title)){      //check if task title is empty

        header("location: ../index.php?mess=error&id=$id");
    }else{

        $addtask=new db;
        $addquery=$addtask->addtask($title,$id,$start,$end);

        if($addquery){
            header("location: ../index.php?mess=success&id=$id");
        }else{
            header("location: ../index.php?id=$id");
        }

    }
}else{
    header("location: ../index.php?mess=error&id=$id");
}