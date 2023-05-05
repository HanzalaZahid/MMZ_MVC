<?php 
namespace core;
class Router{
    public $routes =   [];
    private function add_route($uri, $method, $directory, $controller)
    {
        $this->routes[$uri]  =   [
            'uri'   => $uri,
            'method'   => $method,
            'dir'   => $directory,
            'controller'   => $controller,
        ];
    }

    public function get($uri, $directory, $controller){
        $this->add_route($uri, 'GET', $directory, $controller);
    }
    public function post($uri, $directory, $controller){
        $this->add_route($uri, 'POST', $directory, $controller);
    }
    public function put($uri, $directory, $controller){
        $this->add_route($uri, 'PUT', $directory, $controller);
    }
    public function patch($uri, $directory, $controller){
        $this->add_route($uri, 'PATCH', $directory, $controller);
    }
    public function route($uri, $method){
        if (isset($this->routes[$uri]['uri'])){
            if ($this->routes[$uri]['uri']  ==  $uri && $this->routes[$uri]['method']   ==  strtoupper($method)){
                controller($this->routes[$uri]['dir'], $this->routes[$uri]['controller']);
            }
            else if ($this->routes[$uri]['uri']  ==  $uri && $this->routes[$uri]['method']   !=  strtoupper($method)){
                $this->abort(403);
            }
        }
        else{
            $this->abort();
        }
    }
    public function abort($code =   404){
        http_response_code($code);
        view("Errors", $code);
        die();
    }
}

?>