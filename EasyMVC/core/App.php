<?php

class App {
    
    // public function __construct() {
    //     $url = $this->parseUrl();
        
    //     $controllerName = "{$url[0]}Controller";
    //     require_once "controllers/$controllerName.php";
    //     $controller = new $controllerName;
    //     $methodName = $url[1];
    //     // $controller->$methodName($url[2]);//使用controller呼叫方法
    //     unset($url[0]); unset($url[1]);
    //     // var_dump($url);
    //     $params = $url ? array_values($url) : Array();
    //     call_user_func_array(Array($controller, $methodName), $params);//控制器名 方法名 參數為可選 看是否方法需要參數
    //     // var_dump($params);
    // }

    public function __construct() {
        $url = $this->parseUrl();
        
        $controllerName = "{$url[0]}Controller";
        if (!file_exists("controllers/$controllerName.php"))
            return;
        require_once "controllers/$controllerName.php";
        $controller = new $controllerName;
        $methodName = isset($url[1]) ? $url[1] : "index";
        if (!method_exists($controller, $methodName))
            return;
        unset($url[0]); unset($url[1]);
        $params = $url ? array_values($url) : Array();
        call_user_func_array(Array($controller, $methodName), $params);
    }
    
    public function parseUrl() {
        if (isset($_GET["url"])) {
            $url = rtrim($_GET["url"], "/");//去掉字串指定符號
            $url = explode("/", $url);//拆解成陣列依照"/"
            return $url;
        }
    }
    
}

