<?php
session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
}
else {
    header("location: page_login.php");
}
include 'header.php';
include 'nav.php';
include '../../model/connect.php';
include '../../model/dbfunctions.php';
?>
<!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">View Books</a>
        </li>
        <li class="breadcrumb-item active">All Books</li>
    </ol>
<form id="deletebutton">

<?php
    $allbooks = getAllBooks();
    
    foreach($allbooks as $row) {

        echo '<section class="inner-book-container" id="'. $row['BookID'] . '">
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
            <button type="button" class="btn btn-primary btn-inline" value="edit"><a class="buttonlink" href="page_editbook.php?BookID='. $row['BookID'] . '">Edit</a></button>
            <button type="button" class="btn btn-primary btn-inline" value="delete" onclick="deleteBook(' . $row['BookID'] . ')">Delete</button>
        </div>
        </section>';
    }
?>
</form>

<?php
include 'footer.php';
?>