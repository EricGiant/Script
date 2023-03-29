//bound to be removed or changed when create and edit page are reworked
function getArticalData()
{
    //get form
    var form = document.getElementById("addCategory");

    //make title
    var title = document.createElement("input");
    title.value = document.getElementById("title").value;
    title.type = "hidden";
    title.name = "data_title";
    form.appendChild(title);

    //make content
    var content = document.createElement("input");
    content.value = document.getElementById("content").value;
    content.type = "hidden";
    content.name = "data_content";
    form.appendChild(content);

    //get selected categories
    var categories = document.getElementById("dropdown")
    var selectedCategories = [];
    for(var i = 0; i < categories.childElementCount; i++)
    {
        if(categories.children[i].checked)
        {
            selectedCategories.push(categories.children[i].value);
        }
    }

    //make hidden values
    for(var i = 0; i < selectedCategories.length; i++)
    {
        var category = document.createElement("input");
        category.value = selectedCategories[i];
        category.type = "hidden";
        category.name = "data_category[]";
        form.appendChild(category);
    }
}