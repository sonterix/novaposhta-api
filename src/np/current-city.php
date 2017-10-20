<?php
require_once 'connect.php';

$search = strip_tags(trim($_POST['q'])); 

try {
    $stm = $dbh->prepare("SELECT Ref, DescriptionRu FROM city WHERE DescriptionRu LIKE :search");
    $stm->execute([':search'=>"%".$search]);
} catch (PDOException $e) {
    die('Ошибка запроса: ' . $e->getMessage());
}

$cityRes = $stm->fetchAll();
$data = [];

if(count($cityRes) > 0){
    foreach($cityRes as $arr){
            $data[] = [
                'id' => $arr['Ref'],
                'text' => $arr['DescriptionRu']
            ];
    }
} else {
    $data[] = ['id' => 'null', 'text' => 'Результат не найден'];
}

echo json_encode($data);