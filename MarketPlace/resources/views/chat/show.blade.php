@extends("layout/base")
<link rel = "stylesheet" href = "/css/chat/show.css">
@section("content")
<div id = "box">
    <div id = "messages">
        @foreach($chat -> messages as $message)
        <div class = "message">
            <div class = "sender">
                {{$message -> sender -> name}}
            </div>
            <div class = "created_at">
                at {{$message -> created_at}}
            </div>
            <div class = "content">
                {{$message -> content}}
            </div>
        </div>
        @endforeach
    </div>
    <div id = "send">
        <form action = "/message/store" method = "post">
            @csrf
            <input type = "text" name = "content" placeholder = "MESSAGE {{$users["user2"] -> name}}">
            <input type = "submit" value = "SEND">
        </form>
    </div>
</div>
<script>
    //reload page every 15seconds if user isn't typing
    $send = document.getElementsByName("content")[0];
    window.setInterval(function()
    {
        if($send.value == "")
        {
            //save scroll location
            sessionStorage.setItem("scrollLocation", scrollbox.scrollTop);

            //reload window
            window.location.reload();
        }
    }, 15000);

    //make scrollbox auto scroll to old scroll location or default it to bottom if no old location is found
    var scrollbox = document.getElementById("messages");
    if(sessionStorage.getItem("scrollLocation") == null)
    {
        scrollbox.scrollTop = scrollbox.scrollHeight;
    }
    else
    {
        scrollbox.scrollTop = sessionStorage.getItem("scrollLocation");
    }
</script>
@endsection