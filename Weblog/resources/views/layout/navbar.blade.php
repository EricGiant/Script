<div style = "margin-bottom: 10px">
    <a href = "/artical" style = "text-decoration: none; margin-right: 10px">HOME</a>
    @guest
        <a href = "/user" style = "text-decoration: none">LOGIN</a>
    @else
        <a href = "/profile" style = "text-decoration: none; margin-right: 10px">PROFILE</a>
        <a href = "/user/destroy" style = "text-decoration: none">LOGOUT</a>
    @endguest
    @yield("categorySort")
</div>