@extends("layout/base")
<link rel = "stylesheet" href = "/css/login/index.css">
@section("content")
<form action = "/auth/store" method = "post">
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
<div style = "text-align: center">
    <a href = "/login/create" id = "createAccount">CREATE ACCOUNT</a>
</div>
<div style = "text-align: center; margin-top: 6px">
    <a href = "/login/edit" id = "resetPassword">RESET PASSWORD</a>
</div>
@endsection