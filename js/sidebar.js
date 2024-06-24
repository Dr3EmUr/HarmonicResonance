const priceForm = document.getElementById("priceForm");

if (priceForm != null)
{
    priceForm.addEventListener("keypress", (e) => {
        if (e.key === "Enter") {
            e.preventDefault();
            toggleFilter("price",priceForm.value)
          }
    })    
}

function toggleHidden(targetId)
{
    const elem = document.getElementById(targetId);
    
    if (elem == null)
        return;

    if (elem.classList.contains("invisibleMenu"))
    {
        elem.classList.remove("invisibleMenu")
    }
    else
    {
        elem.classList.add("invisibleMenu")
    }
}

function toggleFilter(filterName,fieldName)
{
    const urlParams = new URLSearchParams(window.location.search)
    const current = urlParams.get(filterName)

    if (current === fieldName)
    {
        urlParams.delete(filterName)
    }
    else
    {
        urlParams.set(filterName,fieldName)
    }

    window.location.search = urlParams
}