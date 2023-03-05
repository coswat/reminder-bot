<?php
//echo phpinfo();
$chat_id = 82828282;
try {
  $conn = new \PDO('mysql:host=127.0.0.1;dbname=reminder_db','root','',[
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
    ]);
  echo 'success';
} catch (PDOExeption $e) {
   echo $e->getMessage();
}
$stmt = 'SELECT * FROM main WHERE chat_id='.$chat_id.'';
        foreach ($conn->query($stmt)->fetchAll() as $reminder)
        {
          echo '<pre>';
          var_dump($reminder);
          echo '</pre>';
        }
       
