@extends("layout/base")
<link rel = "stylesheet" href = "/css/artical/create.css">
@section("content")

@foreach ($errors -> all() as $item)
    {{$item}}
@endforeach

@php
if(isset($data)){dd($data);}
@endphp

<form action = "/artical/update/@if(isset($id)){{$id}}@elseif(isset($artical)){{$artical -> id}}@endif" method = "post" enctype = "multipart/form-data"> {{-- this needs to be 1 line because otherwise the spacing inside the action breaks, logic could maybe be seperated to make it more readable --}}
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
        <input type = "file" name = "image"> {{-- RELOAD FOR THIS WOULD NEED JS AND AJEX, AND PRELOAD WOULD NEED CONTROLLER REWORKS TO DISPLAY IMAGE SO DONT ADD IT --}}
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
        <input type = "hidden" name = "isPremium" value = 0>
        <input type = "checkbox" name = "isPremium" value = 1 @if(isset($isPremium)) @if($isPremium == 1) checked @endif @elseif(isset($artical)) @if($artical -> isPremium) checked @endif @endif>
    </div>
    <input type = "submit">
</form>
<form action = "/category" method = "post" onsubmit = "getArticalData()" id = "addCategory">
    @csrf
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
<script src = "/js/artical/edit.js"></script>
@endsection