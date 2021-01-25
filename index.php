<?php
// $url = isset($_GET['url']) == true 
//                     ? $_GET['url'] : "/";
// require_once './vendor/autoload.php';
// require_once './config/database.php'; 
// composer require illuminate/database
// composer require illuminate/events

// use App\Controllers\HomeController;
// use App\Controllers\ProductController;
// use App\Controllers\CategoryController;
// switch($url){
//     case "/":
//         $ctr = new HomeController();
//         echo $ctr->index();
//         break;
//     case "new-cate":
//         $ctr = new CategoryController();
//         echo $ctr->addNew();
//         break;
//     case "save-cate":
//         $ctr = new CategoryController();
//         echo $ctr->saveCate();
//         break;
//     case "edit-cate":
//         $ctr = new CategoryController();
//         echo $ctr->editCate();
//         break;
//     case "save-edit-cate":
//         $ctr = new CategoryController();
//         echo $ctr->saveEdit();
//         break;
//     case "remove-cate":
//         $ctr = new CategoryController();
//         echo $ctr->removeCate();
//         break;
//     default:
//         echo "Not found!";
//         break;
// }

require_once 'autoload.php';

// Định nghĩa hằng Path của file index.php
define('PATH_ROOT', __DIR__);

// load class Route
$router = new Core\Route();
include_once 'routes.php';

// Lấy url hiện tại của trang web. Mặc định la /
$request_url = !empty($_GET['url']) ? '/' . $_GET['url'] : '/';

// Lấy phương thức hiện tại của url đang được gọi. (GET | POST). Mặc định là GET.
$method_url = !empty($_SERVER['REQUEST_METHOD']) ? $_SERVER['REQUEST_METHOD'] : 'GET';


$router->map($request_url, $method_url);
?>