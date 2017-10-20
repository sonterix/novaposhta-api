<?php

// connect to DB
require_once 'connect.php';

// delete all from table
$dbh->exec("DELETE FROM city");

// cURL
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'http://api.novaposhta.ua/v2.0/json/Address/getCities');
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER	, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-type: application/json'
]);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode([
        "modelName" => "Address",
        "calledMethod" => "getCities",
        "apiKey" => "5bd4dd448fed718052dc3d242ee4337f"
])); 

$data = curl_exec($ch); 
curl_close($ch);

// get respons data
$data = json_decode($data, true);

// DB add
foreach($data['data'] as $value){
    $val = "'".$value['DescriptionRu']."', '".$value['Ref']."'";
    $insert = 'DescriptionRu, Ref';

    try {
        $stmt = $dbh->prepare("INSERT INTO city (".$insert.") VALUES (".$val.")");
        $stmt->execute();
    } catch (PDOException $e) {
        die('Ошибка запроса: ' . $e->getMessage());
    }
}