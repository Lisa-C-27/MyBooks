<?php
    session_start();
?>
<?php
//Upon user clicking logout, unset these session values and redirect to login page
    unset($_SESSION['loggedin']);
    unset($_SESSION['adminID']);
    unset($_SESSION['role']);
    $_SESSION['message'] = "Successfully logged out";
    header("location: ../view/html/page_login.php");
?>