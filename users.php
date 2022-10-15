<?php

require "db_connection.php";
if(empty($_SESSION['user'])){
    header("LOCATION:signin.php");

}
$f=new db();
$get_users=$f->users();


?>
<html lang="">

<head>
    <link rel="stylesheet" href="css/users.css">
    <title>users</title>
</head>
<body>
<div class="two">
    <div class="header">
        <div>Users</div>
        <small><?php  echo "HI ".$_SESSION['user']['Name']." ...."?></small>
    </div>
        <div class="logout"><a href="logout.php">Logout</a> </div>
    </div>
    <div class="container">

        <table border="2px">
            <tr>
                <th>Name</th>
                <th>tasks</th>
                <th>done</th>
                <th>remainng</th>
            </tr>
            <?php foreach ($get_users as $data){?>
            <tr>

                <td><a href="index.php?id=<?php echo $data['id']?>"><?php echo $data['Name']?></a></td>

                <td><?php echo $data['tasks_num']?></td>
                <td><?php echo $data['done']?></td>
                <td><?php echo $data['tasks_num']-$data['done']?></td>
            </tr>
            <?php }?>
        </table>

    </div>

</body>
</html>
