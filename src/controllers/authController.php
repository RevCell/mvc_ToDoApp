<?php

namespace App\controllers;

use App\Database\MySQL\MySQLConnection;
use App\Models\user;
use App\Request;
use App\session;
use App\View;

class authController{
    public function registerView()
    {
       View::render("register","layouts/main",[
         "message" => "you finally managed to execute dynamic layout and content page",
         "default"=> "test"
       ]);
    }
    public function homepageView(){
        View::contentRender("homepage");
    }
    public function register()
    {
        $data=Request::postData();
        $data['password']=password_hash($data['password'],PASSWORD_DEFAULT);

        $user=new user();
        $user=$user->create($data);
        if ($user){$_SESSION['user']=$user;
            /*$_SESSION['user']=[
                'email'=>$data['email'],
                "password"=>$data['password']
            ];*/
            redirect("/tasks/index");
        }
        else{
            View::render("error","layouts/main");
        }

        /*$db_connect=MySQLConnection::getInstance()->connection();
        $member_id=4;
        $username=Request::postData()['username'];
        $email=Request::postData()['email'];
        $data_insert=$db_connect->query("insert into members (username,email) values ('$username','$email') ");*/


        //fetching data from db:
        //$data=$db_connect->query("SELECT * FROM members");

        //inserting data to db:
        //$data_insert=$db_connect->query("insert into members (username,email) values ('$username','$email') ");

        //updating db records:
        //$data_update=$db_connect->query("Update members set username='$username',email='$email' where id=$member_id ");

        //deleting db records
        //$data_delete=$db_connect->query("delete from members where id=$member_id");

        /*echo "<pre>";
        var_dump($data_insert);
        echo "</pre>";*/
    }

    public function login_view()
    {
        if (!empty(session::get("user"))){
            redirect("/tasks");
        }
        View::render("login","layouts/main");
    }
    public function login()
    {
        $data=Request::postData();
        $email=$data['email'];
        $password=$data['password'];
        $user=new user();
        $user=$user->where("email",$email)->get();
        $hashed_password=password_hash($password,PASSWORD_DEFAULT);
        if ($user && password_verify($password,$user[0]['password'])){

            /*set cookie:
             * setcookie("login_cookie_todoApp",
            json_encode(["email"=>$email,"password"=>$password]),time()+1800);*/

            //set session:
            session::set('user',$user[0]);
            redirect("/tasks/index");
        }
        else{
            View::render("error","layouts/main");
        }
    }

    public function logout()
    {
        session_destroy();
        session_regenerate_id();
        /* ending a cookie
        setcookie("login_cookie_todoApp",null , time()-3600);*/
        redirect("/login");
    }
}
