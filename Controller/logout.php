<?php
    session_start();
?>
<?php
    unset($_SESSION['loggedin']);
    unset($_SESSION['adminID']);
    unset($_SESSION['role']);
    $_SESSION['message'] = "Successfully logged out";
    header("location: ../view/html/page_login.php");
    unset($_SESSION['message']);
?>