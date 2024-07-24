<?php

//disconnect calendar

    session_start();
    session_unset();
    session_destroy();
    header('Location: ../config/auth.php');
    exit();

?>