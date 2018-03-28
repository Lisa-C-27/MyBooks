<?php
// hello lisa =)
session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
}
else {
    header("location: page_login.php");
}
?>
<?php
    include "header.php"; //loads the header

    include "nav.php"; //loads the navigation bar
include '../../Model/dbfunctions.php'; //loads all database functions file
?>
<div class="page-flex-container">
    <h2>Books Library</h2>
    <div class="outer-book-container">
        <form id="deletebutton">
        <?php

// Need to move this into a funtion in the dbfunctions file - change the below foreach loop to a form

    $imagesql = "SELECT book.BookID, book.BookTitle, book.YearofPublication, image.imageURL, author.Name, author.Surname, book.MillionsSold
From book
INNER JOIN author ON author.AuthorID = book.AuthorID
INNER JOIN image ON image.imageID = book.imageID;";
//    $conn = new PDO("mysql:host=localhost;dbname=mybooks", 'root', '');
//    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare($imagesql);
    $stmt->execute();
    $result = $stmt->fetchAll();
    foreach($result AS $row) {

        echo '<section class="inner-book-container">
        <article class="book_top">
        <p class="book_title">'. $row['BookTitle'] . '</p>
        <p>'. $row['YearofPublication'] . '</p>
        </article>
        <img src="' . $row['imageURL'] . '">
        <article class="book_bottom">
        <p>'. $row['Name'] . ' '. $row['Surname'] . '</p>
        <p>Millions Sold: ' . $row['MillionsSold'] . '</p>
        </article>
        <div class="edit_delete_container">
            <button class="btn btn-primary btn-inline" value="edit"><a class="buttonlink" href="page_editbook.php?BookID='. $row['BookID'] . '">Edit</a></button>
            <button class="btn btn-primary btn-inline" value="delete" onclick="deleteBook(' . $row['BookID'] . ')">Delete</button>
        </div>
        </section>';
    }
?>
        </form>
    </div>
</div>

<?php
    include "footer.php"; //loads the footer
?>