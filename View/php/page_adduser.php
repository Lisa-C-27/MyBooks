<?php
session_start();
//If user is not logged in as Manager, will not allow them to access this page and will redirect to the index page
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] && $_SESSION['role'] == 'Manager') {
}
else {
    header("location: index.php");
}
?>
<?php
    include "header.php";
?>

<?php
    include "nav.php";
?>
<div class="page-flex-container">
    <h2>Add user</h2>
</div>

<?php
    include "footer.php";
?>