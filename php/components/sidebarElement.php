<?php
    $naturalShow = 5;
    $isOverflow = true;
?>

<li id ="sidebarInstrumentType">
    <h2 class = "font-inria font-bold text-smallTitle text-2xl "><?php echo $title ?></h2>
    <ul class = " text-smallSelection leading-6 [&>li]:cursor-pointer [&>li]:w-fit">
        <?php

            if ($urlParameterName == "")
            {
                $urlParameterName = $title;
            }

            

            if (count($elements) <= $naturalShow)
            {
                $naturalShow = count($elements);
                $isOverflow = false;
            }

            for ($i = 0; $i < $naturalShow; $i++) {
                
                $elementString = "<li onclick='toggleFilter(\"$urlParameterName\",\"$elements[$i]\")'>" . $elements[$i] . "</li>";

                if (isset($_GET[$urlParameterName]))
                {
                    $currentActive = $_GET[$urlParameterName];
                    if ($currentActive == $elements[$i])
                    {
                        $elementString = "<li onclick='toggleFilter(\"$urlParameterName\",\"$elements[$i]\")' class='activeSidebarElement'>" . $elements[$i] . "</li>";
                    }
                        
                }

                echo $elementString;
                
            }

            if ($isForm == true)
            {
                echo "<div class = ' mt-2 w-40'>";
                formInput("Prezzo","priceForm");
                echo "</div>";
            }
        ?>

        <div id = "<?php echo "$title"?>-other" class = " invisibleMenu cursor-pointer">
            <?php
                for ($i = $naturalShow; $i < count($elements); $i++)
                {

                    $elementString = "<li onclick='toggleFilter(\"$urlParameterName\",\"$elements[$i]\")'>" . $elements[$i] . "</li>";

                    if (isset($_GET[$urlParameterName]))
                    {
                        $currentActive = $_GET[$urlParameterName];
                        if ($currentActive == $elements[$i])
                        {
                            $elementString = "<li onclick='toggleFilter(\"$urlParameterName\",\"$elements[$i]\")' class='activeSidebarElement'>" . $elements[$i] . "</li>";
                        }
                            
                    }

                    echo $elementString;
                }
            ?>
        </div>
    </ul>

    <div class = "flex border-b border-[var(--smallSelectionColor)] pb-4 mb-4">
        <?php if ($isOverflow == true)
            {
                echo (' <div class = " text-smallTitle cursor-pointer" onclick ="toggleHidden(`'. $title .'-other' .'`)">Altro</div>
                        <img src = "../../Images/icons/Arrow.svg" class =  " ml-1 aspect-square w-3 rotate-90"></img>');
            }
        ?>
    </div>
</li>