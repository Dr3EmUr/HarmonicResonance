<?php
    session_start();

    if (!isset($_SESSION["accountId"]))
    {
        http_response_code(403);
    }