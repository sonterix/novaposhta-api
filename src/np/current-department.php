<?php

// check for POST request
!$_POST['cityKey'] ? die('403 Forbidden') : '';

// connect to db
require_once 'connect.php';

// clean POST string
$cityKey =  strip_tags(trim($_POST["cityKey"]));

// select data from db where city name equals $search
$stm = $dbh->prepare("SELECT * FROM np_departments WHERE city_ref LIKE :cityKey");
$stm->execute([':cityKey' => '%'.$cityKey.'%']);

// check query result
$stm->rowCount() == 0 ? die('No result') : '';
    
// get data in $data array
$departmentResult = $stm->fetchAll();

foreach($departmentResult as $value){
    $results[]= [
        'id' => $value['ref'],
        'text' => $value['description_ru']
    ];  
}

// convert data to correct numbers and send data json to form
echo json_encode($results, JSON_NUMERIC_CHECK);

