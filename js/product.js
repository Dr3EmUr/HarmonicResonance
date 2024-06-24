const mainImage = document.getElementById("mainImage").children.item(0)
const imageList = document.getElementById("imageList")

const firstImage = imageList.children.item(0)
let currentImage = firstImage;

imageList.childNodes.forEach(element => {
    element.addEventListener("click", () => {
        switchMainImage(element)
    })
});

function switchMainImage(element)
{
    mainImage.src = element.src
    currentImage.classList.remove("selectedOptionButton")
    element.classList.add("selectedOptionButton")
    currentImage = element
}

// ------------------------------------------------------------------------------ up is images down is colors
// Yeah, i wrote the exact same code twice, I know this should be a class instantiated twice but whatever I don't have time

const colori = document.getElementById("colori")
const availability = document.getElementById("availability")

colori.childNodes.forEach(element => {
    element.addEventListener("click", () => {
        switchMainColor(element)
    })
})

let currentColor = colori.children.item(0)
let currentAvailability = currentColor.dataset.availability

function switchMainColor(element)
{
    currentColor.classList.remove("selectedOptionButton")
    currentColor = element;
    currentColor.classList.add("selectedOptionButton")

    currentAvailability = element.dataset.availability
    availability.innerHTML = currentAvailability
}

// ------------------------------------------- end of this abomination ------------------------------------------------------


async function addCartItem()
{
    const currentId = currentColor.dataset.id
    const payload = {
        itemId: currentId
    }

    const res = await fetch("../api/addCartItem.php", {
        method: "POST",
        headers: {
            "content-type": "application/JSON"
        },

        body: JSON.stringify(payload)
        
    })

    if (res.ok)
    {        
        window.location.href = "./cart.php"    
    }
    else
    {
        if (res.status == 403)
        {
            window.location.href = "./login.php"        
        }
        else if (res.status == 409)
        {
            alert("Questo oggetto è già presente nel tuo carrello!")   
        }
        else
        {
            alert("C'è stato un errore nell'inserire l'oggetto nel carrello")   
        }
         
    }
}