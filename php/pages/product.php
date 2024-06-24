<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Harmonic Resonance</title>
    <?php include "../components/dependencies.php"?>
</head>
<body>
    <?php include "../components/navbar.php" ?>
    <?php include "../components/utility/dbConnection.php" ?>
    
    <?php

        if (!isset($_GET["itemId"]))
        {
            echo "item not found!";
            exit();
        }
        $itemId = $_GET["itemId"];

        $query = "SELECT * FROM itemModel\n";
        $query .= "INNER JOIN itemModelImage USING (itemModelId)\n";
        $query .= "WHERE itemModel.itemModelId = ?\n";
        $query .= "ORDER BY itemModelImage.isMain\n";

        $statement = $conn->prepare($query);
        $statement->execute([$itemId]);

        $result = $statement->get_result();

        $firstRow = $result->fetch_assoc();
        
        if ($result->num_rows == 0)
        {
            echo "item not found!";
            exit();
        }

        $itemQuery = "SELECT * FROM item WHERE itemModelId = $itemId";
        $items = $conn->query($itemQuery);

        $categoryQuery = "SELECT * FROM category INNER JOIN modelCategory USING (categoryId) WHERE modelCategory.itemModelId = $itemId";
        $categories = $conn->query($categoryQuery);
        
    ?>
    
    <!-- Make this dynamic -->
    <div id ="BgImage" style = "background-image: linear-gradient(0deg, rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)),url('../../Images/piano-7890735_1920.jpg'); 
    background-size:100%;" class = " h-80 w-full bg-no-repeat bg-center darken
    flex items-center justify-center">
        <h1 class = "font-inria font-bold text-white text-5xl"><?php echo $firstRow["itemModelName"] ?></h1>
    </div>

    <section class = " mb-20">
        <div id = "scrollableArea" class = "flex mt-20 mx-52 justify-between ">

            <div id = "imagesContainer" class = "  flex w-[500px] h-[300px] gap-5">

                <div id = "imageList" class = " flex flex-col items-end w-[20%] px-2 gap-2 [&>img]:cursor-pointer">

                <?php 
                    
                    echo "<img src = '../../Images/". $firstRow["imgPath"] . "' class = ' w-[50px] aspect-square rounded optionButton object-scale-down selectedOptionButton'>";

                    while ($row = $result->fetch_assoc())
                    {
                        echo "<img src = '../../Images/". $row["imgPath"] . "' class = ' w-[50px] aspect-square rounded optionButton object-scale-down'>";
                    }
                ?>
                
                </div>

                <div id = "mainImage" class = " flex flex-col w-[80%]  rounded-xl">
                    <img src = "../../Images/<?php echo $firstRow["imgPath"] ?>" class = " w-full h-full rounded-lg transition object-scale-down">
                </div>
            </div>

            <div id = "Card" class = "w-[400px] h-fit sticky top-0 
            bg-white border-2 border-smallSelection rounded-xl p-10 ">

                <div class = "flex items-center">
                    <h2 class = " font-inria font-bold text-3xl w-full"><?php echo $firstRow["itemModelName"] ?></h2>
                    <p class = " w-fit text-end font-inria font-bold text-2xl"><?php echo "€" .$firstRow["price"] ?></p>
                </div>

                <h3 class = "font-inria text-2xl mt-2">Colore</h3>

                <ul id ="colori" class = "flex gap-1 mt-1 mb-14
                [&>li]:w-[50px] [&>li]:aspect-square [&>li]:rounded [&>li]:border-2 [&>li]:border-black [&>li]:cursor-pointer">
                    
                    <?php
                        $firstItemRow = $items->fetch_assoc();

                        echo "<li data-id = '" . $firstItemRow["itemId"] . "' data-availability=". $firstItemRow["availability"] ." class = 'selectedOptionButton' style = 'background-color: #". $firstItemRow["color"] ."'></li>";


                        while ($itemRow = $items->fetch_assoc())
                        {
                            echo "<li data-id = '" . $itemRow["itemId"] . "' data-availability=". $itemRow["availability"] ." style = 'background-color: #". $itemRow["color"] ."'></li>";
                        }
                    
                    ?>
                </ul>

                <p class = "text-smallSelection font-inria text-lg">Disponibilità:<span id = "availability"><?php echo $firstItemRow["availability"] ?></span></p>

                <!-- <a href=" ./summary.php" class = " button-shape-2 bg-smallTitle font-inder text-white text-lg mb-2">Compra ora</a> P.S. non c'è ne tempo ne voglia di implementarlo lol-->
                <button onclick = "addCartItem()" 
                class = "button-shape-2 bg-navbar font-inder text-white text-lg button-response">Aggiungi al carrello</button>
                
            </div>
        </div>

    </section>

    <section id = "infoSection" class = " flex flex-col items-center">

        <div id = "bg" class = "w-[110%] -rotate-2 h-fit bg-black ">
            <div id = "items-with-arrows" class = "h-full w-auto rotate-2 px-40 py-44 text-white flex flex-col">
                <h2 class = "font-inria font-bold text-5xl mb-4"><?php echo $firstRow["itemModelName"] ?></h2>
                <p class = " w-1/2 text-lg font-inder">
                   <?php echo $firstRow["description"] ?>
                </p>

                <h3 class = "mt-4 text-lg font-inria font-bold">Categories:</h3>
                <nav class = " flex gap-1">
                    <?php 
                        $current = 0;
                        while ($categoryRow = $categories->fetch_assoc())
                        {
                            $toAdd = "";
                            if ($categories->num_rows-1 != $current)
                            {
                                $toAdd = ", ";
                            }
                            echo "<a href = './search.php?category=". $categoryRow["categoryName"] ."' class = ' text-lg font-inria'>". $categoryRow["categoryName"] . $toAdd ."</a>";

                            $current++;
                        }
                        
                    ?>
                </nav>
                
                
            </div>
        </div>

    </section>

    <section id = "demoSection" class = " my-20 px-20">
        <h2 class = " w-3/4 m-auto font-inria font-bold text-3xl mb-5">Demo</h2>
        <iframe class = " w-3/4 m-auto aspect-video" src="<?php echo $firstRow["youtubeDemoLink"] ?>"></iframe>
    </section>
    
    
    <?php include "../components/footer.php" ?>

    <script src = "../../js/product.js"></script>
    
</body>
</html>