
<?php
    session_start();
    include "header.php";
?>

<div class="page-flex-container">
    <div class="login-form">
        <form method="post" action="../../Controller/userlogin.php">
            <h2 class="text-center">Login</h2>
            <div class="form-group">
                <input id="username" class="form-control" name="username" type="text" placeholder="Username">
            </div>
            <div class="form-group">
                <input id="password" name="password" type="password" class="form-control"placeholder="Password">             
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block" id="login" name="login">Login</button>
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
    </div>
</div>


<?php
    include "footer.php";
?>