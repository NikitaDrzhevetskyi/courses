<?php

namespace core;

class Router
{
    /**
     * парсимо шлях
     */
    protected function getRoute()
    {
        $path = trim($_GET['path'], '/');
        $pathParts = explode('/', $path);
        $className = ucfirst(array_shift($pathParts));
        if (empty($className)) {
            $resultClassName = 'controllers\\Site';
        } else {
            $resultClassName = 'controllers\\' . $className;
        }
        $methodName = ucfirst(array_shift($pathParts));
        if (empty($methodName)) {
            $resultMethodName = 'actionIndex';
        } else {
            $resultMethodName = 'action' . $methodName;
        }
        return [$resultClassName, $resultMethodName];
    }

    /**
     * процес роботи системи
     */
    public function run()
    {
        $fullPath = self::getRoute();
        $class = $fullPath[0];
        $method = $fullPath[1];
        if (class_exists($class))
            $controller = new $class();
        else
            Router::ErrorPage404();
        if (method_exists($controller, $method)) {
            $infoMethod = new \ReflectionMethod($class, $method);
            $paramsArray = [];
            foreach ($infoMethod->getParameters() as $parameter) {
                array_push($paramsArray, isset($_GET[$parameter->name]) ? $_GET[$parameter->name] : null);
            }
            $result = $infoMethod->invokeArgs($controller, $paramsArray);
            if(is_array($result)){
                Core::$view->SetParams($result);
                $pathtempl = Core::$template;
                Core::done("views/layout/{$pathtempl}.php");
            }
        } else
            Router::ErrorPage404();
    }


    function ErrorPage404()
    {
        header("Location: /error404");
    }
}