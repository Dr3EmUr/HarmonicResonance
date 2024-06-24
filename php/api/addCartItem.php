<?php

    include "../components/utility/apiAuthCheck.php";
    include "../components/utility/dbConnection.php";

    $_POST = json_decode(file_get_contents('php://input'), true);

    if (!isset($_POST["itemId"]))
    {
        echo "oggetto non trovato";
        http_response_code(400);
        exit();
    }

    
    $itemId = $_POST["itemId"];
    $accountId = $_SESSION["accountId"];

    $sql = "INSERT INTO cartItem (accountId,itemId)";
    $sql .= "VALUES ($accountId,$itemId)";

    $result = $conn->query($sql);

    if ($conn->errno)
    {
        echo "C'è stato un errore nell'inserimento nel carrello";
        http_response_code(500);
        exit();
    }