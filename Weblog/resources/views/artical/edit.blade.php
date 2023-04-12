@extends("layout/base")
<link rel = "stylesheet" href = "/css/artical/create.css">
@section("content")
<form action = "/articalUpdate/@if(isset($id)){{$id}}@elseif(isset($artical)){{$artical -> id}}@endif" method = "post" enctype = "multipart/form-data"> {{-- this needs to be 1 line because otherwise the spacing inside the action breaks, logic could maybe be seperated to make it more readable --}}
    @csrf
    <div>
        <label for = "title">TITLE</label>
        <input type = "text" name = "title" style = "width: 50%" required
        @if(isset($title))
            value = "{{$title}}"
        @elseif(isset($artical))
            value = "{{$artical -> title}}"
        @endif>
    </div>
    </div>
        <label for = "image">IMAGE</label> 
        <input type = "file" name = "image"> {{-- add reloader to image when  new category is added and when page is first loaded --}}
    <div>
    <div>
        <label for = "content">CONTENT</label>
        <textarea name = "content" required>@if(isset($content)){{$content}}@elseif(isset($artical)){{$artical -> content}}@endif</textarea> {{-- this needs to be 1 line because otherwise the spacing breaks inside of the content box, logic could maybe be seperated to make it more readable --}}
    </div>
    <div>
        <label for = "categories" style = "margin-bottom: 5px">CATEGORIES</label>
        <div id = "categories">
            @foreach($categories as $category)
                <input type = "checkbox" value = "{{$category -> id}}" name = "categories[]"
                @if(isset($selectedCategories))
                    @for($i = 0; $i < count($selectedCategories); $i++)
                        @if($selectedCategories[$i] == $category -> id)
                            {{"checked"}}
                        @endif
                    @endfor
                @elseif(isset($artical))
                    @for($i = 0; $i < count($artical -> categories); $i++)
                        @if($artical -> categories[$i]["id"] == $category -> id)
                            {{"checked"}}
                        @endif
                    @endfor
                @endif>{{$category -> name}}<br>
            @endforeach
        </div>
    </div>
    <div>
        <label for = "premium">IS PREMIUM</label>
        <input type = "hidden" name = "premium" value = 0>
        <input type = "checkbox" name = "premium" value = 1 @if(isset($isPremium)) @if($isPremium == 1) checked @endif @elseif(isset($artical)) @if($artical -> isPremium) checked @endif @endif> 
    </div>
    <input type = "submit">
</form>
<!-- TODO: categorieen moeten via apart scherm toegevoegd worden, dus niet iva article edit scherm -->
<form action = "/categoryStore" method = "get" onsubmit = "getArticalData()" id = "addCategory">
    <label for = "name">ADD NEW CATEGORY</label>
    <input type = "text" name = "name" required>
    <input type = "hidden" name = "id"
    @if(isset($id))
        value = "{{$id}}"
    @elseif(isset($artical))
        value = "{{$artical -> id}}"
    @endif>
    <input type = "submit">
</form>
<!-- TODO: probeer zo min mogelijk met javascript te werken  -->
<script src = "/js/artical/update.js"></script>
@endsection