<?php
session_start();
include '../model/connect.php';
include '../model/dbfunctions.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") { //if the form values has been posted
	//input sanitation
	$booktitle = !empty($_POST['BookTitle'])? sanitise_input(($_POST['BookTitle'])): null; //if the POST username is not empty then(?) get the value and complete the try section, else(:) set the value to null
	$original = !empty($_POST['OriginalTitle'])? sanitise_input(($_POST['OriginalTitle'])): null;
    $yop = !empty($_POST['YearOfPublication'])? sanitise_input(($_POST['YearOfPublication'])): null;
    $genre = !empty($_POST['Genre'])? sanitise_input(($_POST['Genre'])): null;
    $mils = !empty($_POST['MillionsSold'])? sanitise_input(($_POST['MillionsSold'])): null;
    $lang = !empty($_POST['LanguageWritten'])? sanitise_input(($_POST['LanguageWritten'])): null;
    $rank = !empty($_POST['RankingScore'])? sanitise_input(($_POST['RankingScore'])): null;
    $image = !empty($_POST['imageURL'])? sanitise_input(($_POST['imageURL'])): null;
    $plot = !empty($_POST['Plot'])? sanitise_input(($_POST['Plot'])): null;
    $plotsource = !empty($_POST['PlotSource'])? sanitise_input(($_POST['PlotSource'])): null;
    $name = !empty($_POST['Name'])? sanitise_input(($_POST['Name'])): null;
    $surname = !empty($_POST['Surname'])? sanitise_input(($_POST['Surname'])): null;
    $nat = !empty($_POST['Nationality'])? sanitise_input(($_POST['Nationality'])): null;
    $birth = !empty($_POST['BirthYear'])? sanitise_input(($_POST['BirthYear'])): null;
    $death = !empty($_POST['DeathYear'])? sanitise_input(($_POST['DeathYear'])): null;
    $adminID = ($_SESSION['adminID']);
    
    try {
        if(isset($_POST['addbook'])) {
            $insertauthor = "INSERT INTO author (Name, Surname, Nationality, BirthYear, DeathYear) VALUES ('$name','$surname','$nat','$birth','$death')";
            $conn->exec($insertauthor);
            $authorID = $conn->lastInsertId();
            
            $insertimage = "INSERT INTO image (imageURL) VALUES ('$image')";
            $conn->exec($insertimage);
            $imageID = $conn->lastInsertId();
            
            $insertbook = "INSERT INTO book (BookTitle, OriginalTitle, YearofPublication, Genre, MillionsSold, LanguageWritten, AuthorID, imageID) VALUES ('$booktitle','$original','$yop','$genre','$mils','$lang','$authorID','$imageID')";
            $conn->exec($insertbook);
            $bookID = $conn->lastInsertId();
            
            $insertplot = "INSERT INTO bookplot (Plot, PlotSource, BookID) VALUES ('$plot','$plotsource','$bookID')";
            $conn->exec($insertplot);
            
            $insertrank = "INSERT INTO bookranking (RankingScore, BookID) VALUES ('$rank','$bookID')";
            $conn->exec($insertrank);
            
            $insertupdate = "INSERT INTO update_book (adminID, bookID) VALUES ('$adminID','$bookID')";
            $stmt = $conn->prepare($insertupdate);
            $stmt->execute();
            
            $_SESSION['message'] = "Book added successfully";
            header('Location: ../view/html/page_addbook.php');
        }
    }
     catch(PDOException $e) {
        echo "Error: ".$e -> getMessage();
        die();
    }
}
?>