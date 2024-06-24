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

    
    $email = $_POST["email"];
    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM account WHERE email = '$email' OR username = '$username'";

    $result = $conn->query($sql);

    if ($result->num_rows != 0)
    {
        echo "Account già presente!";
        exit(0);
    }

    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO account (username,passwordHash,email)\n";
    $sql .= "VALUES('$username','$passwordHash','$email')";

    echo $sql;

        
    $result = $conn->query($sql);

    if ($result)
    {
        echo "Registrazione avvenuta correttamente!";
        header("location: ../pages/login.php");
    }
    else
    {
        echo "C'è stato un problema";
    }
    
    ?>
    
</body>
</html>