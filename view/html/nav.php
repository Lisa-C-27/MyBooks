<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
        <a class="navbar-brand" href="index.php">My Books</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="View Books">
                    <a class="nav-link" href="index.php">
                        <i class="fa fa-fw fa-table"></i>
                        <span class="nav-link-text">View Books</span>
                    </a>
                </li>
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Add Book">
                    <a class="nav-link" href="page_addbook.php">
                        <i class="fa fa-fw fa-plus-square"></i>
                        <span class="nav-link-text">Add Book</span>
                    </a>
                </li>
<!--                Checks if user is logged in and role is manager and if both true                        then show 'add user' and 'Updated Books Details' link-->
                <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] && $_SESSION['role'] == 'Manager') { ?>
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Add User">
                    <a class="nav-link" href="page_adduser.php">
                        <i class="fa fa-fw fa-user-plus"></i>
                        <span class="nav-link-text">Add User</span>
                    </a>
                </li>
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Updated Book Details">
                    <a class="nav-link" href="page_bookupdates.php">
                        <i class="fa fa-fw fa-book"></i>
                        <span class="nav-link-text">Updated Book Details</span>
                    </a>
                </li>
                <?php }; ?>
            </ul>
            <ul class="navbar-nav sidenav-toggler">
                <li class="nav-item">
                    <a class="nav-link text-center" id="sidenavToggler">
                        <i class="fa fa-fw fa-angle-left"></i>
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" data-toggle="modal" data-target="#exampleModal">
                        <i class="fa fa-fw fa-sign-out"></i>Logout
                    </a>
                </li>
            </ul>
        </div>
    </nav>
<div class="content-wrapper">
    <div class="container-fluid">
      