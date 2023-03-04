<?php 
require 'vendor/autoload.php';

use Controller\RequestHandler;
use Controller\ApiController;

$input = file_get_contents('php://input');
$data = json_decode($input);

$request = $data->message->text;
$chat_id = $data->message->chat->id;

$response = new RequestHandler();

if($request == '/start')
{
  
  $response->buildKeyboard($chat_id);
  
}