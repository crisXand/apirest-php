<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: GET,POST,PUT,DELETE");
header("Access-Control-Allow-Headers: Access-Control-Allow-Origin, Content-Type, Access-Control-Allow-Methods");

require_once __DIR__ . "/Controllers/ProductController.php";
require_once __DIR__ . "/Repositories/ProductRepository.php";
require_once __DIR__."/Config/Db.php";

$uri = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
$uri = explode("/", $uri);
$controller = $uri[3] . "Controller";
$idElement = array_key_exists(4, $uri) ? intval($uri[4]) : null;
$reqMethod = $_SERVER["REQUEST_METHOD"];
$constrollerInst = new $controller;
switch($reqMethod){
    case "GET":
        $constrollerInst->get($idElement);
        break;
    case "PUT":
        if($idElement != null){
            $body = json_decode(file_get_contents("php://input"), true);
            $constrollerInst->update($idElement, $body);
            
        }else{
            http_response_code(400);
        }
        break;
    default:
        http_response_code(422);
        echo json_encode(["msg" => "Method not allowed"]);
}

