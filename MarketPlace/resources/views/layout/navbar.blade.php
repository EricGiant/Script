<link rel = "stylesheet" href = "/css/layout/navbar.css">
<div style = "margin-bottom: 10px; text-align: center" id = "bar">
    <a href = "/post">HOME</a>
    @guest
        <a href = "/login">LOGIN</a>
    @else
        <a href = "/chat">CHATS</a>
        <a href = "/post/create">CREATE POST</a>
        <a href = "/post/editPage">EDIT POSTS</a>
        <a href = "/auth/destroy">LOGOUT</a>
    @endguest
</div>