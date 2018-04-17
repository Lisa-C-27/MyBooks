<?php
session_start();
include '../Model/connect.php';
include '../Model/dbfunctions.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") { //if the form values has been posted
	//input sanitation
	$username = !empty($_POST['username'])? sanitise_input(($_POST['username'])): null; //if the POST username is not empty then(?) get the value and complete the try section, else(:) set the value to null
	$password2 = !empty($_POST['password'])? sanitise_input(($_POST['password'])): null;
    $name = !empty($_POST['firstName'])? sanitise_input(($_POST['firstName'])): null;
    $surname = !empty($_POST['lastName'])? sanitise_input(($_POST['lastName'])): null;
    $role = ($_POST['role']);
	// PASSWORD_HASH
	$password= password_hash($password2, PASSWORD_DEFAULT);
	try {
        if(isset($_POST['adduser'])){    //this will run the action on form submit name
            $login_sql = "SELECT * FROM userlogin WHERE username = '$username'";
            $stmt = $conn->prepare($login_sql);
            $stmt->execute();
            $result = $stmt->fetch();

        if ($stmt->rowCount() == 0){
            $insertuser = "INSERT INTO userlogin (username, password) VALUES( '$username','$password')";
            $conn->exec($insertuser);
            $last_id = $conn->lastInsertId();
            $insertadmin = "INSERT INTO admin (firstName, lastName, role, userLoginID) VALUES( '$name','$surname', '$role', '$last_id')";
            $stmt = $conn->prepare($insertadmin);
            $stmt->execute();
            $_SESSION['message'] = "User created successfully";
            header('location: ../View/php/page_adduser.php');
        } else {
            $_SESSION['message'] = "Username already exists";   
            header('Location: ../View/php/page_adduser.php');        
        }     
        }
    }
    catch(PDOException $e) {
        echo "Error: ".$e -> getMessage();
        die();
    }
}
             
?>