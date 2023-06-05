@extends("layout/base")
<link rel = "stylesheet" href = "/css/post/editPage.css">
@section("content")
<div id = "posts">
    @foreach(auth() -> user() -> posts as $post)
        <div class = "post">
            <form class = "update" action = "/post/edit/{{$post -> id}}" method = "get">
                <input type = "submit" value = "UPDATE">
            </form>
            <div class = "name">
                {{$post -> name}}
            </div>
            <form class = "destroy" action = "/post/destroy/{{$post -> id}}" method = "post">
                @csrf
                <input type = "submit" value = "REMOVE">
            </form>
        </div>
    @endforeach
</div>
@endsection