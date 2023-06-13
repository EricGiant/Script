@extends("layout/base")
<link rel = "stylesheet" href = "/css/post/index.css">
@section("content")
<div style = "text-align: center">
    <form action = "/post" method = "get">
        <div id = "search">
            <input type = "text" name = "search">
            <input type = "submit" value = "SEARCH">
        </div>
        <div id = "categoriesMenu">
            @foreach($categories as $category)
                <input type = "checkbox" value = "{{$category -> id}}" name = "categories[]">{{$category -> name}}<br>
            @endforeach
        </div>
    </form>
</div>
<div id = "posts">
    @foreach($posts as $post)
        <a href = "/post/{{$post -> id}}">
            <div class = "image">
                @if($post -> image_path != null)
                    <img src = "{{asset($post -> image_path)}}">
                @endif
            </div>
            <div class = "title">
                {{$post -> name}}
            </div>
            <div class = "categories">
                @php
                    $post -> categories = $post -> categories -> implode("name", ", ", "");
                @endphp
                {{$post -> categories}}
            </div>
        </a>
    @endforeach
    {{$posts -> links()}}
</div>
@endsection