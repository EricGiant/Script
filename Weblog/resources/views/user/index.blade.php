@extends("layout/base")
<link rel = "stylesheet" href = "/css/user/index.css">
@section("content")
<form action = "/user/show" method = "post">
    @csrf
    <div>
        <label for = "name">NAME</label>
        <input type = "text" name = "name" id = "name" value = {{old("name")}}>
        @error("name")
            <p>{{$message}}</p>
        @enderror
    </div>
    <div>
        <label for = "password">PASSWORD</label>
        <input type = "text" name = "password" id = "password">
        @error("password")
            <p>{{$message}}</p>
        @enderror
    </div>
    <div>
        <label for = "email">EMAIL</label>
        <input type = "text" name = "email" id = "email" value = {{old("email")}}>
        @error("email")
            <p>{{$message}}</p>
        @enderror
    </div>
    <input type = "submit">
</form>
<a href = "/user/create" style = "text-decoration: none;">MAKE ACCOUNT</a>
@endsection