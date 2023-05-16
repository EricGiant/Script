function editComment(id)
{
    //get comment
    var comment = document.getElementById("comment_" + id);

    //get CRSF token
    var token = document.getElementsByName("_token")[0];

    //make edit form
    var editForm = document.createElement("form");
    editForm.method = "post";
    editForm.action = "/comment/update/" + id;

    //make textfield
    var textarea = document.createElement("textarea");
    textarea.required = true;
    textarea.name = "content";
    textarea.innerText = comment.children[1].innerText;
    textarea.style = "margin-top: 5px; width: 50%; resize: none; height: 150px;";

    //make submit
    var editSubmit = document.createElement("input");
    editSubmit.type = "submit";
    editSubmit.style = "width: 10%; display: block; margin: auto; height: 30px; border-radius: 10px; margin-top: 10px;";

    //remove comment_content & edit button
    comment.children[1].remove();
    comment.children[1].remove();

    //append objects
    editForm.appendChild(textarea);
    editForm.appendChild(editSubmit);
    editForm.appendChild(token.cloneNode());
    comment.appendChild(editForm);

    //make remove form
    var removeForm = document.createElement("form");
    removeForm.method = "post";
    removeForm.action = "/comment/destroy/" + id;

    //make submit
    var removeSubmit = document.createElement("input");
    removeSubmit.type = "submit";
    removeSubmit.value = "REMOVE";
    removeSubmit.style = "color: red; size: 15px; font-weight: bolder;";

    //append objects
    removeForm.appendChild(removeSubmit);
    removeForm.appendChild(token.cloneNode());
    comment.appendChild(removeForm);
}