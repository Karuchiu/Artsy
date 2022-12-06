<?php
include('../functions/myfunctions.php');
if (isset($_SESSION['auth'])) {
    if ($_SESSION['role_as'] == 0) {
        redirect("../index.php","You are not authorised in this page");
    }
} else {
    redirect("../login.php", "Log in to continue");
}
