<?php
    session_start();
    include '../model/connect.php';
    include '../model/dbfunctions.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") { //If the form values have been posted then continue with below code
    
        //input sanitisation
        $username = !empty($_POST['username'])? sanitise_input(($_POST['username'])): null; 
        $password2 = !empty($_POST['password'])? sanitise_input(($_POST['password'])): null;
        $name = !empty($_POST['firstName'])? sanitise_input(($_POST['firstName'])): null;
        $surname = !empty($_POST['lastName'])? sanitise_input(($_POST['lastName'])): null;
        $role = ($_POST['role']);
        // PASSWORD_HASH
        $password= password_hash($password2, PASSWORD_DEFAULT);
        try {
            if(isset($_POST['adduser'])){    //this will run the action on form submit name

                //Below code checking if username exists, if it doesn't create new user if it does exist lets user know that is already exists
                $login_sql = "SELECT * FROM userlogin WHERE username = '$username'";
                $stmt = $conn->prepare($login_sql);
                $stmt->execute();
                $result = $stmt->fetch();

                if ($stmt->rowCount() == 0){
                    $insertuser = "INSERT INTO userlogin (username, password) 
                    VALUES(:username, :password)";
                    $stmt = $conn->prepare($insertuser);
                    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
                    $stmt->bindParam(':password', $password, PDO::PARAM_STR);
                    $stmt->execute();
                    $userid = $conn->lastInsertId();

                    $insertadmin = "INSERT INTO admin (firstName, lastName, role, userLoginID) VALUES (:name, :surname, :role, :userid)";
                    $stmt = $conn->prepare($insertadmin);
                    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
                    $stmt->bindParam(':surname', $surname, PDO::PARAM_STR);
                    $stmt->bindParam(':role', $role, PDO::PARAM_STR);
                    $stmt->bindParam(':userid', $userid, PDO::PARAM_STR);
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
?>