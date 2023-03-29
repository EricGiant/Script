@extends("layout/base")
<link rel = "stylesheet" href = "/css/artical/create.css">
@section("content")

<p>THIS CODE IS BROKEN AND HAS TO BE FULLY REWORKED</p>

<form action = @if(session("action")) {{session("action")}} @endif method = "get" id = "articalForm">
    <div>
        <label for = "title">TITLE</label>
        <input type = "text" name = "title" style = "width: 50%" required id = "title" @if(session("title")) value ="{{session("title")}}" @endif>
    </div>
    <div>
        <label for = "content">CONTENT</label>
        <textarea name = "content" required id = "content">@if(session("content")){{session("content")}}@endif</textarea>
    </div>
    <div id = "categories">
        <p>SELECT CATEGORIES</p>
        <div id = "dropdown">
            @foreach($categories as $category)
                @php
                    $checked = "";
                    if(session("category"))
                    {
                        for($i = 0; $i < count(session("category")); $i++)
                        {
                            if(session("category")[$i] == $category -> id)
                            {
                                $checked = "checked";
                            }
                        }
                    }
                @endphp
                <input type = "checkbox" value = {{$category -> id}} name = "categories" {{$checked}}>{{$category -> name}} <br>
            @endforeach
        </div>
    </div>
    <input type = "submit">
</form>
<div>
    <form action = "/articalStoreCategory" method = "get" onsubmit = "getArticalData()" id = "addCategory">
        <label for = "name">ADD NEW CATEGORY</label>
        <input type = "text" name = "name" required>
        <input type = "submit">
    </form>
</div>
<script src = "/js/artical/create.js"></script>
@endsection