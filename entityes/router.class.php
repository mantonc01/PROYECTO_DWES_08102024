<?php
class Router
{
    private $routes;

    private function __construct(){
        $this->routes = [
            'GET'=>[],
            'POST'=>[]
        ];
    }

    public function get(string $uri, string $controllerAction): void{
        $this->routes['GET'][$uri] = $controllerAction;
    }

    public function post(string $uri, string $controllerAction): void{
        $this->routes['POST'][$uri] = $controllerAction;
    }

    public static function load(string $file): Router{
        $router=new Router();

        require $file;
        return $router;
    }



    public function define(array $tablaRutas): void
    {
        $this->routes = $tablaRutas;
    }



    public function direct(string $uri,string $method):string
    {
        if (array_key_exists($uri, $this->routes[$method])) {
            return $this->routes[$method][$uri];
        } else {
            throw new Exception('No se ha encontrado la ruta');
        }
    }

    public function redirect(string $path){
        header('Location:  /'. $path);       
    }
}
