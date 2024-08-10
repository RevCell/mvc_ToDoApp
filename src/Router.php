<?php

namespace App;

    class Router{
        protected $request;
        protected $routes;

        public function __construct(Request $request)
        {
            $this->request=$request;
        }

        public function get($url,$callback)
        {
            $this->routes['get'][$url]=$callback;
        }

        public function post($url,$callback)
        {
            $this->routes['post'][$url]=$callback;
        }

        public function resolve()
        {
            $uri=$this->request->geturl();
            $method=Request::method();
            return $this->routes[$method][$uri];
        }
    }