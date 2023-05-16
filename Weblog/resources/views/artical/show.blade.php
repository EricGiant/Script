@extends("layout/base")
<link rel = "stylesheet" href = "/css/artical/show.css">
@section("content")
<div>
    <div class = "category">
        @php
            $artical -> categories = $artical -> categories -> implode("name", ", ", "");
        @endphp
        {{$artical -> categories}}
    </div>
    <div id = "author">
        BY {{$artical -> author -> name}}
    </div>
</div>
<div id = "title">
    {{$artical -> title}}
</div>
@if($artical -> image)
    <div>
        <img src = "data:image/png;base64,{{$artical -> image}}" id = "image">
    </div>
@endif
<div id = "content">
    {{$artical -> content}}
</div>
<div id = "write">
    <p>Add your comment here</p>
    <form action = "/comment" method = "post">
        @csrf
        <textarea name = "content" required></textarea>
        <input type = "submit">
        <input type = "hidden" name = "artical_id" value = {{$artical -> id}}>
    </form>
</div>
<div id = "comments">
    @foreach($artical -> comments as $comment)
        <div class = "comment" @if($loop -> last) style = "padding-bottom: 10px" @endif id = "comment_{{$comment -> id}}">
            <div class = "comment_author">
                by {{$comment -> author -> name}}
                @if($comment -> created_at != $comment -> updated_at)
                    |edited|
                @endif
            </div>
            <div class = "comment_content">
                {{$comment -> content}}
            </div>
            @can("update", $comment)
                @if($comment -> author_id == auth() -> user() -> id)
                    <button onclick = "editComment({{$comment -> id}})">EDIT</button>
                @endif
            @endcan
        </div>
    @endforeach
</div>
@endsection
<script src = "/js/artical/show.js"></script>