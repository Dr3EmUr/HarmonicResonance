<div class = " w-[250px] h-[320px] flex flex-col pb-2
border-2 border-[var(--#E8E8E8)] rounded-2xl overflow-hidden 
select-none cursor-pointer" onclick="window.location.href='./product.php?itemId=<?php echo $itemId ?>'">
    <img class = " rounded-2xl aspect-[16/11] object-scale-down px-2" src = "<?php echo $imgPath ?>">
    <div class = "p-3 flex flex-col h-auto">

        <h2 class = " font-inria font-bold text-xl text-ellipsis text-nowrap overflow-hidden"><?php echo $title ?></h2>
        <p class = " block h-[100px] overflow-hidden font-inder text-ellipsis leading-5"><?php echo $description ?></p>
    </div>
    
</div>