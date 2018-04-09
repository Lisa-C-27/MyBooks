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
    include "nav.php";
?>

<div class="page-flex-container">
    <h2>Add a book</h2>
    <form class="form-add">
        <fieldset>
            <div class="form-group row">
                <label for="booktitle" class="col-form-label">Book Title: </label>
                <input class="form-control" id="booktitle" name="BookTitle" type="text">
            </div>
            <div class="form-group row">
                <label for="originaltitle" class="col-form-label">Original Title: </label>
                <input class="form-control" id="originaltitle" name="OriginalTitle" type="text">
            </div>
            <div class="form-group row">
                <label for="yearofpub" class="col-form-label">Year of Publication: </label>
                <input class="form-control" id="yearofpub" name="YearOfPublication" type="text">
            </div>
            <div class="form-group row">
                <label for="genre" class="col-form-label">Genre: </label>
                <input class="form-control" id="genre" name="Genre" type="text">
            </div>
            <div class="form-group row">
                <label for="sold" class="col-form-label">Millions Sold: </label>
                <input class="form-control" id="sold" name="MillionsSold" type="text">
            </div>
            <div class="form-group row">
                <label for="language" class="col-form-label">Language Written: </label>
                <input class="form-control" id="language" name="LanguageWritten" type="text">
            </div>
            <div class="form-group row">
                <label for="rank" class="col-form-label">Ranking Score: </label>
                <input class="form-control" id="rank" name="RankingScore" type="text">
            </div>
            <div class="form-group row">
                <label for="imageURL" class="col-form-label">Image URL: </label>
                <input class="form-control" id="imageURL" name="imageURL" type="text">
            </div>
            <div class="form-group row">
                <label for="plot" class="col-form-label">Plot: </label>
                <input class="form-control" id="plot" name="PlotSource" type="text">
            </div>
            <div class="form-group row">
                <label for="plotsource" class="col-form-label">Plot Source: </label>
                <input class="form-control" id="plotsource" name="PlotSource" type="text">
            </div>
            <div class="form-group row">
                <label for="authorname" class="col-form-label">Author's Name: </label>
                <input class="form-control" id="authorname" name="Name" type="text">
            </div>
            <div class="form-group row">
                <label for="authorsurname" class="col-form-label">Author's Surname: </label>
                <input class="form-control" id="authorsurname" name="Surname" type="text">
            </div>
            <div class="form-group row">
                <label for="authnat" class="col-form-label">Author's Nationality: </label>
                <input class="form-control" id="authnat" name="Nationality" type="text">
            </div>
            <div class="form-group row">
                <label for="authbirth" class="col-form-label">Author's Birth Year: </label>
                <input class="form-control" id="authbirth" name="BirthYear" type="text">
            </div>
            <div class="form-group row">
                <label for="authdeath" class="col-form-label">Author's Year of Death: </label>
                <input class="form-control" id="authdeath" name="DeathYear" type="text">
            </div>
            <div class="form-group row">
                <button class="btn btn-primary" type="submit" id="addbook">Add Book</button>
            </div>
        </fieldset>
    </form>
</div>

<?php
    include "footer.php";
?>