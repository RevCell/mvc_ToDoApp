<?php

namespace App\controllers;


use App\Database\MySQL\MySQLConnection;
use App\Request;
use App\View;

class membersController{

    public function db_content_view()
    {
        $db_connect=MySQLConnection::getInstance()->connection();

        //----------old db connection method----------------
        /*try {
            $dsn= "mysql:host=localhost;dbname=todo_list;";
            $db_connect=new \PDO($dsn,"root","");
            $db_connect->setAttribute(\PDO::ATTR_ERRMODE,\PDO::ERRMODE_EXCEPTION);
        }
        catch (\Exception $e)
        {
            echo "something went wrong when attempting to connect to database".$e;
        }*/
        //----------old db connection method----------------


        $id=Request::getData()['id'];
        $sql="select * from members where id=:id";

        //-----------unsafe sql input method for fetching db data:
        //$sql="select * from members where id=$id";
        //$result=$db_connect->query($sql);
        //----------end------------------

        //-----------safe sql input method for fetching db data:
        $pre_statment=$db_connect->prepare($sql);
        $pre_statment->execute([
            ':id'=>$id
        ]);
        //----------end------------------

        foreach ($pre_statment->fetchAll(\PDO::FETCH_OBJ) as $end_res ){
            echo "<pre>";
            var_dump($end_res);
            echo "</pre>";
        }
    }
}

