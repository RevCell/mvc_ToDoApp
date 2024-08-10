<?php

    use App\App;
use App\controllers\authController;
use App\controllers\membersController;
use App\controllers\TasksController;
use App\View;

require_once "../"."vendor/autoload.php";
    session_start();
    $main_path=dirname(__DIR__);
    $app = new App($main_path);


    //-----------------------ROUTES----------------------
    $app->router->get("/",function (){ View::render("index","layouts/main");});
    $app->router->get("/homepage",[authController::class,"homepageView"]);
    $app->router->get("/members",[membersController::class,"db_content_view"]);
    //-----------tasks:
    $app->router->get("/tasks/index",[TasksController::class,"index"]);
    $app->router->post("/tasks",[TasksController::class,"createTask"]);
    $app->router->get("/tasks/delete",[TasksController::class,"destroy"]);
    $app->router->get("/tasks/edit",[TasksController::class,"edit"]);
    $app->router->post("/tasks/edit",[TasksController::class,"update"]);
    //-----------Authentication:
    $app->router->get("/register",[authController::class,"registerView"]);
    $app->router->post("/register",[authController::class,"register"]);
    $app->router->get("/login",[authController::class,"login_view"]);
    $app->router->post("/login",[authController::class,"login"]);
    $app->router->get("/logout",[authController::class,"logout"]);

    //----------------------App_Run----------------------
    $app->run();