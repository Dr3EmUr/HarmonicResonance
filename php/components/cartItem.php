<div id = "<?php echo $id ?>">
    <div  class = " flex justify-around gap-5 py-2 [&>div]:w-[200px] [&>div]:flex [&>div]:flex-col [&>div]:items-center">
        <li class = " block aspect-square w-[150px] p-3 rounded-full overflow-hidden">
            <img class = " w-full h-full rounded-full aspect-square object-scale-down" src = "<?php echo $imgPath ?>">
        </li>

        <div class = " py-2">
            <h3 class = " font-inria font-bold text-2xl line-clamp-1"><?php echo $name ?></h3>
            <p class = " font-inder text-center">
                <?php
                    for ($i = 0; $i < count($categories); $i++) {
                        echo $categories[$i];

                        if ($i != count($categories) - 1)
                        {
                            echo ", ";
                        }
                    }
                ?>
            </p>
        </div>

        <div class = " py-2 flex flex-col items-center ">
            <h3 class = " font-inria font-bold text-2xl">Elimina</h3>
            <div class = " flex mt-2 gap-2">
                <button class = "quantityButton bg-smallTitle" onclick = 'deleteCartItem(<?php echo $id ?>)'>-</button>
            </div>
        </div>

        <div class = " py-2">
            <h3 class = " font-inria font-bold text-2xl">Prezzo</h3>
            <p class = " font-inder text-xl">€<?php echo $price ?> </p>
        </div>

        <div class = " py-2">
            <h3 class = " font-inria font-bold text-2xl">Colore</h3>
            <ul id ="colori" class = "flex gap-1 mt-1 mb-14
                    [&>li]:w-[40px] [&>li]:aspect-square [&>li]:rounded [&>li]:border-2 [&>li]:border-black">
                            <li style = 'background-color: #<?php echo $color ?>'></li>
                    </ul>
        </div>
    </div>

    <?php 
    if ($border == true)
    {
        echo "<div class = ' w-auto h-[2px] bg-[#D9D9D9] mx-20'></div>";
    }
    ?>
</div>


