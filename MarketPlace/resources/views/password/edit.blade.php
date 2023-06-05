@extends("layout/base")
<link rel = "stylesheet" href = "/css/password/edit.css">
@section("content")
<form action = "/password/update" method = "post">
    @csrf
    <div>
        <label for = "password">NEW PASSWORD</label>
        <input type = "text" name = "password">
        @error("password")
            <p>{{$message}}</p>
        @enderror
    </div>
    <input type = "hidden" name = "email" value = "{{$email}}">
    @error("email")
        <p>{{$message}}</p>
    @enderror
    <input type = "hidden" name = "token" value = "{{$token}}">
    @error("token")
        <p>{{$message}}</p>
    @enderror
    <input type = "submit">
</form>
@endsection