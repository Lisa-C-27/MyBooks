<?php
session_start();
include '../model/connect.php';
include '../model/dbfunctions.php';
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
            header('location: ../view/html/page_adduser.php');
        } else {
            $_SESSION['message'] = "Username already exists";   
            header('Location: ../view/html/page_adduser.php');        
        }     
        }
    }
    catch(PDOException $e) {
        echo "Error: ".$e -> getMessage();
        die();
    }
}
             
             
             
             
             
             
             
//		if($_REQUEST['action_type'] == 'add'){ //if the action type is add
//        $data = //set the variable $data within the insertData($table,$data) function to the following array
//        array(
//            'username' => $username,
//            'password' => $password,
//            );
//		$table="login"; //table name in DB to insert data into
//		//function call from db_functions.php
//		insertData($table,$data);
//		header('location:../view/html/loggedin_page.php'); //where to redirect when registration is successful
//		}
//	}
//		catch(PDOException $e)
//		{
//			echo "Error: ".$e -> getMessage();
//			die();
//		}
//}
?>