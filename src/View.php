<?php

namespace App;

class View{

    public static function render($content,$layouts,$params=[])
    {
        $content = self::contentRender($content,$params);
        $layout = self::layoutRender($layouts,$params);
        echo str_replace("{{content}}",$content,$layout);
    }
    public static function  contentRender($input,$params = [])
    {
        extract($params);
        ob_start();
        include_once App::$main_path."/views/$input.php";
        return ob_get_clean();
    }

    public static function  layoutRender($input,$params = [])
    {
        foreach ($params as $key => $value)
            $$key = $value;
        ob_start();
        include_once App::$main_path."/views/$input.php";
        return ob_get_clean();
    }
}