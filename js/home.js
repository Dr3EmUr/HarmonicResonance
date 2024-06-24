const items = document.getElementById("items")
const arrowLeft = document.getElementById("arrow-left")
const arrowRight = document.getElementById("arrow-right")

// this is currently static: 400px of list item lenght + 8 pixels of padding
const scrollingLenght = 400 + 8;


arrowLeft.addEventListener("click", () => scroll(-scrollingLenght))
arrowRight.addEventListener("click", () => scroll(scrollingLenght))
    

function scroll(amount)
{
    items.scrollTo({ left: items.scrollLeft + amount, behavior: "smooth"})
}