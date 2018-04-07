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
include '../../Model/connect.php';
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
            <div class="form-group row">
                <label for="booktitle" class="col-form-label">Book Title: </label>
                <input class="form-control" id="booktitle" name="BookTitle" type="text" value="<?php echo $bookdetails['BookTitle'];?>">
            </div>
            <div class="form-group row">
                <label for="yearofpub" class="col-form-label">Year of Publication: </label>
                <input class="form-control" id="yearofpub" name="YearofPublication" type="text" value="<?php echo $bookdetails['YearofPublication'];?>">
            </div>
            <div class="form-group row">
                <label for="authorname" class="col-form-label">Author's Name: </label>
                <input class="form-control" id="authorname" name="Name" type="text" value="<?php echo $bookdetails['Name'];?>">
            </div>
            <div class="form-group row">
                <label for="authorsurname" class="col-form-label">Author's Surname: </label>
                <input class="form-control" id="authorsurname" name="Surname" type="text" value="<?php echo $bookdetails['Surname'];?>">
            </div>
            <div class="form-group row">
                <label for="sold" class="col-form-label">Millions Sold: </label>
                <input class="form-control" id="sold" name="MillionsSold" type="text" value="<?php echo $bookdetails['MillionsSold'];?>">
            </div>
            <div class="form-group row">
                <button type="button" id="update" onclick="updateBook(<?php echo $_GET['BookID']; ?>)">Update Book</button>
            </div>
            <div id="errorsection"> 
                Message section
                <?php
                //if $_SESSION['error'] is not set then set it as nothing to eliminate an undeclared variable error
                if (!isset($_SESSION['message'])){
                    $_SESSION['message'] = "";
                }
                echo $_SESSION['message'];       
                unset ($_SESSION['message']); //this line clears what is set in the session variable['error']
                ?>
            </div>    
        </fieldset>
    </form>
</div>
<?php
    include "footer.php";
?>