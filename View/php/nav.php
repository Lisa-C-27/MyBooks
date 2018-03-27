<nav class="navbar navbar-toggleable-md navbar-inverse bg-inverse">
  <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <a class="navbar-brand" href="index.php">My Books</a>
  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <div class="navbar-nav">
        <a class="nav-item nav-link active" href="index.php">View Books <span class="sr-only">(current)</span></a>
        <a class="nav-item nav-link active" href="page_addbook.php">Add a Book <span class="sr-only">(current)</span></a>
        <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] && $_SESSION['role'] == 'Manager') { ?>
        <a class="nav-item nav-link active" href="page_adduser.php">Add User</a>
        <?php }; ?>
        <a class="nav-item nav-link active" href="../../Controller/logout.php">Log Out <span class="sr-only">(current)</span></a>
    </div>
  </div>
</nav>
<div class="flex-container">
<header><h1>My Books</h1></header>