<?php
session_start();
?>
<?php

$login_sql = "SELECT * FROM userlogin INNER JOIN admin ON admin.userLoginID = userlogin.userloginID WHERE username = '" . $_POST['username'] . "' AND password = '" . $_POST['password'] . "';";
include '../Model/connect.php';
$stmt = $conn->prepare($login_sql);
$stmt->execute();
$result = $stmt->fetch();

if ($stmt->rowCount() == 1) { 
    $_SESSION['loggedin'] = true;
    $_SESSION['adminID'] = $result['adminID'];
    $_SESSION['role'] = $result['role'];
    header('location: ../View/php/index.php'); 
}
else {  
    $_SESSION['message'] = "Incorrect username or password";
    header("location: ../View/php/page_login.php"); 
}

?>