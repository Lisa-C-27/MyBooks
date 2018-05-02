<?php
session_start();
include '../model/connect.php';
include '../model/dbfunctions.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") { //If the form values have been posted then continue with below code
    
    //Input Sanitisation
    $btitle = sanitise_input($_POST['BookTitle']);
    $yop = sanitise_input($_POST['YearofPublication']);
    $name = sanitise_input($_POST['Name']);
    $surname = sanitise_input($_POST['Surname']);
    $mils = sanitise_input($_POST['MillionsSold']);
    $BookID = $_GET['BookID'];
    
    try {
        if(isset($_POST['updatebook'])){ //this will run the action on form submit name
            
            $update_sql = "UPDATE book 
            INNER JOIN author ON author.AuthorID = book.AuthorID 
            SET BookTitle = :btitle, YearofPublication = :yop, Name = :name, Surname = :sname, MillionsSold = :mils 
            WHERE book.BookID = :bid;";

            $stmt = $conn->prepare($update_sql);
            $stmt->bindParam(':btitle', $btitle, PDO::PARAM_STR);
            $stmt->bindParam(':yop', $yop, PDO::PARAM_STR);
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->bindParam(':sname', $surname, PDO::PARAM_STR);
            $stmt->bindParam(':mils', $mils, PDO::PARAM_STR);
            $stmt->bindParam(':bid', $BookID, PDO::PARAM_INT);

            $stmt->execute(); 
            if ($stmt->rowCount() > 0) {  
                $adminID = ($_SESSION['adminID']);
                $insertupdate = "INSERT INTO update_book (adminID, bookID) VALUES ('$adminID','$BookID')";
                $stmt = $conn->prepare($insertupdate);
                $stmt->execute();
        
                $_SESSION['message'] = "Book updated successfully";
                header('Location: ../view/html/page_editbook.php?BookID='.$_GET['BookID'].'');
            } else {
                $_SESSION['message'] = "Error updating book";
                header('Location: ../view/html/page_editbook.php?BookID='.$_GET['BookID'].'');
            }
        }
    } catch(PDOException $e) {
        echo "Error: ".$e -> getMessage();
        die();
    }
}

?>