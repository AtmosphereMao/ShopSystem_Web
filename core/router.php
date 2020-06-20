<?php
/**
 * Created by PhpStorm.
 * User: AtmosphereMao
 * Date: 2020/6/19
 * Time: 21:32
 */

namespace core;



use function Couchbase\defaultDecoder;

class Router
{
    private static $routerTable = array(
        'GET' => array('NotFound' => 'NotFound/index'),
        'POST' => array('NotFound' => 'NotFound/index'),
    );

    private $urlPath;
    private $handlerFile;
    private $handlerMethod;

    public function __construct()
    {
        // Session
        session_start();

        $this->pathProcessor();
        // include the file.
        require_once('../handler/Handler.php');
        require_once('../app/Http/Controller/' . $this->handlerFile . '.php');

        /* Model */
        require_once('model.php');

        /* Auth */
        require_once('auth.php');


        $handler = new $this->handlerFile();
        $handler->{
            $this->handlerMethod
        }();
    }

    public static function GET($path, $handler)
    {
        $path = trim($path, '/');
        self::$routerTable['GET'][$path] = $handler;
    }

    public static function POST($path, $handler)
    {
        $path = trim($path, '/');
        self::$routerTable['POST'][$path] = $handler;
    }

    private function pathProcessor()
    {
        $urlPathInfo = @explode('/', $_SERVER['REQUEST_URI']);
        $this->urlPath = @$urlPathInfo[1];
        if ($this->urlPath == null) {
            // default handler
            $this->urlPath = '';
        }

        $requestMethod = $_SERVER['REQUEST_METHOD'];
        // check the router table
        if (!isset(self::$routerTable[$requestMethod][$this->urlPath])) {
            $this->urlPath = 'NotFound';
        }

        $route = explode('/', self::$routerTable[$requestMethod][$this->urlPath]);
        $this->handlerFile = $route[0];
        $this->handlerMethod = $route[1];
    }
}