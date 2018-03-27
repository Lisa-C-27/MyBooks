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
    <form class="form-flex">
        <fieldset>
            <div class="left-column">
                <label for="booktitle">Book Title: </label>
                <input id="booktitle" name="BookTitle" type="text">
                <label for="originaltitle">Original Title: </label>
                <input id="originaltitle" name="OriginalTitle" type="text">
                <label for="yearofpub">Year of Publication: </label>
                <input id="yearofpub" name="YearOfPublication" type="text">
                <label for="genre">Genre: </label>
                <input id="genre" name="Genre" type="text">
                <label for="sold">Millions Sold: </label>
                <input id="sold" name="MillionsSold" type="text">
                <label for="language">Language Written: </label>
                <input id="language" name="LanguageWritten" type="text">
                <label for="rank">Ranking Score: </label>
                <input id="rank" name="RankingScore" type="text">
                <label for="imageURL">Image URL: </label>
                <input id="imageURL" name="imageURL" type="text">
            </div>
            <div class="right-column">
                <label for="plot">Plot: </label>
                <input id="plot" name="PlotSource" type="text">
                <label for="plotsource">Plot Source: </label>
                <input id="plotsource" name="PlotSource" type="text">
                <label for="authorname">Author's Name: </label>
                <input id="authorname" name="Name" type="text">
                <label for="authorsurname">Author's Surname: </label>
                <input id="authorsurname" name="Surname" type="text">
                <label for="authnat">Author's Nationality: </label>
                <input id="authnat" name="Nationality" type="text">
                <label for="authbirth">Author's Birth Year: </label>
                <input id="authbirth" name="BirthYear" type="text">
                <label for="authdeath">Author's Year of Death: </label>
                <input id="authdeath" name="DeathYear" type="text">
            </div>
            <button type="submit" id="addbook">Add Book</button>
        </fieldset>
    </form>
</div>

<?php
    include "footer.php";
?>