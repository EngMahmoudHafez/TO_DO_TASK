<?php 
require 'db_connection.php';
if(empty($_SESSION['user'])){

    header("LOCATION:signin.php");

}

$userid=$_GET['id'];
$connection=new db;

$todos=$connection->gettasks($userid);
$dataa=$connection->users();
$data=[];


foreach ($dataa as $v =>$dataf) {   //get the userdata who log in
    if ($dataf['id'] == $userid) {
        $data = $dataf;

    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/b98cd7bd66.js" crossorigin="anonymous"></script></script>
    <title>ToDoList</title>

</head>

<body>
    <div class="two">
        <h1>TO DO LIST <span><?php echo $data['Name']." Profile" ?></span> </h1><div>
        <div ><a href="users.php">Users</a> </div>
        <div class="logout"><a href="logout.php">Logout</a> </div>
        </div>
    </div>
    <div class="main-section">

        <!-- if any anthor user show curent user profile-->

    <?php if ($_SESSION['user']['id']==$userid){?>

        <div class="add-section">
            <!-- form to add todolist -->
            <form action="app/add.php" method="POST" autocomplete="off">

                <?php if(isset($_GET['mess']) && $_GET['mess']=='error'){?>

                    <input type="text" style="border-color:#ff6666" name="title" placeholder="This field is required ....!" />
                    <input type="hidden" name="user_id" value="<?php echo $userid?>"  >
                    <div>Start date</div> <input type="datetime-local" name="start_date" >
                    <div >End date</div> <input type="datetime-local" name="end_date" >
                    <button type="submit">Add <span>&#43;</span> </button>

                <?php }else{?>

                    <input type="text" name="title" placeholder="What do you need to do ?" />
                    <input type="hidden" name="user_id" value="<?php echo $userid?>"  >
                    <div>Start date</div> <input type="datetime-local" name="start_date" >
                    <div >End date</div> <input type="datetime-local" name="end_date" >
                    <button type="submit">Add <span>&#43;</span> </button>

                <?php } ?>
            </form>
        </div>
        <?php }?>

        <!-- all users data -->

        <div class="show-todo-section">
            <div class="container">
                <table border="2px">
                    <tr>
                        <th>tasks</th>
                        <th>done</th>
                        <th>remainng</th>
                    </tr>
                    <tr>
                        <td><?php
                            if(isset( $data['id'])){
                               echo $data['tasks_num'] ;
                            }
                            else echo 0;?>
                        </td>
                        <td><?php
                            if(isset( $data['done'])) {
                                echo $data['done'] ;
                            }
                            else echo 0;?>
                        </td>
                        <td><?php
                            if(isset( $data['id'])) {
                            echo $data['tasks_num']-$data['done'];
                            }
                            else echo 0; ?>
                        </td>
                    </tr>

                </table>
            </div>
        </div>

        <!-- All user tasks here  -->
        <div class="show-todo-section">
            <?php if(empty($todos)){?>
                        <!-- if no items in db -->
                <div class="todo-item">
                    <div class="empty">
                        <img src="img/1.jpg" width="160" alt="no one here">
                    </div>
                </div>
            <?php }?>

            <?php
                foreach ($todos as $todo ){
                    if ($_SESSION['user']['id']==$userid){?>
                <div class="todo-item" <?php
                        if(strtotime($todo['start_date']) < time()){
                            echo "style='box-shadow: 2px 2px 2px 2px #fc4242;'" ;}?> >

                    <!-- todolist details here -->

                        <span id="<?= $todo['id'];?>" class="remove-to-do">X</span> <!-- to delete items -->
                    <?php if($todo['checked']){?>

                        <input type="checkbox" data-todo-id="<?php echo $todo['id'];?>" class="check-box" checked>
                        <h2 class="checked"><?php echo $todo['text']?></h2><a id="aa" href="app/update.php?id=<?=$todo['id']?>"> <i style="font-size:17px;color:red;" class="fa-regular fa-pen-to-square"></i></a><br>

                    <?php }else{?>

                        <input type="checkbox" data-todo-id="<?php echo $todo['id'];?>" class="check-box">
                        <h2><?php echo $todo['text']?></h2><a id="aa" href="app/update.php?id=<?=$todo['id']?>"> <i style="font-size:17px;color:red;" class="fa-regular fa-pen-to-square"></i></a><br>
                    <?php } ?>

                        <small><?php echo "Created : ". $todo['create_date']?></small>
                        <small><?php echo "Starts : ". $todo['start_date']?></small>
                        <small><?php echo " Ends : ". $todo['end_date']?></small>

                </div>

            <?php }else{?>

             <div class="todo-item"<?php if(strtotime($todo['start_date']) < time()){echo "style='box-shadow: 2px 2px 2px 2px #fc4242;'" ;}?> >
            <!-- todolist details here -->
            <?php if($todo['checked']){?>
            <h2 class="checked"><?php echo $todo['text']?></h2><br>
            <?php }else{?>
            <h2><?php echo $todo['text']."<br>";}?></h2>

            <small><?= "Created : ". $todo['create_date']?></small>
            <small><?= "Starts : ". $todo['start_date']?></small>
            <small><?= " Ends : ". $todo['end_date']?></small>
        </div>
        <?php
        }
            }?>
                </div>
        <script src="js/jquery-3.2.1.min.js"></script>
        <script>
        $(document).ready(function() {
            $('.remove-to-do').click(function() {
                location.reload();
                const id = $(this).attr('id');
                $.post("app/remove.php", {
                        id: id
                    },
                    (data) => {
                        if (data) {
                            $(this).parent().hide(500);
                        }
                    }
                );
            });
            $('.check-box').click(function() {
                location.reload();
                const id = $(this).attr('data-todo-id');
                $.post("app/check.php", {
                        id: id
                    },
                    (data) => {
                        if (data != 'error') {
                            const h2 = $(this).next();

                            if (data === '1') {

                                h2.removeClass('checked');
                            } else {
                                h2.addClass('checked');

                            }
                        }
                    }
                );
            });
        });
        </script>
        <link rel="stylesheet" href="css/style.css">
    </div>
</body>

</html>