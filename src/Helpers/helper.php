<?php

function redirect(string $url){
    header("location: http://127.0.0.1:8081".$url);
}
