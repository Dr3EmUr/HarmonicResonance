<?php

    include "../components/utility/apiAuthCheck.php";
    include "../components/utility/dbConnection.php";

    $_POST = json_decode(file_get_contents('php://input'), true);

    if (!isset($_POST["cartItemId"]))
    {
        echo "oggetto non trovato";
        http_response_code(400);
        exit();
    }

    $cartItemId = $_POST["cartItemId"];

    $sql = "DELETE FROM cartItem\n";
    $sql .= "WHERE cartItemId = '$cartItemId'";

    $result = $conn->query($sql);

    if ($conn->affected_rows == 0)
    {
        echo "C'è stato un errore nell'inserimento nel carrello";
        http_response_code(500);
        exit();
    }