function getArticalData()
{
    //get form
    var form = document.getElementById("addCategory");

    //make title
    var title = document.createElement("input");
    title.value = document.getElementsByName("title")[0].value;
    title.type = "hidden";
    title.name = "data_title";
    form.appendChild(title);

    //make content
    var content = document.createElement("input");
    content.value = document.getElementsByName("content")[0].value;
    content.type = "hidden";
    content.name = "data_content";
    form.appendChild(content);

    //get selected categories
    var categories = document.getElementById("categories")
    var selectedCategories = [];
    for(var i = 0; i < categories.childElementCount; i++)
    {
        if(categories.children[i].checked)
        {
            selectedCategories.push(categories.children[i].value);
        }
    }

    //make category
    for(var i = 0; i < selectedCategories.length; i++)
    {
        var category = document.createElement("input");
        category.value = selectedCategories[i];
        category.type = "hidden";
        category.name = "data_category[]";
        form.appendChild(category);
    }

    //make premium
    var premium = document.createElement("input");
    if(document.getElementsByName("isPremium")[1].checked)
    {
        premium.value = 1;
    }
    else
    {
        premium.value = 0;
    }
    premium.type = "hidden";
    premium.name = "data_isPremium";
    form.appendChild(premium);
}