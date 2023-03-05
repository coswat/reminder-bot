<?php
//for cron job
require __DIR__.'/../vendor/autoload.php';

use Controller\ApiController;
use Controller\Database;

date_default_timezone_set('Asia/Kolkata');

$time = date('Y-m-d H:i');

$db = new Database();
$conn = $db->connect();
$apiCont = new ApiController();
$sql = 'SELECT * FROM main';
$stmt = $conn->query($sql);
$datas = $stmt->fetchAll();
foreach ($datas as $data) {
    if ($data->time == $time) {
        $responseData = [
          'chat_id' => $data->chat_id,
          'text' => "New Reminder:
          
{$data->message}",
          'parse_mode' => 'html'
          ];
        $apiCont->sendResponse('sendMessage',http_build_query($responseData));
        $sql = "DELETE FROM main WHERE id=$data->id";
        $stmt = $conn->query($sql);
    }
}
