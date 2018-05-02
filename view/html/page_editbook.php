<?php
session_start();
//If user is not logged in, will not allow them to access this page and will redirect to the login page
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
            <a href="index.php">View Books</a>
        </li>
        <li class="breadcrumb-item active">Edit Book</li>
    </ol>
    <form class="form-edit" id="update_form" method="post" action="../../controller/update_process.php?BookID=<?php echo $_GET['BookID'] ?>">
        <?php
        $bookdetails = select_one_book($_GET['BookID']);
        ?>
        <h2 class="text-center">Edit book details</h2>
        <fieldset>
            <div class="form-group row">
                <label for="booktitle" class="col-form-label">Book Title: </label>
                <input class="form-control" id="booktitle" name="BookTitle" type="text" value="<?php echo $bookdetails['BookTitle'];?>" pattern="[A-Za-z0-9\s\-']{1,250}" title="Please enter a book title. This field can only contain 'letters' 'numbers' 'spaces' 'hyphens' and 'apostrophes'" required>
            </div>
            <div class="form-group row">
                <label for="yearofpub" class="col-form-label">Year of Publication: </label>
                <input class="form-control" id="yearofpub" name="YearofPublication" type="text" value="<?php echo $bookdetails['YearofPublication'];?>" pattern="[0-9]{4}" title="Please enter a year eg. 1980. This field can only contain 4 numbers in length" required>
            </div>
            <div class="form-group row">
                <label for="authorname" class="col-form-label">Author's Name: </label>
                <input class="form-control" id="authorname" name="Name" type="text" value="<?php echo $bookdetails['Name'];?>" pattern="[A-Za-z\s\-']{1,30}" required title="Please enter the book author's name. This field can only contain letters, spaces, hyphens and apostrophes">
            </div>
            <div class="form-group row">
                <label for="authorsurname" class="col-form-label">Author's Surname: </label>
                <input class="form-control" id="authorsurname" name="Surname" type="text" value="<?php echo $bookdetails['Surname'];?>" pattern="[A-Za-z\s\-']{1,30}" required title="Please enter the book author's surname. This field can only contain letters, spaces, hyphens and apostrophes">
            </div>
            <div class="form-group row">
                <label for="sold" class="col-form-label">Millions Sold: </label>
                <input class="form-control" id="sold" name="MillionsSold" type="text" value="<?php echo $bookdetails['MillionsSold'];?>" pattern="[0-9]{1,10}" required title="Please enter the amount sold, to the nearest million. Can only contain numbers to a maximum of 10 in length">
            </div>
            <div class="form-group row">
                <button class="btn btn-primary" type="submit" id="update" name="updatebook">Update Book</button>
            </div>
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
        </fieldset>
    </form>

<?php
include 'footer.php';
?>
