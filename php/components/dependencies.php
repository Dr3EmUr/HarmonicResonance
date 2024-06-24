<!-- css -->
<link rel = "stylesheet" href = "../../css/index.css">
<!-- tailwind -->
<script src="https://cdn.tailwindcss.com"></script>
<!-- fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<link href="https://fonts.googleapis.com/css2?family=Inder&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Inder&family=Inter:wght@100..900&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Inder&family=Inria+Sans:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&family=Inter:wght@100..900&display=swap" rel="stylesheet">

<!-- components -->
<?php

session_start();
function sidebarElement($title,$elements,$isForm = false,$urlParameterName = "")
{
    include "sidebarElement.php";
}

function formInput($name,$id = "defaultFormId", $type = "text")
{
    include "Form/formInput.php";
}

function formInputWithLabel($name,$id = "defaultFormId", $type = "text")
{
    include "Form/formInputWithLabel.php";
}

function card($title,$imgPath,$description,$itemId)
{
    include "card.php";
}

function cartItem($name,$categories,$imgPath,$price,$border,$color,$id)
{
    include "cartItem.php";
}