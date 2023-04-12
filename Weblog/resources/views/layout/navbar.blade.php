<div style = "margin-bottom: 10px">
    <a href = "/articalIndex" style = "text-decoration: none; margin-right: 10px">HOME</a>
    @guest
        <a href = "/userIndex" style = "text-decoration: none">LOGIN</a>
    @else
        <a href = "/profileIndex" style = "text-decoration: none; margin-right: 10px">PROFILE</a>
        <a href = "/userDestroy" style = "text-decoration: none">LOGOUT</a>
    @endguest
    @yield("categorySort")
</div>