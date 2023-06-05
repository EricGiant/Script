@extends("layout/base")
<link rel = "stylesheet" href = "/css/post/create.css">
@section("content")
<form action = "/post/store" method = "post" enctype = "multipart/form-data">
    @csrf
    <input type = "text" name = "name" value = "{{old("name")}}" id = "name">
    @error("name")
        <p>{{$message}}</p>
    @enderror
    <input type = "file" name = "image" id = "image">
    @error("image")
        <p>{{$message}}</p>
    @enderror
    <textarea name = "content" id = "content">{{old("content")}}</textarea>
    @error("content")
        <p>{{$message}}</p>
    @enderror
    <input type = "submit">
</form>
@endsection