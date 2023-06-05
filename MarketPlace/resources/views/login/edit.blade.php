@extends("layout/base")
<link rel = "stylesheet" href = "/css/login/edit.css">
@section("content")
<form action = "/login/update" method = "post">
    @csrf
    <p>PASSWORD RESET FORM WILL BE SEND TO THIS EMAIL</p>
    <div>
        <label for = "email">EMAIL</label>
        <input type = "text" name = "email" value = "{{old("name")}}">
        @error("email")
            <p>{{$message}}</p>
        @enderror
    </div>
    <input type = "submit">
</form>
@endsection