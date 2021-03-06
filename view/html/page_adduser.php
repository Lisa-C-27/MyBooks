<?php
session_start();
//If user is not logged in as Manager, will not allow them to access this page and will redirect to the index page
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] && $_SESSION['role'] == 'Manager') {
}
else {
    header("location: index.php");
}

include 'header.php';
include 'nav.php';
include '../../model/connect.php';
include '../../model/dbfunctions.php';
?>
<!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">Add User</a>
        </li>
        <li class="breadcrumb-item active">Add User</li>
    </ol>
    <form method="post" action="../../Controller/registration_process.php" class="form-add">
        <h2 class="text-center">Add User</h2>
        <div class="form-group">
            <input id="fname" class="form-control" name="firstName" type="text" placeholder="Name" pattern="[A-Za-z\s\-']{1,30}" required title="Please enter the employee's name. This field can only contain letters, spaces, hyphens and apostrophes">
        </div>
        <div class="form-group">
            <input id="lname" class="form-control" name="lastName" type="text" placeholder="Surname" pattern="[A-Za-z\s\-']{1,30}" required title="Please enter the employee's surname. This field can only contain letters, spaces, hyphens and apostrophes">
        </div>
        <div class="form-group">
            <input id="newusername" class="form-control" name="username" type="text" placeholder="Username" pattern="[A-Za-z0-9]{1,20}" title="Please enter a username for the employee. This field can only contain 'letters' and 'numbers' up to a maximum of 20.">
        </div>
        <div class="form-group">
            <input id="password" name="password" type="password" class="form-control"placeholder="Password" pattern=".{7,30}" title="Password must be a minimum of 7 characters.">             
        </div>
        <div class="form-group">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="role" id="bookkeeper" value="Bookkeeper" checked>
                <label class="form-check-label" for="bookkeeper">
                Bookkeeper
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="role" id="manager" value="Manager">
                <label class="form-check-label" for="manager">
                Manager
                </label>
            </div>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary" id="adduser" name="adduser">Add New User</button>
        </div>
        <div id='errorsection'> 

            <?php

                //if $_SESSION['message'] is not set then set it as nothing to eliminate an undeclared variable error
                if (!isset($_SESSION['message'])){
                    $_SESSION['message'] = "";
                }  
                echo $_SESSION['message'];       
                unset ($_SESSION['message']); //this line clears what is set in the session variable['message']
            ?>
        </div>
    </form>


<?php
include 'footer.php';
?>