<?php
session_start();
//If user is not logged in, will not allow them to access this page and will redirect to the login page
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
}
else {
    header("location: page_login.php");
}
?>
<?php
include "header.php";
include '../../Model/dbfunctions.php';
include "nav.php";
?>

<?php

$bookdetails = select_one_book($_GET['BookID']);
    
?>
<div class="page-flex-container">
    <h2>Edit book details</h2>
    <form class="form-flex" id="update_form">
        <fieldset>
            <div class="left-column">
                <label for="booktitle">Book Title: </label>
                <input id="booktitle" name="BookTitle" type="text" value="<?php echo $bookdetails['BookTitle'];?>">
                <label for="yearofpub">Year of Publication: </label>
                <input id="yearofpub" name="YearOfPublication" type="text" value="<?php echo $bookdetails['YearofPublication'];?>">
                <label for="authorname">Author's Name: </label>
                <input id="authorname" name="Name" type="text" value="<?php echo $bookdetails['Name'];?>">
                <label for="authorsurname">Author's Surname: </label>
                <input id="authorsurname" name="Surname" type="text" value="<?php echo $bookdetails['Surname'];?>">
                <label for="sold">Millions Sold: </label>
                <input id="sold" name="MillionsSold" type="text" value="<?php echo $bookdetails['MillionsSold'];?>">
                <button type="button" id="update" onclick="updateBook(<?php echo $_GET['BookID']; ?>)">Update Book</button>
            </div>
            <div id='errorsection'> 
                <?php
                //if $_SESSION['error'] is not set then set it as nothing to eliminate an undeclared variable error
                if (!isset($_SESSION['error'])){
                    $_SESSION['error'] = "";
                }
                echo $_SESSION['error'];       
                unset ($_SESSION['error']); //this line clears what is set in the session variable['error']
                ?>
            </div>    
        </fieldset>
    </form>
</div>
<?php
    include "footer.php";
?>