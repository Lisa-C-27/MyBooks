<?php
//session_start();
//header('Content-Type: application/json');
// include 'connect.php';


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
//    $select_sql = "SELECT book.BookID, book.BookTitle, book.YearofPublication, author.Name, author.Surname, book.MillionsSold FROM book
//INNER JOIN author ON author.AuthorID = book.AuthorID WHERE BookID='" . $_GET['BookID'] . "'";
    include 'connect.php';
    $stmt = $conn->prepare($select_sql);
//    $result = $stmt->execute();
//    return $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->execute();
    return $result = $stmt->fetch(PDO::FETCH_ASSOC);
}

function updateOneBook($postdata, $BookID) {
    include 'connect.php';
    $update_sql = "UPDATE book INNER JOIN author ON author.AuthorID = book.AuthorID SET BookTitle = :btitle, YearofPublication = :yop, Name = :name, Surname = :sname, MillionsSold = :mils WHERE BookID = :bid;";

    $stmt = $conn->prepare($update_sql);
    $stmt->bindParam(':btitle', sanitise_input($postdata['BookTitle']), PDO::PARAM_STR);
    $stmt->bindParam(':yop', sanitise_input($postdata['YearofPublication']), PDO::PARAM_STR);
    $stmt->bindParam(':name', sanitise_input($postdata['Name']), PDO::PARAM_STR);
    $stmt->bindParam(':sname', sanitise_input($postdata['Surname']), PDO::PARAM_STR);
    $stmt->bindParam(':mils', sanitise_input($postdata['MillionsSold']), PDO::PARAM_STR);
    $stmt->bindParam(':bid', sanitise_input($BookID), PDO::PARAM_INT);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        return true;
    } else {
        return false;
    }
}

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
