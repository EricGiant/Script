@extends("layout/base")
<link rel = "stylesheet" href = "/css/profile/index.css">
@section("content")
<div id = "artical">
    <a href = "/artical/create">CREATE ARTICAL</a>
    <a href = "/profile/edit">MANAGE ARTICALS</a>
</div>
@if(!Auth() -> user() -> isPremium)
    <form action = "/profile/update">
        <input type = "submit" value = "BECOME PREMIUM">
    </form>
@else
    <p>U ARE A PREMIUM MEMBER</p>
@endif
@endsection