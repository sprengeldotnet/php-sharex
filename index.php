<?php

header('Access-Control-Allow-Origin: https://example.com');
header('Access-Control-Allow-Methods: POST');

if($_SERVER["REQUEST_METHOD"] == "POST"){
    if( isset($_FILES['file']) )
    {

        $data = ['file' => new CURLFile($_FILES['file']['tmp_name'], $_FILES['file']['type'], $_FILES['file']['name'])];

        $ch = curl_init();
        $options = array(
            CURLOPT_URL => "https://sharex-server.com/upload",
            CURLOPT_HEADER => false,
            CURLOPT_POST => true,
            CURLOPT_HTTPHEADER => ["key: yourkey", "Content-Type: multipart/form-data"],
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_RETURNTRANSFER => true
        );
        curl_setopt_array($ch, $options);

        $result = curl_exec($ch);

        curl_close($ch);
        
        die($result);
        
    }
    else{
        die("no file found");
    }
}
die();
