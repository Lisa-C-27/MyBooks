<?php
session_start();
include '../model/connect.php';
include '../model/dbfunctions.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") { //If the form values have been posted then continue with below code
    
	//input sanitisation
	$booktitle = !empty($_POST['BookTitle'])? sanitise_input(($_POST['BookTitle'])): null; 
	$original = !empty($_POST['OriginalTitle'])? sanitise_input(($_POST['OriginalTitle'])): null;
    $yop = !empty($_POST['YearOfPublication'])? sanitise_input(($_POST['YearOfPublication'])): null;
    $genre = !empty($_POST['Genre'])? sanitise_input(($_POST['Genre'])): null;
    $mils = !empty($_POST['MillionsSold'])? sanitise_input(($_POST['MillionsSold'])): null;
    $lang = !empty($_POST['LanguageWritten'])? sanitise_input(($_POST['LanguageWritten'])): null;
    $rank = !empty($_POST['RankingScore'])? sanitise_input(($_POST['RankingScore'])): null;
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
            // Below code checks if the author already exists in the database, if it does grab the AuthorID from the result, if it doesn't then runs the insert statement
            $selectauthor = "SELECT * FROM author 
            WHERE Name = '$name' AND Surname = '$surname'";
            $stmt = $conn->prepare($selectauthor);
            $stmt->execute();
            $result = $stmt->fetch();
            
            if($stmt->rowCount() > 0){
                $authorID = $result['AuthorID'];
            } else {
                $insertauthor = "INSERT INTO author (Name, Surname, Nationality, BirthYear, DeathYear) 
                VALUES (:name, :surname, :nat, :birth, :death)";
                $stmt = $conn->prepare($insertauthor);
                $stmt->bindParam(':name', $name, PDO::PARAM_STR);
                $stmt->bindParam(':surname', $surname, PDO::PARAM_STR);
                $stmt->bindParam(':nat', $nat, PDO::PARAM_STR);
                $stmt->bindParam(':birth', $birth, PDO::PARAM_INT);
                $stmt->bindParam(':death', $death, PDO::PARAM_INT);
                $stmt->execute();
                $authorID = $conn->lastInsertID();

            }
            
            // Below code checks that the correct image file type has been uploaded, and if correct then create a copy of this image into the image folder and will create the URL to later be used for database insertion
            if (($_FILES['imageURL']['type'] == "image/png") || ($_FILES['imageURL']['type'] == "image/jpeg") || ($_FILES['imageURL']['type'] == "image/jpg")) {
                $upload = '../view/img/BookCovers/';
                $uploadfile = $upload . basename($_FILES['imageURL']['name']);

                echo "<p>";
                    if (move_uploaded_file($_FILES['imageURL']['tmp_name'], $uploadfile)) {
                        echo "File is valid, and was successfully uploaded.\n";
                    } else {
                        echo "File upload failed";
                    }
                echo "</p>";
    
                $uploadshort = '../img/BookCovers/';
                $uploadfileshort = $uploadshort . basename($_FILES['imageURL']['name']);
            
                // Below code checks if the imageurl already exists in the database, if it does grab the imageID from the result, if it doesn't then runs the insert statement
                $selectimage = "SELECT * FROM image 
                WHERE imageurl= '$uploadfileshort'";
                $stmt = $conn->prepare($selectimage);
                $stmt->execute();
                $result = $stmt->fetch();
            
                if($stmt->rowCount() > 0){
                    $imageID = $result['imageID'];
                } else {
                    $insertimage = "INSERT INTO image (imageURL) 
                    VALUES ('$uploadfileshort')";
                    $conn->exec($insertimage);
                    $imageID = $conn->lastInsertId();
                }
            } else {
                $_SESSION['message'] = "Book upload failed due to incorrect file type for image";
                header('Location: ../view/html/page_addbook.php');
            }
            
            $insertbook = "INSERT INTO book (BookTitle, OriginalTitle, YearofPublication, Genre, MillionsSold, LanguageWritten, AuthorID, imageID) VALUES (:btitle, :original, :yop, :genre, :mils, :lang, :authorID, :imageID)";
            $stmt = $conn->prepare($insertbook);
            $stmt->bindParam(':btitle', $booktitle, PDO::PARAM_STR);
            $stmt->bindParam(':original', $original, PDO::PARAM_STR);
            $stmt->bindParam(':yop', $yop, PDO::PARAM_STR);
            $stmt->bindParam(':genre', $genre, PDO::PARAM_STR);
            $stmt->bindParam(':mils', $mils, PDO::PARAM_INT);
            $stmt->bindParam(':lang', $lang, PDO::PARAM_STR);
            $stmt->bindParam(':authorID', $authorID, PDO::PARAM_INT);
            $stmt->bindParam(':imageID', $imageID, PDO::PARAM_INT);
            $stmt->execute();
            $bookID = $conn->lastInsertID();
            
            $insertplot = "INSERT INTO bookplot (Plot, PlotSource, BookID) 
            VALUES (:plot, :plotsource, :bookID)";
            $stmt = $conn->prepare($insertplot);
            $stmt->bindParam(':plot', $plot, PDO::PARAM_STR);
            $stmt->bindParam(':plotsource', $plotsource, PDO::PARAM_STR);
            $stmt->bindParam(':bookID', $bookID, PDO::PARAM_INT);
            $stmt->execute();
            
            $insertrank = "INSERT INTO bookranking (RankingScore, BookID) 
            VALUES (:rank, :bookID)";
            $stmt = $conn->prepare($insertrank);
            $stmt->bindParam(':rank', $rank, PDO::PARAM_INT);
            $stmt->bindParam(':bookID', $bookID, PDO::PARAM_INT);
            $stmt->execute();
            
            $insertupdate = "INSERT INTO update_book (adminID, bookID) 
            VALUES ('$adminID','$bookID')";
            $stmt = $conn->prepare($insertupdate);
            $stmt->bindParam(':adminID', $adminID, PDO::PARAM_INT);
            $stmt->bindParam(':bookID', $bookID, PDO::PARAM_INT);
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