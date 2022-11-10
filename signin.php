<?php
require 'db_connection.php';
if (isset($_POST ['email'])){
    $email=$_POST['email'];
    $pas=$_POST['password'];
    $obj=new db;
    $pass=$obj->hash_pasword($pas);
    $find=$obj->login($email,$pass);
    if (!empty($find)){
        $_SESSION['user']=$find;
        header("LOCATION:index.php?id=".$find['id']);
    }else{
        header("LOCATION:signin.php?error=1");
    }
}else{
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="css/sign.css">
</head>
<body>

<div class="signup__container">
    <div class="container__child signup__thumbnail">
        <div class="thumbnail__logo">
            <img class="logo__shape" width="50px" src="img/mahmoud-logo.png"/>
            <h1 class="logo__text">TO DO LIST</h1>
        </div>
        <div class="thumbnail__content text-center">
            <h1 class="heading--primary">Welcome to My paqe...</h1>
            <h2 class="heading--secondary">You are about to do your tasks .</h2>
            <h2>Powerd By Mahmoud Hafez<span>&#128521</span></h2>
        </div>

        <div class="signup__overlay"></div>
    </div>
    <div class="container__child signup__form">
        <div class="formcontainer">
            <h1 class="signin">SIGN IN</h1>
            <form action="signin.php" method="post">
                <div class="form-group">
                    <label >Email</label>
                    <input class="form-control" type="text" name="email"
                           id="email" placeholder="MahmoudHafez@gmail.com" required />
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input class="form-control" type="password" name="password"
                           id="password" placeholder="********" required />
                </div><?php
                if($_GET['error']){?>
                <div class="error">invald email or password ,Try again</div>
                <?php }?>
                    <div class="m-t-lg">
                    <ul class="list-inline">
                        <li>
                            <input class="btn btn--form" type="submit" value="Sign In" />
                        </li>
                        <li>
                            <a class="signup__link" href="http://localhost/projects/ToDoList_Task/signup.html">I am not member</a>
                        </li>
                    </ul>
                </div>
            </form>
        </div>

    </div>
</div>

</body>
</html>
<?php
}
?>