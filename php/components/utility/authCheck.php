<?php

    if (!isset($_SESSION["accountId"]))
    {
        header("location: ../pages/login.php");
    }