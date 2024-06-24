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

        $accountId = $_SESSION["accountId"];
        $sql = "SELECT DISTINCT cartItemId ,itemModelName, price, color, imgPath, itemModelId FROM cartItem\n";
        $sql .= "INNER JOIN item USING (itemId)\n";
        $sql .= "INNER JOIN itemModel USING (itemModelId)\n";
        $sql .= "INNER JOIN itemModelImage USING (itemModelId)\n";
        $sql .= "WHERE cartItem.accountId = '$accountId'\n";
        $sql .= "AND itemModelImage.isMain = true\n";

        $result = $conn->query($sql);
    ?>

    <main class = "flex min-h-[calc(100%-55px)] h-fit">

        <div class = " w-2/3 h-full p-20 py-16">
            <h1 class = " font-inria font-bold text-4xl mb-10">Ecco un riepilogo dei tuoi acquisti:</h1>

            <div id = "itemsContainer" class = " w-full h-fit border-2 rounded-xl border-gray-400">
                <?php 

                    while ($row = $result->fetch_assoc())
                    {
                        $categoryQuery = "SELECT categoryId, categoryName FROM category\n
                        INNER JOIN modelCategory USING (categoryId)\n
                        WHERE itemModelId = " . $row["itemModelId"] . ";\n";

                        $categories = [];
                        $categoriesResult = $conn->query($categoryQuery);

                        while ($currentCategory = $categoriesResult->fetch_assoc())
                        {
                            $categories[] = $currentCategory["categoryName"];
                        }

                        cartItem($row["itemModelName"],$categories,"../../Images/" . $row["imgPath"],$row["price"],true,$row["color"],$row["cartItemId"]);
                    }
                    
                ?>
                
            </div>

        </div>

        <div class = " w-1/3 h-auto bg-selected flex justify-center py-20">

            <div id = "Card" class = "w-[400px] h-fit
                bg-white border-2 border-smallSelection rounded-xl p-10 ">

                    <h2 class = " font-inria font-bold text-3xl w-full">Questo è il tuo carrello</h2>
                    <h3 class = "font-inria text-2xl my-2">Vuoi procedere con l'acquisto?</h3>

                    
                    <a href="./summary.php" class = "button-shape-2 bg-selected font-inder text-white text-lg">Procedi</a>
                    
                </div>

        </div>
    </main>

    <?php include "../components/footer.php" ?>

    <script src = "../../js/cart.js"></script>
    
</body>
</html>