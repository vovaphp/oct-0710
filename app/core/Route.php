<?php


namespace core;


class Route
{
    static public function init()
    {
        $path = $_SERVER['REQUEST_URI'];
        $urlComponents = explode('/', $path);
        array_shift($urlComponents);
        if (count($urlComponents) > 2) {
            self::notFound();
        }
        $controllerName = 'index';
        if (!empty($urlComponents[0])) {
            $controllerName = strtolower($urlComponents[0]);
        }
        $actionName = 'index';
        if (!empty($urlComponents[1])) {
            $actionName = strtolower($urlComponents[1]);
        }
        $controllerClass = 'controllers\\' . ucfirst($controllerName);
        if (!class_exists($controllerClass)) {
            self::notFound();
        }
        $controller = new $controllerClass;
/*        if (!($controller instanceof controllerInterface)) {
            //TODO generate error of type
            exit('controller must be implement controllerInterface');
        }*/
        self::actionCaller($controller,$actionName);

    }

    static private function actionCaller(controllerInterface $controller, string $action){
        if (!method_exists($controller, $action)) {
            self::notFound();
        }
        $controller->$action();
    }

    static public function notFound()
    {
        http_response_code(404);
        exit();
    }

    static public function url(string $controller = null, string $action = null)
    {
        $url = '/';
        if (!empty($controller)) {
            $url .= strtolower($controller);
            if (!empty($action)) {
                $url .= '/' . strtolower($action);
            }
        }
        return $url;
    }
}
