@extends("layout/base")
<link rel = "stylesheet" href = "/css/post/edit.css">
@section("content")
<form action = "/post/update/{{$post -> id}}" method = "post" enctype = "multipart/form-data">
    @csrf
    <input type = "text" name = "name" value = @if(old("name") != null){{old("name")}} @else {{$post -> name}}@endif id = "name">
    @error("name")
        <p>{{$message}}</p>
    @enderror
    <input type = "file" name = "image" id = "image">
    @error("image")
        <p>{{$message}}</p>
    @enderror
    <textarea name = "content" id = "content">@if(old("content") != null){{old("content")}} @else {{$post -> content}}@endif</textarea>
    @error("content")
        <p>{{$message}}</p>
    @enderror
    <input type = "submit">
</form>
@endsection