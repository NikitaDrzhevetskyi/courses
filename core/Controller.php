<?php

namespace core;

class Controller
{
    public function render($viewName, $template,  $localParams = null, $globalParams = null)
    {
        Core::$template = $template;
        $view = new View();
        if(is_array($localParams))
            $view->SetParams($localParams);
        if(!is_array($globalParams))
            $globalParams = [];
        $moduleName = strtolower((new \ReflectionClass($this))->getShortName());
        $globalParams['Content']=$view->render("views/{$moduleName}/{$viewName}.php");
            return $globalParams;
    }
}