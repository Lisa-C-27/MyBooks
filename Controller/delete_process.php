<?php
  session_start();
  header('Content-Type: application/json');
  include '../Model/connect.php';
  include '../Model/dbfunctions.php';
?>

<?php
if(isset($_GET['BookID'])) {
    if(delete_book($_GET['BookID'])) {
        echo json_encode(Array('BookDelete'=>true));
    } else {
        echo json_encode(Array('BookDelete'=>false));
    }
        exit();
}


?>
