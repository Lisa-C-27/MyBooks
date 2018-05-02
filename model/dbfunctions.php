<?php

//Selecting all books function
function getAllBooks() {
    $booksql = "SELECT * From book 
    INNER JOIN author ON author.AuthorID = book.AuthorID 
    INNER JOIN image ON image.imageID = book.imageID;";
    include 'connect.php';
    $stmt = $conn->prepare($booksql);
    $stmt->execute();
    return $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

//Delete one book function
function delete_book($BookID) {
    $delete_sql = "DELETE FROM book 
    WHERE BookID='" . $_GET['BookID'] . "'";
    include 'connect.php';
    $stmt = $conn->prepare($delete_sql);
    $result = $stmt->execute();
    return $result;
}

//Selecting one book function
function select_one_book($BookID) {
    $select_sql = "SELECT * FROM book
    INNER JOIN author ON author.AuthorID = book.AuthorID 
    WHERE BookID='" . $_GET['BookID'] . "'";
    include 'connect.php';
    $stmt = $conn->prepare($select_sql);
    $stmt->execute();
    return $result = $stmt->fetch(PDO::FETCH_ASSOC);
}

//Selecting update details function for bookupdates info page
function allUpdateDetails() {
    $updateDetails = "SELECT book.BookTitle, CONCAT(admin.firstName, ' ', admin.lastName) AS 'Admin', update_book.lastUpdated, admin.role 
    FROM `update_book` 
    INNER JOIN admin ON admin.adminID = update_book.adminID 
    INNER JOIN book ON book.BookID = update_book.bookID 
    ORDER BY update_book.lastUpdated DESC;";
    include 'connect.php';
    $stmt = $conn->prepare($updateDetails);
    $stmt->execute();
    return $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

//Input sanitisation function
function sanitise_input($input_string) {
    include 'connect.php';
    $input_string = trim($input_string);
    $input_string = stripslashes($input_string);
    $input_string = htmlspecialchars($input_string);
    $input_string = strip_tags($input_string);
    return $input_string;
}

?>
