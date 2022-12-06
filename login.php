<?php 
session_start();  
include('includes/header.php');
?>

<div class="py-4">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <?php
                if (isset($_SESSION['message'])) {
                ?>
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <?= $_SESSION['message']; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php
                    unset($_SESSION['message']);
                }
                ?>
 
                <div class="card">
                    <div class="card-header">
                        <h4>Login Form</h4>
                    </div>
                    <div class="card-body">
                        <form action="functions/authcode.php" method="POST">
                            <div class="mb-2">
                                <labelclass="form-label">Email address</label>
                                    <input type="email" name="email" class="form-control" placeholder="Enter your email">
                            </div>
                            <div class="mb-2">
                                <label class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" placeholder="Enter password">
                            </div>
                            <button type="submit" name="login_btn" class="btn btn-primary">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include('includes/footer.php'); ?>