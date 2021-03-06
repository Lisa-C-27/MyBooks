<?php

session_start();
require_once('../model/dbfunctions.php');
require_once("../model/connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") { //If the form values have been posted then continue with below code
    
    $username = !empty($_POST['username'])? sanitise_input(($_POST['username'])): null;
    $password = !empty($_POST['password'])? sanitise_input(($_POST['password'])): null;

    try{
        $stmt = $conn->prepare("SELECT * FROM userlogin 
        INNER JOIN admin ON admin.userLoginID = userlogin.userloginID 
        WHERE userlogin.username = :user");
        $stmt->bindParam(':user', $username);
        $stmt->execute();
        $rows = $stmt->fetch();

        if (password_verify($password, $rows['password'])){
            $_SESSION['loggedin'] = true;
            $_SESSION['adminID'] = $rows['adminID'];
            $_SESSION['role'] = $rows['role'];
            header('location: ../view/html/index.php');

        } else {
            $_SESSION['message'] = "Incorrect username or password";
            header("location: ../view/html/page_login.php");
        }
    }
    catch(PDOException $e) {
      echo "Login Error".$e -> getMessage();
      die();
    }
}

?>