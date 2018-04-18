<?php
  session_start();
  header('Content-Type: application/json');
  include '../model/connect.php';
  include '../model/dbfunctions.php';
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
