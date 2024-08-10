<?php

namespace App;
    class App{
        protected $request;
        public $router;
        public static $main_path;

        public function __construct($main_path)
        {
            $this->request=new Request();
            $this->router=new Router($this->request);
            self::$main_path = $main_path;
        }

        public function run()
        {
            $callback=$this->router->resolve();

            if (is_array($callback)){
                $obj = new $callback[0];
                $method = $callback[1];
                call_user_func([$obj,$method]);
            }
            else{
                $callback();
            }
        }
}
