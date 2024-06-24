<?php
    session_start();

    $_SESSION["accountId"] = NULL;
    $_SESSION["username"] = NULL;

    session_destroy();

    header("location: ../pages/index.php");

