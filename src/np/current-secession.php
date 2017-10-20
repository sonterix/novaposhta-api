<?php
require_once 'connect.php';

if($_POST["key"]){
    $post =  strip_tags(trim($_POST["key"]));

    try {
        $stm = $dbh->prepare("SELECT * FROM secession WHERE Ref LIKE '%$post%'");
        $stm->execute();
    } catch (PDOException $e) {
        die('Ошибка запроса: ' . $e->getMessage());
    }
    
    $res = $stm->fetchAll();
    $data = [];

    if(count($res) > 0){
        foreach($res as $id => $arr){
                $data []= [
                    'id' => $arr['RefSecession'],
                    'text' => $arr['DescriptionRu']
                ];  
        }
    } else {
        $data[] = ['id' => 'null', 'text' => 'Результат не найден'];
    }


    echo json_encode($data, JSON_NUMERIC_CHECK);
} else {
    echo 'error secession';
}
