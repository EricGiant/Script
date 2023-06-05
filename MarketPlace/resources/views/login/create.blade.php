@extends("layout/base")
<link rel = "stylesheet" href = "/css/login/create.css">
@section("content")
<form action = "/login/store" method = "post">
    @csrf
    <div>
        <label for = "name">NAME</label>
        <input type = "text" name = "name" value = "{{old("name")}}">
        @error("name")
            <p>{{$message}}</p>
        @enderror
    </div>
    <div>
        <label for = "password">PASSWORD</label>
        <input type = "text" name = "password">
        @error("password")
            <p>{{$message}}</p>
        @enderror
    </div>
    <div>
        <label for = "email">EMAIL</label>
        <input type = "text" name = "email" value = "{{old("email")}}">
        @error("email")
            <p>{{$message}}</p>
        @enderror
    </div>
    <input type = "submit">
</form>
@endsection