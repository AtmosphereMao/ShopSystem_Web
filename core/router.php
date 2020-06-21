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

        // Timezone
        date_default_timezone_set("Asia/Shanghai");

        $this->pathProcessor();
        // include the file.
        require_once('../handler/Handler.php');

        /* Auth */
        require_once('auth.php');

        /* Controller */
        require_once('../app/Http/Controller/' . $this->handlerFile . '.php');

        /* Model */
        require_once('model.php');
        require_once('../app/Http/Model/Users.php');
        require_once('../app/Http/Model/Trends.php');
        require_once('../app/Http/Model/Cart.php');
        require_once('../app/Http/Model/Order.php');


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

    public static function DELETE($path, $handler)
    {
        $path = trim($path, '/');
        self::$routerTable['DELETE'][$path] = $handler;
    }

    public static function PUT($path, $handler)
    {
        $path = trim($path, '/');
        self::$routerTable['PUT'][$path] = $handler;
    }

    private function pathProcessor()
    {
        $urlPathInfo = @explode('/', $_SERVER['REQUEST_URI']);
        /* 路由处理 */
        if(count($urlPathInfo)>1){
            for($i=1; $i < count($urlPathInfo); $i++)
            {
                $this->urlPath .= $urlPathInfo[$i] . '/';
            }
            if(substr($this->urlPath,-2) == '//')
            {
                $this->urlPath = substr($this->urlPath,0,strlen($this->urlPath)-2);
            }else{
                $this->urlPath = substr($this->urlPath,0,strlen($this->urlPath)-1);
            }
        }else{
            $this->urlPath = @$urlPathInfo[1];
        }

        /* GET参数处理 */
        $urlPathInfo = @explode('?', $this->urlPath);
        $this->urlPath = @$urlPathInfo[0];
        parse_str(@$urlPathInfo[1],$_GET);


        if ($this->urlPath == null) {
            // default handler
            $this->urlPath = '';
        }
        $requestMethod = isset($_POST['_method']) ? strtoupper($_POST['_method']) : $_SERVER['REQUEST_METHOD'];
        // check the router table
        if (!isset(self::$routerTable[$requestMethod][$this->urlPath])) {
            $this->urlPath = 'NotFound';
        }
        // exit;
        $route = explode('/', self::$routerTable[$requestMethod][$this->urlPath]);
        $this->handlerFile = $route[0];
        $this->handlerMethod = $route[1];
    }
}