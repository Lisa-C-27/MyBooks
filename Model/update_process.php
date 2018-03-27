<?php
session_start();
header('Content-Type: application/json');
include 'connect.php';
include 'dbfunctions.php';
?>
<?php


?>

<?php
if(isset($_GET['BookID'])) {
    $result = select_one_book($_GET['BookID']);
    if(is_array($result)) {
        echo json_encode($result);
    } else {
        echo json_encode(Array('userdata' =>false));
    }
    
}
if(isset($_POST)) {
    if(updateOneBook($_POST, $_GET['BookID'])) {
        echo json_encode(Array('userUpdate'=>true ));
    } else {
        echo json_encode('userUpdate'=>false ));
    }
    exit();
}

//if (updateOneBook($_POST, $_GET['BookID'])) {
//$_SESSION['error'] = 'done';
//    header('Location: page_editbook.php');
//} else {
//echo 'error';
//}

?>