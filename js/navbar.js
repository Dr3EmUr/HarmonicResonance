const navbar = document.getElementById("navbar")

const urlParams =  new URLSearchParams(window.location.search)

if (urlParams.has("query"))
{
    navbar.value = urlParams.get("query")    
}

if (navbar != null)
{
    navbar.addEventListener("keypress", (e) => {
        if (e.key === "Enter") {
            e.preventDefault();

            if (navbar.value == "")
            {
                urlParams.delete("query");
                window.location.search = urlParams
                window.location.href = "./search.php";
                return;
            }

            urlParams.set("query",navbar.value)

            window.location.href = "./search.php?" + urlParams
            }
    })    
}