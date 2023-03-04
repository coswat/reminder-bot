<?php 
require 'vendor/autoload.php';

use Controller\RequestHandler;
use Controller\ApiController;

$input = file_get_contents('php://input');
$data = json_decode($input);

$request = $data->message->text;
$chat_id = $data->message->chat->id;

$response = new RequestHandler();

if($chat_id !== 1120861062)
{
  $text = [
     'chat_id' => $chat_id,
     'text' => 'Unauthorized',
    ];
    $apicontroller = new ApiController();
    $apicontroller->sendResponse(http_build_query($text));
    exit;
}

if($request == '/start')
{
  
  $response->boot($chat_id);
  
}