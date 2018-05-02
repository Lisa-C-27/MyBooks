<?php
session_start();
//Checks if user is logged in, if they are allows the page to load, if not redirects them to the login page
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
        <div id="errorsection" class="form-group-row">
            <?php
            //if $_SESSION['error'] is not set then set it as nothing to eliminate an undeclared variable error
            if (!isset($_SESSION['message'])){
                $_SESSION['message'] = "";
            }
            echo $_SESSION['message'];       
            unset ($_SESSION['message']); //this line clears what is set in the session variable['error']
            ?>
        </div>

        <?php
            $allbooks = getAllBooks();
//Runs a loop to display each book from the database
            foreach($allbooks as $row) {

                echo '<section class="inner-book-container" id="'. $row['BookID'] . '">';
                    echo '<article class="book_top">';
                        echo '<p class="book_title">'. $row['BookTitle'] . '</p>';
                        echo '<p>'. $row['YearofPublication'] . '</p>';
                    echo '</article>';
                    echo '<img src="' . $row['imageURL'] . '">';
                    echo '<article class="book_bottom">';
                        echo '<p>'. $row['Name'] . ' '. $row['Surname'] . '</p>';
                        echo '<p>Millions Sold: ' . $row['MillionsSold'] . '</p>';
                    echo '</article>';
                    echo '<div class="edit_delete_container">';
                        echo '<a class="buttonlink" href="page_editbook.php?BookID='. $row['BookID'] . '">';
                        echo '<button type="button" class="btn btn-primary btn-inline" value="edit">Edit</button>';
                        echo '</a>';
                        echo '<button type="button" class="btn btn-primary btn-inline" value="delete" onclick="deleteBook(' . $row['BookID'] . ')">Delete</button>';
                    echo '</div>';
                echo '</section>';
            }
        ?>
    </form>

<?php
include 'footer.php';
?>