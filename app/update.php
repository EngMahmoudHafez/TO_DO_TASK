<?php
require '../db_connection.php';

if(isset( $_GET['id'])){
    $taskid=$_GET['id'];
} else if(isset( $_POST['id'])){
    $taskid=$_POST['id'];
}

$connection=new db;
$todos=$connection->gettask($taskid);


if(isset( $_POST['title'])&&$_POST['title']!=$todos['text']){

    $text=$_POST['title'];
    $taskid=$_POST['id'];
    $start = date("Y-m-d H:i:s", strtotime($_POST['start_date']));
    $end = date("Y-m-d H:i:s", strtotime($_POST['end_date']));

    $update=$connection->updatetask($taskid,$text,$start,$end);

    if($update){

        header("LOCATION:../index.php?id=".$_SESSION['user']['id']);
    }else{
        echo"dsd";
    }

    }else{
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/style.css">
        <title>ToDoList</title>

    </head>

    <body>
        <div class="two">
            <h1> EDIT TASk  </h1>
            <div>
                <div ><a href="../index.php?id=<?=$_SESSION['user']['id']?>">Back</a> </div>
                <div ><a href="../users.php">Users</a> </div>
                <div class="logout"><a href="../logout.php">Logout</a> </div>
            </div>
        </div>
        <div class="main-section">
            <div class="add-section">
                                <!-- form to upadte todolist -->
                <form action="update.php" method="POST" autocomplete="off">

                        <input type="text" name="title" value="<?= $todos['text']?>" />
                        <input type="hidden" name="id" value="<?= $todos['id']?>"  >
                        <div>Start date</div> <input type="datetime-local" value="<?=$todos['start_date']?>" name="start_date" >
                        <div >End date</div> <input type="datetime-local" value="<?= $todos['end_date']?>" name="end_date" >
                        <?php if ($_POST['title']==$todos['text']){?>
                            <div style="color: red;text-align: center;padding: 2px">change and data !!   </div>
                        <?php }?>
                        <button type="submit">Update </button>

                </form>
            </div>
        </div>
    </body>
    </html>
<?php
}?>