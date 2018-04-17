<?php
session_start();
header('Content-Type: application/json');
include '../Model/connect.php';
include '../Model/dbfunctions.php';

if(isset($_GET['BookID'])) {
    $result = select_one_book($_GET['BookID']);
    if(is_array($result)) {
        echo json_encode($result);
    } else {
        echo json_encode(Array('userdata'=>false));
    }
    
}
if(isset($_GET['BookID'])) {
    if(updateOneBook($_POST, $_GET['BookID'])) {
        return true;
//        echo json_encode(Array('userUpdate'=>true ));
    } else {
        return false;
//        echo json_encode(Array('userUpdate'=>false ));
    }
    exit();
}
?>