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
            <a href="#">Book Update Details</a>
        </li>
        <li class="breadcrumb-item active">Book Update Details</li>
    </ol>
    <div class="card mb-3">
        <div class="card-header">
            <i class="fa fa-table"></i> Book Update Details
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Book Name</th>
                            <th>Admin Name</th>
                            <th>Position</th>
                            <th>Date Updated</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Book Name</th>
                            <th>Admin Name</th>
                            <th>Position</th>
                            <th>Date Updated</th>
                        </tr>
                    </tfoot>
                    <tbody>
<?php
$updateinfo = allUpdateDetails();

foreach($updateinfo as $row) {
                        echo '<tr>';
                        echo '<td>' . $row['BookTitle'] . '</td>';
                        echo '<td>' . $row['Admin'] . '</td>';
                        echo '<td>' . $row['role'] . '</td>';
                        echo '<td>' . $row['lastUpdated'];
                        echo '</tr>';
    }   
?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php
include 'footer.php';
?>