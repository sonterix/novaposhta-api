<?php

// connect to DB
require_once 'connect.php';

// delete all from table
$dbh->exec("DELETE FROM secession");

// get from api NP by 100
$i = 1;
do {
    // cURL
    $ch = curl_init();
    
        curl_setopt($ch, CURLOPT_URL, 'http://api.novaposhta.ua/v2.0/json/AddressGeneral/getWarehouses');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER	, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-type: application/json'
        ]);
    
        curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode( [
                "modelName" => "AddressGeneral",
                "calledMethod" => "getWarehouses",
                "methodProperties" => [
                    "Language" => "ru",
                    "Limit" => 100,
                    "Page" => $i
                ],
                "apiKey" => "5bd4dd448fed718052dc3d242ee4337f",
        ])); 
    
        $dataArr []= curl_exec($ch);

        $check = curl_exec($ch);
        $check = json_decode($check, true);
        $check = count($check['data']);
        
        curl_close($ch);

        $i++;
} while ($check == 100);

// get data
foreach($dataArr as $value){
    $data[] = json_decode($value, true);
}

// DB add
foreach($data as $puck){
    foreach($puck['data'] as $value){
        $val = "'".$value['CityRef']."', '".$value['Ref']."', '".$value['DescriptionRu']."'";
        $insert = 'Ref, RefSecession, DescriptionRu';

        try {
            $stmt = $dbh->prepare("INSERT INTO secession (".$insert.") VALUES (".$val.")");
            $stmt->execute();
        } catch (PDOException $e) {
            die('Ошибка запроса: ' . $e->getMessage());
        }
    }
}