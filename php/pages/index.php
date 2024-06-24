<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Harmonic Resonance</title>
    <?php include "../components/dependencies.php"?>
    <?php include "../components/utility/dbConnection.php"?>
</head>
<body>
    <?php include "../components/navbar.php" ?>

    <?php 
        $sql = "SELECT * FROM itemModel 
        INNER JOIN itemModelImage USING (itemModelId)
        WHERE isMain = 1
        LIMIT 3";
        $bestSellerItemModels = $conn->query($sql);

        $sql = "SELECT * FROM category";
        $categories = $conn->query($sql);
    ?>

    <main class = "hero select-none h-[calc(100%-55px)]">
        <div id = "heroContent" class = " w-2/5 m-auto relative top-[25%] text-white">
            <pre><h1 class = "font-inria font-bold text-5xl">Benvenuto in Harmonic
resonance</h1></pre>
            <h2 class = "font-inria font-light text-2xl mt-2">Fin dal lontano 1812, noi intenditori del suono ci occupiamo della vendita di strumenti di grande qualità</h2>

            <div id = "CTA" class = " flex justify-center gap-10 mt-6">
                <a href = "#ProductSection" class = "button-shape w-[220px] shrink-0 bg-[#373737] border-2 border-white font-inder bg-opacity-80">Prodotti</a>
                <a href = "#AboutSection" class = "button-shape w-[220px] shrink-0 bg-white border-2 border-black font-inder text-black bg-opacity-80">Chi siamo</a>
            </div>
        </div>
    </main>

    <section id = "bestsellerSection" class = "h-fit page-padding">
        <h3 class = " font-inter font-bold text-3xl mt-20">Bestseller</h3>

        <ul class = " mt-10 flex items-center justify-center gap-2
        [&>li]:w-full [&>li]:aspect-video">

            <?php 
                while ($row = $bestSellerItemModels->fetch_assoc())
                {
                    echo '<li onclick="window.location.href=\'./product.php?itemId=' . $row["itemModelId"] . '\'" 
                            style = "background-image:url(../../Images/'. $row["imgPath"] .');" class = "hover-card">
                                <div class = "hover-card-text">
                                    '. $row["itemModelName"] .' <br> €' . $row["price"] . ' 
                                </div>
                            </li>';
                }
            ?>
            
        </ul>

    </section>

    <section id = "ProductSection" class = "h-fit ">
        <h3 class = " font-inter font-bold text-3xl pt-20 page-padding">Categorie</h3>
            
        <div id = "products-and-bg-container" class = "flex flex-col items-center">
            <div id = "bg" class = "w-[101%] -rotate-2 h-[400px] bg-black ">

                <div id = "items-with-arrows" class = "h-full w-auto rotate-2 flex">

                    <div id = "arrow-left-container" class = "w-[200px] h-full flex justify-center items-center text-white shrink-0">
                        <button id = "arrow-left" class = " text-7xl font-inria"><</button>
                    </div>

                    <ul id = "items" class = " flex items-center justify-start gap-2 h-full w-full overflow-hidden
                     [&>li]:w-[400px] [&>li]:aspect-video [&>li]:flex-shrink-0 ">

                    <?php 
                        while ($category = $categories->fetch_assoc())
                        {
                            echo(
                            '<li onclick="window.location.href=\'./search.php?category=' . $category["categoryName"] .'\'"
                            style = "background-image:url(../../Images/' . $category["categoryImgPath"] . '" class = "hover-card">
                                <div class = "hover-card-text">
                                    ' . $category["categoryName"] . '
                                </div>
                            </li>');
                        }

                       
                    ?>

                        

                    </ul>

                    <div id = "arrow-right-container" class = "w-[200px] h-full flex justify-center items-center text-white shrink-0">
                            <button id = "arrow-right" class = " text-7xl font-inria">></button>
                        </div>
                </div>
            </div>
        </div>
    </section>

    <section id = "AboutSection" class = "page-padding py-20">
        
        <div id = "container" class = "flex gap-10 font-inter mt-12">
            <img src = "../../Images/pianoCloseUp.jpg" class = "block aspect-video w-full">
            <div class = "w-full">

                <h3 class = " font-bold text-3xl mb-3">Perchè Harmonic Resonance?</h3>
                <p class = "text-xl mb-3">
                    Dal 1812 Harmonic Resonance vi fornisce i migliori strumenti musicali in circolazione a prezzi ragionevoli.
                
                </p>
                <p class = "text-xl">
                    La chiave del nostro business è la selezione di strumenti di prima scelta tra i brand più acclamati al mondo, quali Yamaha, Fender, Casio e tanti altri
                </p>

            </div>
        </div>

    </section>

    <?php include "../components/footer.php" ?>

    <script src = "../../js/home.js"></script>
</body>
</html>