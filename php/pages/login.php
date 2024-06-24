<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Harmonic Resonance</title>
    <?php include "../components/dependencies.php"?>
    <?php include "../components/utility/dbConnection.php"?>
</head>
    <body>
        <?php include "../components/navbar.php" ?>

        <form Action = "../api/login.php" method = "POST"
        class = "flex flex-col py-20 items-center w-full min-h-[calc(100%-55px)] h-fit bg-selected">

        <h1 class = " font-inria font-bold text-white text-4xl mb-10">Inserisci i tuoi dati per il login</h1>
            <div id ="actualForm" class = " bg-navbar border-2 border-[var(--smallTitleColor)] rounded-xl w-[550px] px-14 py-10
            flex flex-col gap-2 justify-center">
                <h2 class = "font-inria font-bold text-2xl text-white text-center">Login</h2>

                <?php formInputWithLabel("Username","username","text") ?>
                <?php formInputWithLabel("Password","password","password") ?>
                
                <input  type = "submit" value = "Procedi" class = " mt-5 button-shape-2 bg-selected font-inder text-white text-lg
                border-2 border-smallSelection"></input>


            </div>

            

        </form>

    <?php include "../components/footer.php" ?>
    </body>
</html>
