@extends("layout/base")
<link rel = "stylesheet" href = "/css/profile/edit.css">
@section("content")
<div>
    <form action = "/category" method = "post" id = "addCategory">
        @csrf
        <label for = "name">ADD NEW CATEGORY</label>
        <input type = "text" name = "name" required>
        <input type = "submit">
        <input type = "hidden" name = "managePage" value = "0">
    </form>
</div>
@foreach($articals as $artical)
    <div style = "margin-bottom: 15px">
        <div class = "link" style = "display: inline-block">
            <a href = "/artical/edit/{{$artical -> id}}" class = "artical">
                <div class = "category">
                    @foreach($artical -> categories as $category)
                        @if($loop -> last)
                            {{$category -> name}}
                        @else
                            {{$category -> name}},
                        @endif
                    @endforeach
                </div>
                @if($artical -> isPremium)
                    <div class = "premium">
                        PREMIUM
                    </div>
                @endif
                <div class = "title">
                    {{$artical -> title}}
                </div>
            </a>
        </div>
        <div class = "remove" style = "display: inline-block">
            <form action = "/artical/destroy/{{$artical -> id}}" method = "post">
                @csrf
                <input type = "submit" value = "REMOVE">
            </form>
        </div>
    </div>
@endforeach
@endsection