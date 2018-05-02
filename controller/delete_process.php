<?php
  session_start();
  header('Content-Type: application/json');
  include '../model/connect.php';
  include '../model/dbfunctions.php';

//If user clicks delete, runs the deletebook() function using the correct BookID and json_encode ready for ajax
if(isset($_GET['BookID'])) {
    if(delete_book($_GET['BookID'])) {
        echo json_encode(Array('BookDelete'=>true));
    } else {
        echo json_encode(Array('BookDelete'=>false));
    }
        exit();
}


?>
