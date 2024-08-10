<?php

namespace App\controllers;

use App\Models\task;
use App\Request;
use App\View;

class TasksController{

    public function index()
    {
        $user_task=new task();
        $tasks=$user_task->where("member_id",$_SESSION['user']['id'])->get();
        View::render("/tasks/index","layouts/main",compact('tasks'));
    }

    public function createTask()
    {
        $data=Request::postData();
        $task=new task();
        $data['member_id']=$_SESSION['user']['id'];
        $result=$task->create($data);
        /*echo "<pre>";
        var_dump($result);
        die();*/
        if ($result){
            redirect("/tasks/index");
        }
        else{
            View::render("error","layouts/main");
        }
    }

    public function destroy()
    {
        $id=Request::getData()['task_id'];
        $task=new task();
        $result=$task->where('id',$id)->delete();

        if ($result){
            redirect("/tasks/index");
        }
        else{
            View::render("error","layouts/main");
        }
    }

    public function edit()
    {
        $task_id=Request::getData()['id'];
        $task_record=new task();
        $task=$task_record->where('id',$task_id)->get()[0];
        View::render("/tasks/edit","layouts/main",compact("task"));
    }

    public function update()
    {
        $data=Request::postData();
        $id=Request::getData()['id'];
        $task_record=new task();
        $task=$task_record->update($data,["id"=>$id]);
        if ($task){
            redirect("/tasks/index");
        }
        else{
            View::render("error","layouts/main");
        }
    }
}