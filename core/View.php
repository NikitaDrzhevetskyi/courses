<?php

namespace core;

class View
{
    protected $parameters;
    public function __construct()
    {
        $this->parameters = [];
    }

    public function SetParams($arr){
        foreach ($arr as $el => $value)
            $this->parameters[$el] = $value;
    }


    public function render($path){
        extract( $this->parameters);
        ob_start();
        include ($path);
        $html = ob_get_contents();
        ob_end_clean();
        return $html;
    }

    public function display($path){
        echo $this->render($path);
    }

}