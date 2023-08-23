<?php

namespace Includes;

class RouteHelper
{
    const MAIN_PAGE = "Books";
    private static $actions = [];

    private static string $action;
    private static $params = [];

    public static function simpleRoute($pathURI, $requestURI)
    {
        if ($pathURI === $requestURI) {
            self::determineAction($pathURI);
            echo self::getAction() . PHP_EOL;
            print_r(self::getParams());
            return true;
        }
          //спрацювало з другою підумовою, без другої не працювало
        if (strpos($requestURI, $pathURI) === 0 && $pathURI !== "/") {
            echo $pathURI;
            self::determineAction($pathURI);
            self::$params[] = substr($requestURI, strlen($pathURI));
            echo self::getAction() . PHP_EOL;
            print_r(self::getParams());
            return true;
        }
        return false;
    }

    public static function isNumParam()
    {
        return is_numeric(self::$params);
    }

    private static function determineAction($pathURI) {
        if ($pathURI === "/") {
            self::setAction(self::MAIN_PAGE);
            return true;
        } elseif (!empty($pathURI)) {
            $pathURI = trim($pathURI, '/');
            $pathComponents = explode('/', $pathURI);
    
            $result = "";
            foreach ($pathComponents as $component) {
                $result .= ucfirst($component);
            }
            self::setAction($result);
            return true;
        }
        return false;
    }

    public static function getAction()
    {
        return self::$action;
    }

    public static function setAction($page)
    {
        self::$action = "print$page";
    }

    public static function getParams()
    {
        return self::$params;
    }
}
