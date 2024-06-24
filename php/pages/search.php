<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Harmonic Resonance</title>
    <?php include "../components/dependencies.php"?>
</head>
<body>
    <?php include "../components/navbar.php" ?>
    <?php include "../components/utility/dbConnection.php"?>

    <?php
        

        $query = "SELECT DISTINCT itemModel.itemModelId ,itemModel.itemModelName, itemModelImage.imgPath, itemModel.description, itemModel.price, itemModel.creationDate\n";
        $query .= "FROM itemModel\n";
        $query .= "INNER JOIN itemModelImage ON itemModel.itemModelId = itemModelImage.ItemModelId\n";
        $query .= "INNER JOIN modelCategory ON itemModel.itemModelId = modelCategory.ItemModelId\n";
        $query .= "INNER JOIN category ON modelCategory.categoryId = category.categoryId \n";
        $query .= "INNER JOIN company ON itemModel.companyId = company.companyId\n";
        $query .= "WHERE itemModelImage.isMain = 1\n";

        if(isset($_GET["brand"]))
        {
            $query .= "AND company.name = '" . $_GET["brand"] . "'\n";
        }

        if (isset($_GET["category"]))
        {
            $query .= "AND category.categoryName = '" . $_GET["category"] . "'\n";
        }

        if (isset($_GET["priceFilterDirection"]) && isset($_GET["price"]))
        {
            if ($_GET["priceFilterDirection"] != ">" && $_GET["priceFilterDirection"] != "<")
            {
                echo "Invalid priceFilterDirection";
                exit();
            }

            $query .= "AND itemModel.price " . $_GET["priceFilterDirection"] . " " . $_GET["price"] . "\n";
        }

        if (isset($_GET["query"]))
        {
            $query .= "AND itemModel.itemModelName LIKE('%" . $_GET["query"] . "%')\n";
        }
        

        if (isset($_GET["sortBy"]))
        {
            $sortBy = $_GET["sortBy"];

            switch($sortBy)
            {
                case "A-Z":
                    $query .= "ORDER BY itemModel.itemModelName"; 
                    break;
                case "Prezzo":
                    $query .= "ORDER BY itemModel.price"; 
                    break;
                case "Data di creazione":
                    $query .= "ORDER BY itemModel.creationDate"; 
                    break;
            }
        }

        $query .= ";";
        // echo $query;
        $result = $conn->query($query);
        
    ?>
    
    <main class = " flex h-fit ">
        <div class = " bg-selected w-full shrink-[4]">
            <ul id = "sidebar" class = "  text-white p-5 font-inder select-none overflow-auto sticky top-[55px]">

                <?php 
                
                    $companyQuery = "SELECT * FROM company";
                    $companyResult = $conn->query($companyQuery);

                    $companies = [];
                    while ($row = $companyResult->fetch_assoc())
                    {
                        $companies[] = $row["name"];
                    }

                    sidebarElement("Marca",$companies,false,"brand");
                ?>

                <?php 
                
                    $categoryQuery = "SELECT categoryName FROM category";
                    $categoryResult = $conn->query($categoryQuery);

                    $categories = [];
                    while ($row = $categoryResult->fetch_assoc())
                    {
                        $categories[] = $row["categoryName"];
                    }

                    sidebarElement("Categoria",$categories,false,"category");
                ?>
                
                <?php sidebarElement("Prezzo",[">","<"],true,"priceFilterDirection")?>
                <?php sidebarElement("Ordina per",["A-Z","Prezzo","Data di creazione"],false,"sortBy")?>
                
            </ul>

        </div>

        <div id = "content" class = " bg-white w-full flex flex-wrap gap-5 p-10">
                <?php 
                    while ($row = $result->fetch_assoc())
                    {
                        card($row["itemModelName"], "../../Images/" . $row["imgPath"],  $row["description"], $row["itemModelId"]);
                    }
                ?>
        </div>

    </main>
    
    <?php include "../components/footer.php" ?>

    <script src = "../../js/sidebar.js"></script>
</body>
</html>