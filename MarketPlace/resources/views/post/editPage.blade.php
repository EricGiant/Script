@extends("layout/base")
<link rel = "stylesheet" href = "/css/post/editPage.css">
@section("content")
<form action = "/category/store" method = "post" id = "category">
    @csrf
    <p>ADD CATEGORY</p>
    <input type = "text" name = "name" id = "name">
    <input type = "submit">
    @error("name")
        <p>{{$message}}</p>
    @enderror
</form>
<div id = "posts">
    @foreach(auth() -> user() -> posts -> reverse() as $post)
        <div class = "post">
            @if($post -> advertised_at == null || \Carbon\Carbon::createFromFormat("Y-m-d H:i:s", $post -> advertised_at) -> lt(\Carbon\Carbon::now() -> subHour()))
                <form class = "advertise" action = "/post/advertise/{{$post -> id}}" method = "post">
                    @csrf
                    <input type = "submit" value = "ADVERTISE">
                </form>
            @endif
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
            @php
                $post -> categories = $post -> categories -> implode("name", ", ", "");
            @endphp
            <p>{{$post -> categories}}</p>
        </div>
    @endforeach
</div>
@endsection