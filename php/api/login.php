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
    include "../components/utility/dbConnection.php";

    $username = $_POST["username"];
    $passwordInput = $_POST["password"];

    $sql = "SELECT * FROM account WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows == 0)
    {
        echo "Account non trovato!";
        exit(0);
    }

    $row = $result->fetch_assoc();

    $username = $row["username"];
    $password = $row["passwordHash"];
    $accountId = $row["accountId"];

    if (!password_verify($passwordInput,$password))
    {
        echo "Password sbagliata!";
        exit(0);
    }

    $_SESSION["accountId"] = $accountId;
    $_SESSION["username"] = $username;
    $_SESSION["cognome"] = $cognome;
    $_SESSION["idSquadra"] = $idSquadra;

    echo "Login avvenuto con successo!";
    header("location: ../pages/index.php");
    ?>

    

    
    
    
</body>
</html>