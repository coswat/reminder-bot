<?php

require 'vendor/autoload.php';

use Controller\RequestHandler;
use Controller\ApiController;
use Controller\Database;

$input = file_get_contents('php://input');
$data = json_decode($input);

$request = $data->message->text;
$chat_id = $data->message->chat->id;
$replyTo = $data->message->reply_to_message->text;

$response = new RequestHandler((int)$chat_id);

if ($chat_id !== 1120861062) {
    $text = [
       'chat_id' => $chat_id,
       'text' => 'Unauthorized',
      ];
    $apicontroller = new ApiController();
    $apicontroller->sendResponse(http_build_query($text));
    exit;
}

if ($request == '/start') {
    return $response->boot();
} elseif ($request == 'Set Reminder') {
    return $response->handle();
} elseif ($request == 'Cancel') {
    return $response->boot();
} elseif ($replyTo && $replyTo == 'Write a message to set as reminder
          
Example Message :

i Have a meeting now (2022-04-01 21:45)') {
    return $response->remindProccessSet($request);
} elseif ($request == 'Current Reminders') {
    return $response->fetchReminders();
} elseif ($request == 'Delete Reminders') {
    return $response->deleteRequest();
} elseif ($replyTo && $replyTo == 'Enter ID of Reminder to delete') {
    return $response->deleteReminder((int)$request);
}
