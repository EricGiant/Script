@extends("layout/base")
<link rel = "stylesheet" href = "/css/post/index.css">
@section("content")
<div id = "posts">
    @foreach($posts as $post)
        <a href = "/post/{{$post -> id}}">
            <div class = "image">
                <img src = "{{asset($post -> image_path)}}">
            </div>
            <div class = "title">
                {{$post -> name}}
            </div>
        </a>
    @endforeach
    {{$posts -> links()}}
</div>
@endsection