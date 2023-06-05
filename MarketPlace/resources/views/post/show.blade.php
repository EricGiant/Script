@extends("layout/base")
<link rel = "stylesheet" href = "/css/post/show.css">
@section("content")
<div id = "post" style = "text-align: center">
    <div>
        <div id = "seller">
            SELLER: {{$post -> user -> name}}
        </div>
        <div id = "contactSeller" style = "font-size: 12px">
            @guest
                <label for = "loginSeller">LOGIN TO CONTACT SELLER</label>
                <a href = "/login" name = "loginSeller">LOGIN HERE</a>
            @elseif(auth() -> user() -> id == $post -> user -> id)
                <label for = "editPost">EDIT YOUR POST</label>
                <a href = "/post/edit/{{$post -> id}}" name = "editPost">EDIT POST</a>
            @else
                <form action = "{{$action}}" method = "post">
                    @csrf
                    <input type = "hidden" name = "seller_id" value = "{{$post -> user -> id}}">
                    <input type = "submit" value = "CONTACT SELLER">
                </form>
            @endguest
        </div>
    </div>
    <div id = "title">
        {{$post -> name}}
    </div>
    <div id = "image">
        <img src = "{{asset($post -> image_path)}}">
    <div id = "content">
        {{$post -> content}}
    </div>
</div>
<div id = "bids" style = "text-align: center; margin-top: 15px">
    @guest
        <label for = "login">LOGIN TO POST A BID</label>
        <a href = "/login" name = "login">LOGIN HERE</a>
    @elseif($post -> bids -> contains("user_id", auth() -> user() -> id))
        @if(Session::has("editBid"))
            <form action = "/bid/update/{{auth() -> user() -> bid -> id}}" method = "post" style = "margin-bottom: 5px">
                @csrf
                <label for = "value">PLACE NEW BID HERE</label>
                <input type = "number" name = "amount">
                @error("amount")
                    <p>{{$message}}</p>
                @enderror
                <input type = "submit">
            </form>
            <form action = "/bid/destroy/{{auth() -> user() -> bid -> id}}" method = "post">
                @csrf
                <input type = "submit" value = "DELETE" style = "font-size: 20px">
            </form>
        @else
            <label for = "editBid">YOUR BID: {{auth() -> user() -> bid -> amount}}</label>
            <a href = "/bid/edit">EDIT BID</a>
        @endisset
    @else
        <form action = "/bid/store" method = "post" id = "placeBid">
            @csrf
            <label for = "value">PLACE BID HERE</label>
            <input type = "number" name = "amount">
            @error("amount")
                <p>{{$message}}</p>
            @enderror
            <input type = "hidden" value = "{{$post -> id}}" name = "post_id">
            <input type = "submit">
        </form>
    @endguest
    @foreach($post -> bids as $bid)
        @if(auth() -> user() != null && $bid -> user_id == auth() -> user() -> id)
            @continue
        @endif
        <div>
            <p>{{$bid -> user -> name}} placed bid for {{$bid -> amount}}</p>
        </div>
    @endforeach
</div>
@endsection