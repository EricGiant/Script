function changeMenu()
{
    //get menu
    var menu = document.getElementById("categoriesMenu");

    //change display
    if(menu.style.display == "none")
    {
        menu.style.display = "block";
    }
    else
    {
        menu.style.display = "none";
    }
}