@extends("layout/base")
<link rel = "stylesheet" href = "/css/chat/index.css">
@section("content")
@foreach($chats as $chat)
    <div class = "chat">
        <a href = "/chat/{{$chat -> id}}">
        @if(auth() -> user() -> id == $chat -> user1_id)
            {{$chat -> user2 -> name}}
        @else
            {{$chat -> user1 -> name}}
        @endif
    </div>
@endforeach
@endsection