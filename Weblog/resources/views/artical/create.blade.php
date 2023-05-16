@extends("layout/base")
<link rel = "stylesheet" href = "/css/artical/create.css">
@section("content")
<form action = "/artical" method = "post" enctype = "multipart/form-data">
    @csrf
    <div>
        <label for = "title">TITLE</label>
        <input type = "text" name = "title" style = "width: 50%" required 
        @isset($title) value = "{{$title}}" @endisset>
    </div>
    <div>
    </div>
        <label for = "image">IMAGE</label>
        <input type = "file" name = "image"> {{-- RELOAD FOR THIS WOULD NEED JS AND AJEX TO WORK PROPERLY SO DONT ADD IT --}}
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
        <input type = "hidden" name = "isPremium" value = 0>
        <input type = "checkbox" name = "isPremium" value = 1 @if(isset($isPremium)) @if($isPremium == 1) checked @endif @endif>
    </div>
    <input type = "submit">
</form>
<form action = "/category" method = "post" onsubmit = "getArticalData()" id = "addCategory">
    @csrf
    <label for = "name">ADD NEW CATEGORY</label>
    <input type = "text" name = "name" required>
    <input type = "submit">
</form>
<script src = "/js/artical/create.js"></script>
@endsection