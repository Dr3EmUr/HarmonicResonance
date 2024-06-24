<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Harmonic Resonance</title>
    <?php include "../components/dependencies.php"?>
    <?php include "../components/utility/authCheck.php" ?>
</head>
    <body>
        <?php include "../components/navbar.php" ?>
        <?php include "../components/utility/dbConnection.php" ?>

        <?php 
            $sql = "SELECT SUM(price) AS somma
            FROM cartItem
            INNER JOIN item USING (itemId)
            INNER JOIN itemModel USING (itemModelId)
            WHERE cartItem.accountId = " . $_SESSION["accountId"];

            $totalPrice = $conn->query($sql)->fetch_assoc()["somma"];

            if ($totalPrice == null)
            {
                $totalPrice = 0;
                header("location: ./search.php");
            }


        ?>

        <form action = "../api/addOrder.php" method = "POST" 
        class = "flex justify-around items-center w-full min-h-[calc(100%-55px)] h-fit bg-selected">

            <div id ="actualForm" class = " bg-navbar border-2 border-[var(--smallTitleColor)] rounded-xl w-[550px] px-14 py-10
            flex flex-col gap-2 justify-center">
                <h2 class = "font-inria font-bold text-2xl text-white text-center">Metodo di pagamento</h2>
            
                <div class = " flex gap-5 first:w-[500px]">
                    <?php formInputWithLabel("Intestatario","intestatario") ?>
                    <?php formInputWithLabel("CVV","CVV") ?>
                </div>

                <?php formInputWithLabel("Numero di carta","numeroCarta") ?>
                <?php formInputWithLabel("Email","emailFatturazione") ?>

                <h2 class = "font-inria font-bold text-2xl text-white text-center mt-2">Dati per la consegna</h2>

                <?php formInputWithLabel("Città","cittaConsegna") ?>
                <?php formInputWithLabel("Indirizzo","indirizzoConsegna") ?>
                



            </div>

            <div id = "Card" class = "w-[430px] h-fit
            bg-white border-2 border-smallSelection rounded-xl p-10 ">

                <h2 class = " font-inria font-bold text-3xl w-full">Il totale ammonta a € <?php echo $totalPrice ?></h2>
                <h3 class = "font-inria text-2xl my-2">Dopo aver inserito i dati per il pagamento, clicca qui per procedere</h3>

                
                <input  type = "submit" value = "Procedi" class = "button-shape-2 bg-selected font-inder text-white text-lg"></input>
                
            </div>

        </form>

    <?php include "../components/footer.php" ?>
    </body>
</html>
