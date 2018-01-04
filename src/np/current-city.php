<?php

// check for POST request
!$_POST['search'] ? die('403 Forbidden') : '';

// connect to db
require_once 'connect.php';

// clean POST string
$search = strip_tags(trim($_POST['search'])); 

// select data from db where city name equals $search
$stm = $dbh->prepare("SELECT ref, description_ru FROM np_cities WHERE description_ru LIKE :search");
$stm->execute([':search' => $search.'%']);

// check query result
$stm->rowCount() == 0 ? die('No result') : '';

// get data in $data array
$cityResult = $stm->fetchAll();

foreach($cityResult as $value){
    $results[] = [
        'id' => $value['ref'],
        'text' => $value['description_ru']
    ];
}

// send data json to form
echo json_encode($results);