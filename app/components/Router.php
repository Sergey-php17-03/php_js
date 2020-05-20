<?php

namespace App\components;

class Router {

    private $routes;
    private $namespaces = 'App\controllers\\';

    public function __construct() {
        $this->routes = include(__DIR__ . '/../../routes/web.php');
    }

    private function getURI() {
        if ( !empty( $_SERVER['REQUEST_URI'] ) ) {
            return trim( $_SERVER['REQUEST_URI'], '/' );
        }
    }

    public function run() {

        $uri = $this->getURI();

        
        foreach ( $this->routes as $uriPattern => $path ) {

        
            if ( preg_match( "~$uriPattern~", $uri ) ) {

        
                $internalRout = preg_replace( "~$uriPattern~", $path, $uri, 1 );

        
                $segments = explode( '/', $internalRout );

                $controllerName = $this->namespaces . ucfirst(array_shift( $segments ) . 'Controller');
                $actionName = 'action' . ucfirst(array_shift( $segments ));
                $parametrs = $segments;

        
                $cotrollerObject = new $controllerName;   
                
                return call_user_func_array( [$cotrollerObject, $actionName], $parametrs );
                
            }
        }
    }

}
