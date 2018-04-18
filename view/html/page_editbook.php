<?php
session_start();
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
    <form class="form-edit" id="update_form">
        <?php
        $bookdetails = select_one_book($_GET['BookID']);
        ?>
        <h2 class="text-center">Edit book details</h2>
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
                <button class="btn btn-primary" type="button" id="update" onclick="updateBook(<?php echo $_GET['BookID']; ?>)">Update Book</button>
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