<?php

namespace Core;

/**
 * 
 * Class Route
 * 
 */
class Route
{

    /**
     * 
     * - Mảng lưu trữ route của ứng dụng
     * - Mỗi route sẽ gôm url, method, action và params
     * 
     */
    public $__routes;
    // private $__routes;

    // Hàm khởi tạo
    public function __construct()
    {
        $this->__routes = [];
    }

    /**
     * 
     * Phương thức get
     * 
     * @param string $url URL cần so khớp
     * @param string|callable $action Hành động khi URL được gọi. Có thể là một callback hoặc một method trong controller
     * 
     * @return void
     * 
     */
    public function get(string $url, $action)
    {
        // Xử lý phương thức GET
        $this->__request($url, 'GET', $action);
    }

    /**
     * 
     * Phương thức POST
     * 
     * @param string $url URL cần so khớp
     * @param string|callable $action Hành động khi URL được gọi. Có thể là một callback hoặc một method trong controller
     * 
     * @return void
     * 
     */
    public function post(string $url, $action)
    {
        // Xử lý phương thức POST
        $this->__request($url, 'POST', $action);
    }

    /**
     * 
     * Phương thức POST
     * 
     * @param string $url URL cần so khớp
     * @param string|callable $action Hành động khi URL được gọi. Có thể là một callback hoặc một method trong controller
     * 
     * @return void
     * 
     */
    public function update(string $url, $action)
    {
        // Xử lý phương thức POST
        $this->__request($url, 'UPDATE', $action);
    }


    /**
     * 
     * Phương thức POST
     * 
     * @param string $url URL cần so khớp
     * @param string|callable $action Hành động khi URL được gọi. Có thể là một callback hoặc một method trong controller
     * 
     * @return void
     * 
     */
    public function delete(string $url, $action)
    {
        // Xử lý phương thức POST
        $this->__request($url, 'DELETE', $action);
    }


    /**
     * 
     * Xử lý phương thức
     * 
     * @param string $url URL cần so khớp
     * @param string $method method của route. GET hoặc POST
     * @param string|callable $action Hành động khi URL được gọi. Có thể là một callback hoặc một method trong controller
     * 
     * @return void
     * 
     */
    private function __request(string $url, string $method, $action)
    {
        // kiem tra xem URL co chua param khong. VD: post/{id}
        if (preg_match_all('/({([a-zA-Z]+)})/', $url, $params)) {
            $url = preg_replace('/({([a-zA-Z]+)})/', '(.+)', $url);
        }

        var_dump($params);

        // Thay the tat ca cac ki tu / bang ky tu \/ (regex) trong URL.
        $url = str_replace('/', '\/', $url); 

        $route = [
            'url' => $url,
            'method' => $method,
            'action' => $action,
            'params' => $params[2]
        ];
        array_push($this->__routes, $route);
    }

    public function map(string $url, string $method)
    {
        // Lặp qua các route trong ứng dụng, kiểm tra có chứa url được gọi không
        foreach ($this->__routes as $route) {

            // nếu route có $method
            if ($route['method'] == $method) {

                // kiểm tra route hiện tại có phải là url đang được gọi.
                // $router->get('/post/{id}', 'PostController@show');
                // $router->get('/post/edit/{id}', 'PostController@edit');
                $reg = '/^' . $route['url'] . '$/';
                if (preg_match($reg, $url, $params)) {



                    array_shift($params);
                    $this->__call_action_route($route['action'], $params);
                    return;

                    
                }
            }
        }

        // nếu không khớp với bất kì route nào cả.
        echo '404 - Not Found';
        return;
    }

    /**
     * 
     * Hàm gọi action route
     * 
     * @param string|callable $action action của route
     * @param array $params Các tham số trên url
     * 
     * @return void
     * 
     */
    private function __call_action_route($action, $params)
    {
        // Nếu $action là một callback (một hàm).
        if (is_callable($action)) {
            call_user_func_array($action, $params);
            return;
        }

        // Nếu $action là một phương thức của controller. VD: 'HomeController@index'.
        if (is_string($action)) {
            $action = explode('@', $action);
            $controller_name = 'App\\Controllers\\' . $action[0];
            $controller = new $controller_name();
            call_user_func_array([$controller, $action[1]], $params);

            return;
        }
    }
}
