async function deleteCartItem(id)
{
    const payload = {
        "cartItemId": id
    }

    const result = await fetch("../api/deleteCartItem.php", {
        method: "POST",
        headers: {
            "content-type": "application/JSON"
        },

        body: JSON.stringify(payload)
    })

    if (result.ok)
    {
        const toRemove = document.getElementById(id)
        toRemove.remove();
    }
    else
    {
        alert("c'è stato un problema nell'eliminazione dell'oggetto dal carrello: " + await result.text())    
    }
}