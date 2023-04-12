@extends("layout/base")
<link rel = "stylesheet" href = "/css/artical/create.css">
@section("content")
<form action = "/articalStore" method = "post" enctype = "multipart/form-data">
    @csrf
    <div>
        <label for = "title">TITLE</label>
        <input type = "text" name = "title" style = "width: 50%" required 
        @isset($title) value = "{{$title}}" @endisset>
    </div>
    <div>
    </div>
        <label for = "image">IMAGE</label>
        <input type = "file" name = "image"> {{-- add reloader to image when  new category is added --}}
    <div>
        <label for = "content">CONTENT</label>
        <textarea name = "content" required>@isset($content){{$content}}@endisset</textarea>
    </div>
    <div>
        <label for = "categories" style = "margin-bottom: 5px">CATEGORIES</label>
        <div id = "categories">
            @foreach($categories as $category)
                <input type = "checkbox" value = "{{$category -> id}}" name = "categories[]"
                @isset($selectedCategories)
                    @for($i = 0; $i < count($selectedCategories); $i++)
                        @if($selectedCategories[$i] == $category -> id)
                            {{"checked"}}
                        @endif
                    @endfor
                @endisset>{{$category -> name}}<br>
            @endforeach
        </div>
    </div>
    <div>
        <label for = "premium">IS PREMIUM</label>
        <input type = "hidden" name = "premium" value = 0>
        <input type = "checkbox" name = "premium" value = 1 @if(isset($isPremium)) @if($isPremium == 1) checked @endif @endif> 
    </div>
    <input type = "submit">
</form>
<form action = "/categoryStore" method = "get" onsubmit = "getArticalData()" id = "addCategory">
    <label for = "name">ADD NEW CATEGORY</label>
    <input type = "text" name = "name" required>
    <input type = "submit">
</form>
<script src = "/js/artical/create.js"></script>
@endsection