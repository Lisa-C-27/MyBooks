<?php
//session_start();
//header('Content-Type: application/json');
// include 'connect.php';

function getAllBooks() {
    $booksql = "SELECT * From book 
    INNER JOIN author ON author.AuthorID = book.AuthorID 
    INNER JOIN image ON image.imageID = book.imageID;";
    include 'connect.php';
    $stmt = $conn->prepare($booksql);
    $stmt->execute();
    return $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function delete_book($BookID) {
    $delete_sql = "DELETE FROM book WHERE BookID='" . $_GET['BookID'] . "'";
    include 'connect.php';
    $stmt = $conn->prepare($delete_sql);
    $result = $stmt->execute();
    return $result;
}

function select_one_book($BookID) {
    $select_sql = "SELECT * FROM book
    INNER JOIN author ON author.AuthorID = book.AuthorID WHERE BookID='" . $_GET['BookID'] . "'";
    include 'connect.php';
    $stmt = $conn->prepare($select_sql);
//    $result = $stmt->execute();
//    return $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->execute();
    return $result = $stmt->fetch(PDO::FETCH_ASSOC);
}

function updateOneBook($postdata, $BookID) {
    $btitle = sanitise_input($postdata['BookTitle']);
    $yop = sanitise_input($postdata['YearofPublication']);
    $name = sanitise_input($postdata['Name']);
    $surname = sanitise_input($postdata['Surname']);
    $mils = sanitise_input($postdata['MillionsSold']);
    
    include 'connect.php';
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
//    $stmt->bindParam(':sname', $postdata['Surname'], PDO::PARAM_STR);
//    $stmt->bindParam(':mils', $postdata['MillionsSold'], PDO::PARAM_STR);
//    $stmt->bindParam(':bid', $BookID, PDO::PARAM_INT);
    $stmt->execute(); 
    if ($stmt->rowCount() > 0) {  
        $adminID = ($_SESSION['adminID']);
        $insertupdate = "INSERT INTO update_book (adminID, bookID) VALUES ('$adminID','$BookID')";
        $stmt = $conn->prepare($insertupdate);
        $stmt->execute();
        return true;
    } else {
        return false;
    }
}

function allUpdateDetails() {
    $updateDetails = "SELECT book.BookTitle, CONCAT(admin.firstName, ' ', admin.lastName) AS 'Admin', update_book.lastUpdated, admin.role FROM `update_book` 
    INNER JOIN admin ON admin.adminID = update_book.adminID 
    INNER JOIN book ON book.BookID = update_book.bookID 
    ORDER BY update_book.lastUpdated DESC;";
    include 'connect.php';
    $stmt = $conn->prepare($updateDetails);
    $stmt->execute();
    return $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
//need to sanitise input on the $postdata before the bindparam
function sanitise_input($input_string) {
    include 'connect.php';
    $input_string = trim($input_string);
    $input_string = stripslashes($input_string);
    $input_string = htmlspecialchars($input_string);
    $input_string = strip_tags($input_string);
    return $input_string;
}
//function edit_book($BookID) {
//    $edit_sql = ""
//}
?>
