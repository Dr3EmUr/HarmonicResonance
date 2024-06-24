<nav class = "h-[55px] px-5 gap-3 flex items-center sticky top-0
    bg-navbar border-b-2 border-white 
    text-white z-10">

    <div id = "firstNavSection" class = "navbarContainer">
        <a class = "font-inria font-bold text-2xl" href = "../pages/index.php">Harmonic Resonance</a>
        <a class = "font-inder" href = "../pages/search.php" >Prodotti</a>
        <a class = "font-inder" href = "../pages/cart.php" >Carrello</a>
        <!-- da implementare il menù che appare quando si punta il cursore su "Prodotti" -->
    </div>

    <div id = "secondNavSection" class = "navbarContainer">

        <!-- Search bar -->
        <div class = " w-full h-[38px] bg-white rounded-full px-4">
            <input id = "navbar" type = "text" placeholder = "Cerca quello che vuoi..." class = " bg-transparent outline-none border-b border-[var(--hintColor)] 
            mt-[10px] w-full font-inder text-black text-sm" onActive = "console.log('search!')">
        </div>
        
    </div>

    <div id = "thirdNavSection" class = "navbarContainer justify-end font-inder">
        <?php 
            if (!isset($_SESSION["accountId"]))
            {
                echo "
                <a href = '../pages/login.php'>Login</a>
                <a href = '../pages/register.php'>Registrati</a>";
            }
            else
            {
                echo "
                <a href = ''>". $_SESSION["username"]  ."</a>
                <a href = '../api/logout.php'>Logout</a>";
            }
        
        ?>
        
    </div>
</nav>

<script src = "../../js/navbar.js" defer></script>