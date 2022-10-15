<?php
session_start();
class db{


    private $ServerName="localhost";
    private $UserName="root";
    private $Pass="";
    private $DataBaseName="todotask";
    protected $conn;

    public function __construct()
    {
            $this->conn =mysqli_connect("$this->ServerName","$this->UserName","$this->Pass","$this->DataBaseName");


    }

    function regester($UserName,$UserAge,$UserPhone,$UserEmail,$UserPassword){
            //hash the password

        $userhashedPassword=$this->hash_pasword($UserPassword);

            //insert new user in db .

        $myQuery="INSERT INTO `users` (`Name`, `age`, `phone`, `email`, `password`) 
                  VALUES ('$UserName','$UserAge','$UserPhone','$UserEmail','$userhashedPassword')";


        $mquery=mysqli_query($this->conn,$myQuery);

        $res=mysqli_affected_rows($this->conn);

        if($res==1){
            return true;
        }else{
            return false;
        }

    }
    function login($email,$password){

        $order="SELECT * FROM `users` WHERE `email`='$email'AND `password`='$password'";

        $query=mysqli_query($this->conn,$order);
        $res=mysqli_fetch_assoc($query);

        return $res;
    }

    function gettasks($id){
        $order="SELECT * FROM `tasks` where `user_id`='$id'ORDER BY `start_date` ASC";

        $query=mysqli_query($this->conn,$order);
        $tasks=[];
        while ($res=mysqli_fetch_assoc($query)){
            $tasks[]=$res;
        }

        return $tasks;
    }
    function users(){
        $order="SELECT * FROM `usee_tasks` ";

        $query=mysqli_query($this->conn,$order);
        $tasks=[];
        while ($res=mysqli_fetch_assoc($query)){
            $tasks[]=$res;
        }

        return $tasks;
    }
    function addtask($text,$user_id,$start_date,$end_date){
        $order="INSERT INTO `tasks`(`text`, `user_id`, `start_date`, `end_date`) VALUES ('$text','$user_id','$start_date','$end_date')";

        $mquery=mysqli_query($this->conn,$order);

        $res=mysqli_affected_rows($this->conn);

        if($res==1){
            return true;
        }else{
            return false;
        }
    }
    function gettask($id){
        $order ="SELECT `id`,`checked`,`text`, `start_date`, `end_date` FROM `tasks` WHERE id=$id";
        $query=mysqli_query($this->conn,$order);
        $res=mysqli_fetch_assoc($query);

        return $res;

    }
    function updatetask($id,$text,$start,$end){

        $order ="UPDATE `tasks` SET `text`='$text',`start_date`='$start',
                 `end_date`='$end'WHERE `id`=$id";

        $query=mysqli_query($this->conn,$order);

        $res=mysqli_affected_rows($this->conn);

        if($res==1){
            return true;
        }else{
            return false;
        }
    }

    function deltask($id){
        $order="DELETE FROM `tasks` WHERE `id`=$id";

        $mquery=mysqli_query($this->conn,$order);
        $res=mysqli_affected_rows($this->conn);

        if($res==1){
            return true;
        }else{
            return false;
        }
    }

    function updatecheck($taskid){
        $res=$this->gettask($taskid);

        $check=$res['checked'];
        $uncheck=1-$check;
        $order="UPDATE `tasks` SET checked=$uncheck WHERE id=$taskid";

        $mquery=mysqli_query($this->conn,$order);
        if ($mquery){
            echo $check;
        }else{
            echo "error";
        }

    }

    function hash_pasword($password){

        return sha1($password);


    }

    public function __destruct()
    {
        $conn=null;
        exit();
    }
}
