@extends("layout/base")
<link rel = "stylesheet" href = "/css/artical/show.css">
@section("content")
<div>
    <div id = "category">
        @foreach($artical -> categories as $category)
            @if($loop -> last)
                {{$category -> name}}
            @else
                {{$category -> name}},
            @endif
        @endforeach
    </div>
    <div id = "author">
        BY {{$artical -> author -> name}}
    </div>
</div>
<div id = "title">
    {{$artical -> title}}
</div>
<div id = "content">
    {{$artical -> content}}
</div>


{{-- BELOW HERE CANNOT BE WORKED ON UNTIL A USER SYSTEM HAS BEEN IMPLOMENTED --}}
<div id = "write">
    <p>Add your comment here</p>
    <form action = "/storeComment" method = "get">
        <textarea name = "content"></textarea>
        <input type = "submit">
    </form>
</div>
<div id = "comments">
    <div class = "comment">
        <div class = "comment_author">
            by TEST2  TEST2
        </div>
        <div class = "comment_content">
            Yeah I do agree food is a great thing
        </div>
    </div>
    <div class = "comment">
        <div class = "comment_author">
            by TEST3  TEST3
        </div>
        <div class = "comment_content">
            Food is terrible and I hate everyone who likes it
        </div>
    </div>
</div>
@endsection