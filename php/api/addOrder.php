<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Harmonic Resonance</title>
    <?php include "../components/dependencies.php"?>
</head>
<body>
    


<?php


    include "../components/navbar.php";
    include "../components/utility/apiAuthCheck.php";
    include "../components/utility/dbConnection.php";

    // Get API parameters

    $accountId = $_SESSION["accountId"];
    $numeroCarta = $_POST["numeroCarta"];
    $intestatario = $_POST["intestatario"];
    $emailFatturazione = $_POST["emailFatturazione"];
    $cittaConsegna = $_POST["cittaConsegna"];
    $indirizzoConsegna = $_POST["indirizzoConsegna"];
    $CVV = $_POST["CVV"];
    $orderState = "Pending";
    $orderDateTime = date("y-m-d");

    $error = false;
    $conn->query("START TRANSACTION;");

    // Get the availability of an item

    $availabilitySQL = "SELECT itemId,availability 
    FROM cartItem INNER JOIN item USING (itemId)";

    $availabilityResult = $conn->query($availabilitySQL);

    // I'm not sure if this is the correct way to check for errors but whatever lol
    if ($availabilityResult == false)
        $error = true;

    while ($availabilityRow = $availabilityResult->fetch_assoc())
    {
        // delete items if their availability is 1, else reduce their availability by 1

        if ($availabilityRow["availability"] == 1)
        {
            $sql = "DELETE FROM item WHERE itemId = " . $availabilityRow["itemId"];
            $result = $conn->query($sql);

            

            if ($result == false)
                $error = true;
        }
        else
        {
            $sql = "UPDATE item SET availability = " . ($availabilityRow["availability"] - 1) ." WHERE  itemId = " . $availabilityRow["itemId"];
            $result = $conn->query($sql);

            if ($result == false)
                $error = true;
        }
    }

    // insert a new order into the database

    $sql = "INSERT INTO `order`(accountId,orderDateTime,orderState,numeroCarta,intestatario,emailFatturazione,cittaConsegna,indirizzoConsegna,CVV)\n";
    $sql .= "VALUES('$accountId','$orderDateTime','$orderState','$numeroCarta','$intestatario','$emailFatturazione','$cittaConsegna','$indirizzoConsegna','$CVV')";
    
    $result = $conn->query($sql);
    $orderId = $conn->insert_id;

    if ($result == false)
        $error = true;

    // transform the cartItems into orderItems

    $sql = "SELECT * FROM cartItem WHERE accountId = '$accountId'";
    $cartItems = $conn->query($sql);

    if ($cartItems == false)
        $error = true;

    while($cartItem = $cartItems->fetch_assoc())
    {
        $sql = "INSERT INTO orderItem(itemId,orderId) 
        VALUES ('". $cartItem["itemId"] . "','$orderId')";

        $result = $conn->query($sql);

        if ($result == false)
        $error = true;
    }

    // delete all cart items for the user
    
    $deleteCartSQL = "DELETE FROM cartItem WHERE accountId = '$accountId' AND cartItemId";
    $result = $conn->query($deleteCartSQL);

    if ($result == false)
        $error = true;

    // commit if there were no errors, rollback if there was an error

    if ($error == false)
    {
        header("location: ../pages/index.php");
        $conn->query("COMMIT;");
    }
    else
    {
        echo "C'è stato un errore nella registrazione dell'ordine";
        $conn->query("ROLLBACK;");
    }
?>
</body>
</html>