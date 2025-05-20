<?php

class Router {
    public function run() {
        $url = $_GET['url'] ?? 'home/index';
        $url = explode('/', filter_var(rtrim($url, '/'), FILTER_SANITIZE_URL));

        $controllerName = ucfirst($url[0]) . 'Controller';
        $action = $url[1] ?? 'index';
        $params = array_slice($url, 2);

        $controllerFile = 'app/controllers/' . $controllerName . '.php';

        if (file_exists($controllerFile)) {
            require_once $controllerFile;
            $controller = new $controllerName;
            if (method_exists($controller, $action)) {
                call_user_func_array([$controller, $action], $params);
                return;
            }
        }

        http_response_code(404);
        echo "Page not found.";
    }
}
