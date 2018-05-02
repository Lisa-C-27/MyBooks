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
            <a href="index.php">Add Book</a>
        </li>
        <li class="breadcrumb-item active">Add Book</li>
    </ol>      
    <form class="form-add" method="post" action="../../controller/addbook_process.php" enctype="multipart/form-data">
        <div id='errorsection' class="form-group-row"> 

            <?php

                //if $_SESSION['message'] is not set then set it as nothing to eliminate an undeclared variable error
                if (!isset($_SESSION['message'])){
                    $_SESSION['message'] = "";
                }  
                echo $_SESSION['message'];       
                unset ($_SESSION['message']); //this line clears what is set in the session variable['message']
            ?>
        </div>
        <h2 class="text-center">Add a book</h2>
        <fieldset>

            <div class="form-group row">
                <label for="booktitle" class="col-form-label">Book Title: </label>
                <input class="form-control" id="booktitle" name="BookTitle" type="text" pattern="[A-Za-z0-9\s\-']{1,250}" required title="Please enter a book title. This field can only contain 'letters' 'numbers' 'spaces' 'hyphens' and 'apostrophes'">
            </div>
            <div class="form-group row">
                <label for="originaltitle" class="col-form-label">Original Title: </label>
                <input class="form-control" id="originaltitle" name="OriginalTitle" type="text" pattern="[A-Za-z0-9\s\-']{1,250}" title="Please enter a book title. This field can only containe 'letters' 'numbers' 'spaces' 'hyphens' and 'apostrophes'">
            </div>
            <div class="form-group row">
                <label for="yearofpub" class="col-form-label">Year of Publication: </label>
                <input class="form-control" id="yearofpub" name="YearOfPublication" type="text" pattern="[0-9]{4}" title="Please enter a year eg. 1980. This field can only contain 4 numbers in length" required>
            </div>
            <div class="form-group row">
                <label for="genre" class="col-form-label">Genre: </label>
                <input class="form-control" id="genre" name="Genre" type="text" pattern="[A-Za-z]{1,30}" required title="Please enter the book's genre. Can only contain letters to a maximum of 30">
            </div>
            <div class="form-group row">
                <label for="sold" class="col-form-label">Millions Sold: </label>
                <input class="form-control" id="sold" name="MillionsSold" type="text" pattern="[0-9]{1,10}" required title="Please enter the amount sold, to the nearest million. Can only contain numbers to a maximum of 10 in length">
            </div>
            <div class="form-group row">
                <label for="language" class="col-form-label">Language Written: </label>
                <input class="form-control" id="language" name="LanguageWritten" type="text" pattern="[A-Za-z]{3,30}" title="Please enter the language the book was written in. This field can only contain letters between 3-30 in length">
            </div>
            <div class="form-group row">
                <label for="rank" class="col-form-label">Ranking Score: </label>
                <input class="form-control" id="rank" name="RankingScore" type="text" pattern="[0-9]{1,10}" title="Please enter a ranking score for this book. This field can only contain numbers to a maximum of 10 in length">
            </div>
            <div class="form-group row">
                <label for="imageURL" class="col-form-label">Image URL: </label>
                <input class="form-control" id="imageURL" name="imageURL" type="file" accept="image/*">
            </div>
            <div class="form-group row">
                <p class="col-form-label">Image Upload Preview: </p>
                <img id="preview" src="../img/No_image_available.svg" alt="your image" width="100px" height="100px">
            </div>
            <div class="form-group row">
                <label for="plot" class="col-form-label">Plot: </label>
                <input class="form-control" id="plot" name="Plot" type="text" pattern="[A-Za-z0-9\s\-',]{0,256}" title="Please enter the plot for this book. This field can only contain numbers, letters, spaces, hyphens, commas and apostrophes">
            </div>
            <div class="form-group row">
                <label for="plotsource" class="col-form-label">Plot Source: </label>
                <input class="form-control" id="plotsource" name="PlotSource" type="url">
            </div>
            <div class="form-group row">
                <label for="authorname" class="col-form-label">Author's Name: </label>
                <input class="form-control" id="authorname" name="Name" type="text" pattern="[A-Za-z\s\-']{1,30}" required title="Please enter the book author's name. This field can only contain letters, spaces, hyphens and apostrophes">
            </div>
            <div class="form-group row">
                <label for="authorsurname" class="col-form-label">Author's Surname: </label>
                <input class="form-control" id="authorsurname" name="Surname" type="text" pattern="[A-Za-z\s\-']{1,30}" required title="Please enter the book author's surname. This field can only contain letters, spaces, hyphens and apostrophes">
            </div>
            <div class="form-group row">
                <label for="authnat" class="col-form-label">Author's Nationality: </label>
                <input class="form-control" id="authnat" name="Nationality" type="text" pattern="[A-Za-z\s\-']{1,30}" required title="Please enter the author's nationality. This field can only contain letters, spaces, hyphens and apostrophes">
            </div>
            <div class="form-group row">
                <label for="authbirth" class="col-form-label">Author's Birth Year: </label>
                <input class="form-control" id="authbirth" name="BirthYear" type="text" pattern="[0-9]{4}" required title="Please enter the author's year of birth. This field can only contain 4 numbers in length">
            </div>
            <div class="form-group row">
                <label for="authdeath" class="col-form-label">Author's Year of Death: </label>
                <input class="form-control" id="authdeath" name="DeathYear" type="text" pattern="[0-9]{4}" title="Please enter the author's year of death if applicable. This field can only contain 4 numbers in length">
            </div>
            <div class="form-group row">
                <button class="btn btn-primary" type="submit" id="addbook" name="addbook">Add Book</button>
            </div>
        </fieldset>      
    </form>

<?php
include 'footer.php';
?>