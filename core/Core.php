<?php

namespace core;

class Core
{
    public static $instance;
    public static $view;
    public static $template;
    public static $database;

    private function __construct()
    {

    }
    /**
     * Повертає єдиний екземпляр класу Core
     *
     */
    public static function getInstance()
    {
        if (empty(self::$instance)) {
            self::$instance = new Core();
            return self::getInstance();
        } else {
            return self::$instance;
        }
    }

    /**
     * Підключення до БД
     *
     */
    public function getDB()
    {
        return self::$database;
    }

    /**
     * Початок роботи сессії, підключення компонентів
     *
     */
    public function init()
    {
        global $db;
        session_start();
        spl_autoload_register( '\core\Core::__autoload');
        self::$view = new View();
        self::$database = new DB($db['host'],$db['dbname'],$db['user'],$db['password']);
    }

    /**
     * Автозавантажувач
     *
     */
    public static function __autoload($className)
    {
        $fileName = $className . '.php';
        if (is_file($fileName))
            include($fileName);
    }

    /**
     * Підключення шаблону, виведення сторінки
     *
     */
    public static function done($path)
    {
        self::$view->display($path);
    }



}