<input <?php 
if (isset($id)) 
{
    echo "id = $id ";
    echo "name = $id";
}

?> 
placeholder = "<?php echo "Inserisci " . $name . "..." ?>" 
class = " p-2 w-full bg-selected 
border-2 rounded-lg border-[var(--smallSelectionColor)]
text-white outline-none placeholder:text-[var(--smallTitleColor)]"
required
type = "<?php echo $type ?>">